<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Helpers\helper;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    public function index(Request $request)
    {   
        $getorders=Order::select('order.id','order.order_from','order.order_number','order.grand_total','order.status','order.transaction_type', 'order.created_at')
                ->where('order.user_id',Auth::user()->id);
                // error_log("ordernya 0 : " . json_encode($getorders));
                // error_log("user id d controller : " . Auth::user()->id);
            if($request->has('type') && $request->type == "completed"){
                $getorders = $getorders->where('status',5);
            }else if($request->has('type') && $request->type == "cancelled"){
                $getorders = $getorders->whereIn('status',array(6,7));
            }else{
                // processing
                // error_log("processing");
                $getorders = $getorders->whereIn('status',array(1,2,3,4));
                // error_log("ordernya 1 : " . json_encode($getorders));
            }
        $getorders = $getorders->where('order.order_from','!=','pos')->orderByDesc('id')->paginate(10);
        // error_log("ordernya : " .$getorders);
        $totalprocessing = Order::whereIn('status',array(1,2,3,4))->where('order_from','!=','pos')->where('user_id',Auth::user()->id)->count();
        $totalcompleted = Order::where('status',5)->where('order_from','!=','pos')->where('user_id',Auth::user()->id)->count();
        $totalcancelled = Order::whereIn('status',array(6,7))->where('order_from','!=','pos')->where('user_id',Auth::user()->id)->count();
        return view('web.orders.orders', compact('getorders','totalprocessing','totalcompleted','totalcancelled'));
    }
    public function statusupdate(Request $request)
    {
        $orderdata = Order::where('order_number',$request->id)->first();
        $user_info = User::find(Auth::user()->id);
        if(!empty($orderdata) && $orderdata->status == 1){
            $orderdata->status = 7;
            if ($orderdata->save()) {
                return 1;
            } else {
                return 0;
            }
        }else{
            return 0;   
        }
    }
    public function orderdetails(Request $request)
    {
        $orderdata = Order::where('order_number', $request->order_number)->first();
        if(!empty($orderdata)){
            error_log('lewat sini ');
            $ordersdetails = OrderDetails::where('order_id',$orderdata->id)->get();
            return view('web.orders.orderdetails',compact('orderdata','ordersdetails'));
        }else{
            error_log('malah error');
            return redirect()->back()->with('error',trans('messages.wrong'));
        }
    }
}
