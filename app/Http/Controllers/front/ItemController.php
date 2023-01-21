<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Addons;
use App\Helpers\helper;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RakibDevs\Weather\Weather;

class ItemController extends Controller
{
    public function showitem(Request $request)
    {
        $iteminfo = Item::with(['subcuisine_info','cuisine_info','item_image', 'ingredients'])->where('item.slug','=',$request->slug)->where('item.item_status','1')->first();
        $itemdata = array(
            "id"=>$iteminfo->id,
            "slug"=>$iteminfo->slug,
            "item_name"=>$iteminfo->item_name,
            "item_type"=>$iteminfo->item_type,
            "item_type_image"=>$iteminfo->item_type == 1 ? helper::image_path("veg.svg") : helper::image_path("nonveg.svg"),
            "preparation_time"=>$iteminfo->preparation_time,
            "price"=>$iteminfo->price,
            "is_featured"=>$iteminfo->is_featured,
            "ingredients"=>$iteminfo['ingredients'],
            "image_name"=>$iteminfo['item_image']->image_name,
            "item_description"=>$iteminfo->item_description,
            "cuisine_info"=>$iteminfo->cuisine_info,
            "subcuisine_info"=>$iteminfo->subcuisine_info,
            "attribute"=>ucfirst($iteminfo->attribute),
            "addons"=>Addons::select('id','name','price')->whereIn('id',explode(',',$iteminfo->addons_id))->get()
        );
        error_log('test');
        error_log($itemdata['ingredients']);
        return response()->json(['status'=>1,'message'=>trans('messages.success'), 'itemdata'=>$itemdata], 200);
    }
    public function itemdetails(Request $request)
    {
        $user_id = @Auth::user()->id;
        $getitemdata = Item::with('cuisine_info','subcuisine_info','item_images')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
            ->leftJoin('favorite', function($query) use($user_id) {
                $query->on('favorite.item_id','=','item.id')
                ->where('favorite.user_id', '=', $user_id);
            })
            ->leftJoin('cart', function($query) use($user_id) {
                $query->on('cart.item_id','=','item.id')
                ->where('cart.user_id', '=', $user_id);
            })
            ->groupBy('item.id','cart.item_id')
            ->where('item.slug','=',$request->slug)
            ->where('item.item_status','1')
            ->first();
        $getitemdata['ingredients'] = $getitemdata->ingredients;
        $getitemdata['addons'] = Addons::whereIn('id',explode(',',@$getitemdata->addons_id))->where('is_available',1)->get();
        $getrelateditems = Item::with('cuisine_info','subcuisine_info','item_image')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
            ->leftJoin('favorite', function($query) use($user_id) {
                $query->on('favorite.item_id','=','item.id')
                ->where('favorite.user_id', '=', $user_id);
            })
            ->leftJoin('cart', function($query) use($user_id) {
                $query->on('cart.item_id','=','item.id')
                ->where('cart.user_id', '=', $user_id);
            })
            ->groupBy('item.id','cart.item_id')
            ->orderByDesc('item.id')
            ->where('item.id','!=',@$getitemdata->id)
            ->where('item.cuisine_id','=',@$getitemdata->cuisine_id)
            ->where('item.item_status','1')
            ->take(4)->get();

            error_log($getitemdata['ingredients']);
        return view('web.productdetails',compact('getitemdata','getrelateditems'));
    }

    static public function itemDetailsWithSlug($slug)
    {
        $user_id = @Auth::user()->id;
        $getitemdata = Item::with('cuisine_info','subcuisine_info','item_images')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
            ->leftJoin('favorite', function($query) use($user_id) {
                $query->on('favorite.item_id','=','item.id')
                ->where('favorite.user_id', '=', $user_id);
            })
            ->leftJoin('cart', function($query) use($user_id) {
                $query->on('cart.item_id','=','item.id')
                ->where('cart.user_id', '=', $user_id);
            })
            ->groupBy('item.id','cart.item_id')
            ->where('item.slug','=',$slug)
            ->where('item.item_status','1')
            ->first();
        $getitemdata['ingredients'] = $getitemdata->ingredients;
        $getitemdata['addons'] = Addons::whereIn('id',explode(',',@$getitemdata->addons_id))->where('is_available',1)->get();

            error_log($getitemdata['ingredients']);
        return $getitemdata;
    }

