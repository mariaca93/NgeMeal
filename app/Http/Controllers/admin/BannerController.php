<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Item;
use App\Models\Cuisine;
use Illuminate\Support\Facades\Validator;
class BannerController extends Controller
{
    public function index(){
        $getbanner = Banner::orderByDesc('id')->get();
        return view('admin.banner.banner',compact('getbanner'));
    }
    public function add(){
        $getitem = Item::where('item_status','1')->where('is_deleted','2')->orderByDesc('id')->get();
        $getcuisine = Cuisine::where('is_available','1')->where('is_deleted','2')->orderByDesc('id')->get();
        return view('admin.banner.add',compact('getitem','getcuisine'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'cuisine_id'=> 'required_if:type,==,1',
            'item_id'=> 'required_if:type,==,2',
        ],[
            "image.required"=>trans('messages.image_required'),
            "image.image"=>trans('messages.enter_image_file'),
            "image.mimes"=>trans('messages.valid_image'),
            "cuisine_id.required_if"=>trans('messages.cuisine_required'),
            "item_id.required_if"=>trans('messages.item_required'),
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $image = 'banner-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('storage/app/public/admin-assets/images/banner', $image);
            $banner = new Banner;
            $banner->image = $image;
            $banner->section = $request->section;
            if ($request->type == "1") {
                $banner->type = $request->type;
                $banner->item_id = "";
                $banner->cuisine_id = $request->cuisine_id;
            } else if ($request->type == "2") {
                $banner->type = $request->type;
                $banner->cuisine_id = "";
                $banner->item_id = $request->item_id;
            }else{
                $banner->cuisine_id = "";
                $banner->item_id = "";
                $banner->type = "";
            }
            $banner->save();
            return redirect('admin/bannersection-'.$request->section)->with('success', trans('messages.success'));
        }
    }
    public function show(Request $request)
    {
        $getbanner = Banner::find($request->id);
        $getitem = Item::where('item_status','1')->where('is_deleted','2')->orderByDesc('id')->get();
        $getcuisine = Cuisine::where('is_available','1')->where('is_deleted','2')->orderByDesc('id')->get();
        return view('admin.banner.edit',compact('getbanner','getitem','getcuisine'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'image|mimes:jpeg,png,jpg',
            'cuisine_id'=> 'required_if:type,==,1',
            'item_id'=> 'required_if:type,==,2',
        ],[
            "image.image"=>trans('messages.enter_image_file'),
            "image.mimes"=>trans('messages.valid_image'),
            "cuisine_id.required_if"=>trans('messages.cuisine_required'),
            "item_id.required_if"=>trans('messages.item_required'),
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $banner = Banner::find($request->id);
            if ($request->type == "1") {
                $banner->type = $request->type;
                $banner->item_id = "";
                $banner->cuisine_id = $request->cuisine_id;
            } else if ($request->type == "2") {
                $banner->type = $request->type;
                $banner->cuisine_id = "";
                $banner->item_id = $request->item_id;
            }else{
                $banner->cuisine_id = "";
                $banner->item_id = "";
                $banner->type = "";
            }
            if(isset($request->image)){
                if($request->hasFile('image')){
                    if(file_exists('storage/app/public/admin-assets/images/banner/'.$banner->image)){
                        unlink('storage/app/public/admin-assets/images/banner/'.$banner->image);
                    }
                    $image = $request->file('image');
                    $image = 'banner-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move('storage/app/public/admin-assets/images/banner', $image);
                    $banner->image=$image;
                    $banner->save();
                } 
            }
            $banner->save();
            return redirect('admin/bannersection-'.$request->section)->with('success', trans('messages.success'));
        }
    }
    public function status(Request $request){
        $checksbanner = Banner::where('id', $request->id)->update(['is_available'=>$request->status]);
        if ($checksbanner) {
            return 1;
        } else {
            return 0;
        }
    }
    public function destroy(Request $request)
    {
        $banner=Banner::where('id', $request->id)->first();
        $updatebanner=Banner::where('id', $request->id)->delete();
        if ($updatebanner) {
            if(file_exists('storage/app/public/admin-assets/images/banner/'.$banner->image)){
                unlink('storage/app/public/admin-assets/images/banner/'.$banner->image);
            }
            return 1;
        } else {
            return 0;
        }
    }
}
