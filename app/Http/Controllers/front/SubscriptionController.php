<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Addons;
use App\Helpers\helper;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function showsubscription(Request $request)
    {
        $subscriptioninfo = Subscription::where('subscription.slug','=',$request->slug)->first();
        $subscriptiondata = array(
            "id"=>$subscriptioninfo->id,
            "slug"=>$subscriptioninfo->slug,
            "subscription_name"=>$subscriptioninfo->subscription_name,
            "subscription_type"=>$subscriptioninfo->subscription_type,
            "subscription_type_image"=>$subscriptioninfo->subscription_type == 1 ? helper::image_path("veg.svg") : helper::image_path("nonveg.svg"),
            "price"=>$subscriptioninfo->price,
            "image_name"=>$subscriptioninfo->image
        );
        return response()->json(['status'=>1,'message'=>trans('messages.success'), 'itemdata'=>$subscriptiondata], 200);
    }

    public function subscriptiondetails(Request $request)
    {
        $user_id = @Auth::user()->id;
        $getsubscriptiondata = Subscription::select('subscription.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when subscription.price is null then 0 else subscription.price end) as subscription_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
            ->leftJoin('favorite', function($query) use($user_id) {
                $query->on('favorite.item_id','=','subscription.id')
                ->where('favorite.user_id', '=', $user_id);
            })
            ->leftJoin('cart', function($query) use($user_id) {
                $query->on('cart.item_id','=','subscription.id')
                ->where('cart.user_id', '=', $user_id);
            })
            ->groupBy('subscription.id','cart.item_id')
            ->where('subscription.slug','=',$request->slug)
            ->first();
        // $getsubscriptiondata['ingredients'] = $getitemdata->ingredients;
        $items = Item::whereIn('id',explode(',',$getsubscriptiondata->item_id))->get();
        $itemsarr = [];
        $count = 0;
        foreach($items as $item){
            $itemsarr[$count] = ItemController::itemDetailsWithSlug($item->slug);
            $count = $count +1;
        }

        $getsubscriptiondata['items'] = $itemsarr;

        $getrelateditems = Subscription::select('subscription.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when subscription.price is null then 0 else subscription.price end) as subscription_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
            ->leftJoin('favorite', function($query) use($user_id) {
                $query->on('favorite.item_id','=','subscription.id')
                ->where('favorite.user_id', '=', $user_id);
            })
            ->leftJoin('cart', function($query) use($user_id) {
                $query->on('cart.item_id','=','subscription.id')
                ->where('cart.user_id', '=', $user_id);
            })
            ->groupBy('subscription.id','cart.item_id')
            ->orderByDesc('subscription.id')
            ->where('subscription.id','!=', $getsubscriptiondata->id)
            ->where('subscription.subscription_type','=',$getsubscriptiondata->subscription_type)
            ->take(4)->get();

            Log::info(print_r($getsubscriptiondata['items'], true));
            Log::info(print_r($getsubscriptiondata, true));
        return view('web.subscriptiondetails',compact('getsubscriptiondata','getrelateditems'));
    }
}