    public function search(Request $request){
        $user_id = @Auth::user()->id;
        $getsearchitems = array();
        if($request->has('itemname') && $request->itemname != ""){
            $getsearchitems = Item::with('cuisine_info','subcuisine_info','item_image')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
                ->leftJoin('order_details','order_details.item_id','item.id')
                ->leftJoin('favorite', function($query) use($user_id) {
                    $query->on('favorite.item_id','=','item.id')
                    ->where('favorite.user_id', '=', $user_id);
                })
                ->leftJoin('cart', function($query) use($user_id) {
                    $query->on('cart.item_id','=','item.id')
                    ->where('cart.user_id', '=', $user_id);
                })
                ->groupBy('order_details.item_id','item.id','cart.item_id')
                ->where('item.item_name','like', '%' . $request->itemname . '%')
                ->where('item.item_status','1')
                ->orderByDesc('item.id')->paginate(16);
        }else if($request->has('ingredient_name')){
            //search by ingredient
            $ingredients = [];
            foreach ( $request->ingredient_name as $ingredient ) {
                array_push($ingredients,$ingredient);
            }
            $getsearchitems = Item::with('cuisine_info','subcuisine_info','item_image')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
            ->whereHas('ingredients', function($q) use ($ingredients) {
            // $q->whereIn('ingredient_name', $ingredients);
            $q->where('ingredient_name', $ingredients);
            })
            ->leftJoin('order_details','order_details.item_id','item.id')
            ->leftJoin('favorite', function($query) use($user_id) {
                $query->on('favorite.item_id','=','item.id')
                ->where('favorite.user_id', '=', $user_id);
            })
            ->leftJoin('cart', function($query) use($user_id) {
                $query->on('cart.item_id','=','item.id')
                ->where('cart.user_id', '=', $user_id);
            })
            ->groupBy('order_details.item_id','item.id','cart.item_id')
            ->orderByDesc('item.id')->paginate(16);

        }

        error_log("nyampe sini");
        $getingredients = Ingredient::all();

        return view('web.search',compact('getsearchitems', 'getingredients'));
    }

    
    public function viewall(Request $request)
    {
        $user_id = @Auth::user()->id;
        $getsearchitems = array();
        if($request->has('type') && $request->type != "" && in_array($request->type,array('todayspecial','topitems','recommended'))){
            $getsearchitems = Item::with('cuisine_info','subcuisine_info','item_image')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'),DB::raw('count(order_details.item_id) as item_order_counter'))
                ->leftJoin('order_details','order_details.item_id','item.id')
                ->leftJoin('favorite', function($query) use($user_id) {
                    $query->on('favorite.item_id','=','item.id')
                    ->where('favorite.user_id', '=', $user_id);
                })
                ->leftJoin('cart', function($query) use($user_id) {
                    $query->on('cart.item_id','=','item.id')
                    ->where('cart.user_id', '=', $user_id);
                })
                ->groupBy('item.id','cart.item_id')->where('item.item_status','1');
            if($request->has('type') && $request->type != ""){
                if($request->type == "todayspecial"){
                    $getsearchitems = $getsearchitems->where('item.is_featured','1')->orderByDesc('item.id');
                }
                if($request->type == "topitems"){
                    $getsearchitems = $getsearchitems->orderByDesc('item_order_counter');
                }
                if($request->type == "recommended"){
                    $getsearchitems = $getsearchitems->inRandomOrder();
                }
            }
            if($request->has('filter') && $request->filter != ""){
                if($request->filter == "veg"){
                    $getsearchitems = $getsearchitems->where('item.item_type',1);
                }
                if($request->filter == "nonveg"){
                    $getsearchitems = $getsearchitems->where('item.item_type',2);
                }
            }
            $getsearchitems = $getsearchitems->paginate(16);
        }
        return view('web.viewall',compact('getsearchitems'));
    }

    public function getItemByWeather(Request $request){
        $wt = new Weather();

        $info = $wt->getCurrentByCity('jakarta'); 
        error_log($info);

    }
}
