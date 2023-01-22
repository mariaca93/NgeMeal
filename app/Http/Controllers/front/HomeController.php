<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Helpers\helper;
use App\Models\Slider;
use App\Models\Cuisine;
use App\Models\Item;
use App\Models\OrderDetails;
use App\Models\Banner;
use App\Models\Blogs;
use App\Models\Faq;
use App\Models\Ratting;
use App\Models\Subscription;
use App\Models\Weather;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user_id = @Auth::user()->id;
        $sliders = Slider::with('item_info','cuisine_info')->where('is_available',1)->orderByDesc('id')->get();
        $bannerlist = Banner::with('item_info','cuisine_info')->where('is_available',1)->orderByDesc('id')->get();
        $banners = array();
        $banners['topbanners'] = array();
        $banners['bannersection1'] = array();
        $banners['bannersection2'] = array();
        $banners['bannersection3'] = array();
        foreach($bannerlist as $bannerdata){
            if($bannerdata->section == 1){
                $banners['topbanners'][] = array(
                    "id" => $bannerdata->id,
                    "item_id" => $bannerdata->item_id,
                    "cuisine_id" => $bannerdata->cuisine_id,
                    "image" => Helper::image_path($bannerdata->image),
                    "item_info" => $bannerdata->item_info,
                    "cuisine_info" => $bannerdata->cuisine_info,
                );
            }
            if($bannerdata->section == 2){
                $banners['bannersection1'][] = array(
                    "id" => $bannerdata->id,
                    "item_id" => $bannerdata->item_id,
                    "cuisine_id" => $bannerdata->cuisine_id,
                    "image" => Helper::image_path($bannerdata->image),
                    "item_info" => $bannerdata->item_info,
                    "cuisine_info" => $bannerdata->cuisine_info,
                );
            }
            if($bannerdata->section == 3){
                $banners['bannersection2'][] = array(
                    "id" => $bannerdata->id,
                    "item_id" => $bannerdata->item_id,
                    "cuisine_id" => $bannerdata->cuisine_id,
                    "image" => Helper::image_path($bannerdata->image),
                    "item_info" => $bannerdata->item_info,
                    "cuisine_info" => $bannerdata->cuisine_info,
                );
            }
            if($bannerdata->section == 4){
                $banners['bannersection3'][] = array(
                    "id" => $bannerdata->id,
                    "item_id" => $bannerdata->item_id,
                    "cuisine_id" => $bannerdata->cuisine_id,
                    "image" => Helper::image_path($bannerdata->image),
                    "item_info" => $bannerdata->item_info,
                    "cuisine_info" => $bannerdata->cuisine_info,
                );
            }
        }
        $basedonweather=[];
        $weathermessage='';

        $sunny = array(0,1,2,3,45,48,80);
        $lat = '';
        $long = '';
        if($request->input('latitude') && $request->input('longitude')){
            $lat = $request->input('latitude');
            $long = $request->input('longitude');
            Cache::put('lat', $lat, 1800); //30 min
            Cache::put('long', $long, 1800); // 30 min
        }
        else if(Cache::get('lat') || Cache::get('long')){
            $lat = Cache::get('lat');
            $long = Cache::get('long');
        }
        if($lat!='' && $long!=''){
            $weather = \MichaelNabil230\Weather\Weather::location($lat, $long)
            ->current()
            ->get();
            
            $weathercode = $weather->current_weather->weathercode;
            error_log($weathercode);
            if(in_array($weathercode, $sunny)){
                $weatherid = 1;
                $weathermessage = "Our Sunny Weather Reccomendation";
            }else{
                $weatherid = 2;
                $weathermessage = "Our Rainy Weather Reccomendation";
            }

            error_log('nyampe 2');
            $basedonweather = Item::with('cuisine_info','subcuisine_info','item_images')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
            ->where('weather_id', $weatherid)
            ->leftJoin('favorite', function($query) use($user_id) {
                $query->on('favorite.item_id','=','item.id')
                ->where('favorite.user_id', '=', $user_id);
            })
            ->leftJoin('cart', function($query) use($user_id) {
                $query->on('cart.item_id','=','item.id')
                ->where('cart.user_id', '=', $user_id);
            })
            ->groupBy('item.id','cart.item_id')->get();
            error_log('nyampe 3');
        }

        $todayspecial = Item::with('cuisine_info','subcuisine_info','item_image')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
                    ->leftJoin('favorite', function($query) use($user_id) {
                        $query->on('favorite.item_id','=','item.id')
                        ->where('favorite.user_id', '=', $user_id);
                    })
                    ->leftJoin('cart', function($query) use($user_id) {
                        $query->on('cart.item_id','=','item.id')
                        ->where('cart.user_id', '=', $user_id);
                    })
                    ->groupBy('item.id','cart.item_id')
                    ->where('item.is_featured','1')->where('item.item_status','1')->orderByDesc('item.id')->take(8)->get();
        $topitemlist = Item::with('cuisine_info','subcuisine_info','item_image')->select('item.*','order_details.qty as order_details_qty',DB::raw('count(order_details.item_id) as item_order_counter'),DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
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
                    ->orderByDesc('item_order_counter')
                    ->where('item.item_status','1')->take(8)->get();
        $recommended = Item::with('cuisine_info','subcuisine_info','item_image')->select('item.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when item.price is null then 0 else item.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
                    ->leftJoin('favorite', function($query) use($user_id) {
                        $query->on('favorite.item_id','=','item.id')
                        ->where('favorite.user_id', '=', $user_id);
                    })
                    ->leftJoin('cart', function($query) use($user_id) {
                        $query->on('cart.item_id','=','item.id')
                        ->where('cart.user_id', '=', $user_id);
                    })
                    ->groupBy('item.id','cart.item_id')
                    ->inRandomOrder()
                    ->where('item.item_status','1')->take(8)->get();
        $subscriptions = Subscription::select('subscription.*',DB::raw('(case when favorite.item_id is null then 0 else 1 end) as is_favorite'),DB::raw('(case when subscription.price is null then 0 else subscription.price end) as item_price'),DB::raw('(case when cart.item_id is null then 0 else 1 end) as is_cart'))
                    ->leftJoin('favorite', function($query) use($user_id) {
                        $query->on('favorite.item_id','=','subscription.id')
                        ->where('favorite.user_id', '=', $user_id);
                    })
                    ->leftJoin('cart', function($query) use($user_id) {
                        $query->on('cart.item_id','=','subscription.id')
                        ->where('cart.user_id', '=', $user_id);
                    })
                    ->groupBy('subscription.id','cart.item_id')
                    ->inRandomOrder()
                    ->take(8)->get();
        return view('web.index',compact('sliders','banners','todayspecial', 'topitemlist', 'recommended', 'subscriptions', 'basedonweather', 'weathermessage'));
    }
    public function cuisines(Request $request)
    {
        return view('web.cuisineviewall');
    }
    public function menu(Request $request)
    {
        return view('web.menu');
    }
    public function change_dir(Request $request)
    {
        session()->put('direction', $request->dir);
        return redirect()->back();
    }
    public function faq(Request $request)
    {
        $getfaqs = Faq::select("id","title","description")->orderBydesc('id')->get();
        return view('web.faq', compact('getfaqs'));
    }
}