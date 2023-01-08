<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promocode;
use App\Models\User;
use App\Models\Order;
class PromocodeController extends Controller
{
    public function promocodelist()
    {
        $promocode=Promocode::select('promocode.offer_name','promocode.offer_code','promocode.offer_type','promocode.offer_amount','promocode.min_amount','promocode.per_user','promocode.usage_type','promocode.start_date','promocode.expire_date','promocode.description')->where('is_available','=','1')->get();
        return response()->json(['status'=>1,'message'=>trans('messages.success'),'data'=>$promocode],200);
    }
    public function checkpromocode(Request $request)
    {
        if($request->user_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.user_required')],200);
        }
        $checkuser = User::where('is_available',1)->where('id',$request->user_id)->first();
        if(!empty($checkuser)){
            if($request->offer_code == ""){
                return response()->json(["status"=>0,"message"=>trans('messages.offercode_required')],200);
            }
            $checkoffercode = Promocode::where('promocode.offer_code',$request->offer_code)->where('is_available',1)->first();
            if(!empty($checkoffercode)){
                if ((date('Y-m-d') >= $checkoffercode->start_date) && (date('Y-m-d') <= $checkoffercode->expire_date))
                {
                    $checkcount=Order::select('offer_code')->where('offer_code',$request->offer_code)->where('user_id',$request->user_id)->count();
                    if($checkoffercode->usage_type == 1){
                        if($checkcount < 1){
                            return response()->json(['status'=>1,'message'=>trans('messages.success'),'data'=>$checkoffercode],200);
                        }else{
                            return response()->json(['status'=>0,'message'=>trans('messages.once_per_user')],200);
                        }
                    }else{
                        // if($checkcount < $checkoffercode->per_user){
                            return response()->json(['status'=>1,'message'=>trans('messages.success'),'data'=>$checkoffercode],200);
                        // }else{
                        //     return response()->json(['status'=>0,'message'=>trans('messages.usage_limit_exceeded')],200);
                        // }
                    }
                }else{
                    return response()->json(["status"=>0,"message"=>trans('messages.offer_expired')],200);   
                }
            }else{
                return response()->json(['status'=>0,'message'=>trans('messages.invalid_promocode')],200);
            }
        }else{
            return response()->json(['status'=>0,'message'=>trans('messages.invalid_user')],200);
        }
    }
}
