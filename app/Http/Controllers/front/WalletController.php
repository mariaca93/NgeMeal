<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\helper;
use App\Models\Payment;
use App\Models\User;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Stripe;
class WalletController extends Controller
{
    public function index(Request $request)
    {
        $gettransactions = Transaction::select('id','user_id','order_id','order_number','amount','transaction_id','transaction_type','username','created_at')->where('user_id',Auth::user()->id)->orderByDesc('id')->paginate(10);
        $totalcredited = Transaction::whereIn('transaction_type',array(2,3,4,5,6,7,8))->sum('amount');
        $totaldebited = Transaction::whereIn('transaction_type',array(1,9))->sum('amount');
        return view('web.wallet.index',compact('gettransactions','totalcredited','totaldebited'));
    }
    public function addform(Request $request)
    {
        $getpaymentmethods = Payment::select('id','environment','payment_name','currency','public_key','secret_key','encryption_key','image')->whereIn('id',array(3,4,5,6))->where('is_available',1)->get();
        return view('web.wallet.addmoney', compact('getpaymentmethods'));
    }
    public function addwallet(Request $request)
    {
        try {
            $checkuser = User::where('id',Auth::user()->id)->where('is_available',1)->where('type',2)->first();
            if(empty($checkuser)){
                return response()->json(["status"=>0,"message"=>trans('messages.invalid_user')],200);
            }
            if($request->transaction_type == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.payment_selection_required')],200);
            }
            if($request->amount == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.enter_amount')],200);
            }
            if($request->transaction_type == 4)
            {
                if (helper::stripe_data()->environment == "1") {
                    $stripekey = helper::stripe_data()->secret_key;
                } else {
                    $stripekey = helper::stripe_data()->live_secret_key;
                }
                try {
                    Stripe\Stripe::setApiKey($stripekey);
                    $token = $request->transaction_id;
                    $charge = Stripe\Charge::create([
                        'amount' => $request->amount*100,
                        'currency' => helper::stripe_data()->currency,
                        "description" => "SingleReastaurant-WalletRecharge",
                        'source' => $token,
                    ]);
                    $transaction_id = $charge->id;
                } catch (Exception $e) {
                    // return response()->json(['status'=>0,'message'=>$e->getMessage()],200);
                    return response()->json(['status'=>0,'message'=>trans('messages.unable_to_complete_payment')],200);
                }
            }else{
                if($request->transaction_id == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.enter_transaction_id')],200);
                }
                $transaction_id = $request->transaction_id;
            }
            $checkuser->wallet += $request->amount;
            $checkuser->save();
            // 3 = added-money-wallet-using- Razorpay 
            // 4 = added-money-wallet-using- Stripe 
            // 5 = added-money-wallet-using- Flutterwave 
            // 6 = added-money-wallet-using- Paystack
            $transaction = new Transaction();
            $transaction->user_id = $checkuser->id;
            $transaction->transaction_id = $transaction_id;
            $transaction->transaction_type = $request->transaction_type;
            $transaction->amount = $request->amount;
            $transaction->save();
            return response()->json(['status'=>1,'message'=>trans('messages.success')],200);
        } catch (\Throwable $th) {
            // return response()->json(['status'=>0,'message'=>$th->getMessage()],200);
            return response()->json(['status'=>0,'message'=>trans('messages.wrong')],200);
        }
    }
}
