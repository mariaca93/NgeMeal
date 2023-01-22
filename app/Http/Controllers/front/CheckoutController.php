<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Helpers\helper;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\Payment;
use App\Models\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Stripe;
class CheckoutController extends Controller
{
    public function index(Request $request )
    {
        $getaddresses = Address::select('id','user_id','address_type','address','lat','lang','area','house_no',)->where('user_id',Auth::user()->id)->orderbyDesc('id')->get();
        $getpaymentmethods = Payment::select('id','environment','payment_name','currency','public_key','secret_key','encryption_key','image')->where('is_available',1)->get();
        $getcartlist = Cart::where('user_id',Auth::user()->id)->orderByDesc('id')->get();
        if(count($getcartlist) > 0){
            return view('web.checkout.checkout',compact('getaddresses','getpaymentmethods','getcartlist'));
        }else{
            return redirect()->back();
        }
    }
    
    public function checkdeliveryzone(Request $request)
    {
        return response()->json(["status"=>0,"message"=>trans('messages.select_address')],200);
        // if($request->lat == ""){
        //     return response()->json(["status"=>0,"message"=>trans('messages.select_address')],200);
        // }
        // if($request->lang == ""){
        //     return response()->json(["status"=>0,"message"=>trans('messages.select_address')],200);
        // }
        // $client = new \GuzzleHttp\Client();
        // $geocoder = \Spatie\Geocoder\Geocoder::setup($client);
        // $geocoder->setApiKey(config('geocoder.key'));
        // $alamat = $geocoder->getAddressForCoordinates($request->lat, $request->lang);
        // $checkzone = Str::contains($alamat['formatted_address'], 'Jakarta');

        // if(!$checkzone){
        //     return response()->json(['status'=>2,'message'=>trans('messages.delivery_not_available')],200);
        // }else{
        //     return response()->json(['status'=>1,'message'=>trans('messages.success')],200);
        // }
    }
    public function placeorder(Request $request)
    {
        try {
            date_default_timezone_set(helper::appdata()->timezone);
            $checkuser = User::where('is_available',1)->where('id',Auth::user()->id)->first();
            if(!empty($checkuser)){
                $cartdata = Cart::where('user_id',Auth::user()->id)->get();
                if(count($cartdata)<=0){
                    return response()->json(['status'=>0,'message'=>trans('messages.cart_is_empty')],200);
                }
                $order_number = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);
                
                if($request->transaction_type == ""){
                    return response()->json(['status'=>0,'message'=>trans('messages.transaction_type_required')],200);
                }
                if($request->transaction_type != 1 && $request->transaction_type != 2 && $request->transaction_type != 4){
                    if($request->transaction_id == ""){
                        return response()->json(['status'=>0,'message'=>trans('messages.transaction_id_required')],200);
                    }
                }
                $transaction_id = $request->transaction_id;
                if($request->grand_total == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.grand_total_required')],200);
                }
                
                if($request->address_type == ""){
                    error_log("address type required");
                    return response()->json(["status"=>0,"message"=>trans('messages.address_type_required')],200);
                }
                if($request->address == ""){
                    error_log("address required");
                    return response()->json(["status"=>0,"message"=>trans('messages.address_required')],200);
                }
                if($request->lat == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.select_address')],200);
                }
                if($request->lang == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.select_address')],200);
                }
                if($request->house_no == ""){
                    return response()->json(["status"=>0,"message"=>trans('messages.house_no_required')],200);
                }
                $address = $request->address;
                $address_type = $request->address_type;
                $lat = $request->lat;
                $lang = $request->lang;
                $house_no = $request->house_no;
                $area = $request->area;
                error_log("nympe cek transaction");
                if($request->transaction_type == 4)
                {
                    try {
                        $stripekey = helper::stripe_data()->secret_key;
                        Stripe\Stripe::setApiKey($stripekey);
                        $token = $request->transaction_id;
                        $charge = Stripe\Charge::create([
                            'amount' => $request->grand_total*100,
                            'currency' => helper::stripe_data()->currency,
                            "description" => "SingleReastaurant-OrderPayment",
                            'source' => $token,
                        ]);
                        $transaction_id = $charge->id;
                    } catch (Exception $e) {
                        // return response()->json(['status'=>0,'message'=>$e->getMessage()],200);
                        return response()->json(['status'=>0,'message'=>trans('messages.unable_to_complete_payment')],200);
                    }
                }
                $order = new Order;
                $order->order_number = $order_number;
                $order->user_id = $checkuser->id;
                $order->address_type = $address_type;
                $order->address = $address;
                $order->house_no = $house_no;
                $order->area = $area;
                $order->lat = $lat;
                $order->lang = $lang;

                $order->transaction_type = $request->transaction_type;
                if($request->transaction_type != 1 && $request->transaction_type != 2){
                    $order->transaction_id = $transaction_id;
                }
                
                $order->grand_total = helper::number_format($request->grand_total);
                $order->order_notes = $request->order_notes;
                $order->order_from = "web";
                $order->status = 1;
                if($order->save()){
                    $cartdata = Cart::where('user_id',$checkuser->id)->get();
                    foreach($cartdata as $cart){
                        $od = new OrderDetails();
                        $od->order_id = $order->id;
                        $od->user_id = $checkuser->id;
                        $od->item_id = $cart->item_id;
                        $od->item_name = $cart->item_name;
                        $od->item_type = $cart->item_type;
                        $od->item_image = $cart->item_image;
                        $od->qty = $cart->qty;
                        $od->item_price = $cart->item_price;
                        $od->addons_id = $cart->addons_id;
                        $od->addons_name = $cart->addons_name;
                        $od->addons_price = $cart->addons_price;
                        $od->addons_total_price = $cart->addons_total_price;
                        
                        $od->save();
                    }
                    Cart::where('user_id',$checkuser->id)->delete();
                    
                    $orderdata = Order::where('id',$order->id)->first();
                    $itemdata = OrderDetails::where('order_id',$order->id)->get();
                    
                    return response()->json(['status'=>1,'message'=>trans('messages.success'),'order_id'=>$order_number],200);
                }else{
                    return response()->json(['status'=>0,'message'=>trans('messages.wrong')],200);
                }
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.invalid_user')],200);
            }
        } catch (\Throwable $th) {
            // return response()->json(['status'=>0,'message'=>$th->getMessage()],200);
            return response()->json(['status'=>0,'message'=>trans('messages.wrong')],200);
        }
    }
}