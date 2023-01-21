<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Helpers\helper;
use App\Models\Cuisine;
use App\Models\Subcuisine;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MenuController extends Controller
{
    public function index(Request $request)
    {
        $user_id = @Auth::user()->id;
        $cuisinedata = Cuisine::where('slug',$request->cuisine)->where('is_available',1)->first();
        $subcuisines = Subcuisine::where('cuisine_id',@$cuisinedata->id)->where('is_available',1)->get();
        $getitemlist = Item::with('cuisine_info','subcuisine_info','item_image')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
            ->leftJoin('favorite', function($query) use($user_id) {
                $query->on('favorite.item_id','=','item.id')
                ->where('favorite.user_id', '=', $user_id);
            })
            ->leftJoin('cart', function($query) use($user_id) {
                $query->on('cart.item_id','=','item.id')
                ->where('cart.user_id', '=', $user_id);
            })
            ->groupBy('item.id','cart.item_id')
            ->where('item.item_status','1')
            ->where('item.cuisine_id',@$cuisinedata->id);
        if($request->has('subcuisine') && $request->subcuisine != ""){
            $subcatdata = Subcuisine::where('slug',$request->subcuisine)->first();
            if(empty($subcatdata)){
                return redirect()->back();
            }
            $getitemlist = $getitemlist->where('item.subcuisine_id',@$subcatdata->id);
        }
        $getitemlist = $getitemlist->orderByDesc('item.id')->paginate(16);
        return view('web.menu',compact('cuisinedata','subcuisines','getitemlist'));
    }
}