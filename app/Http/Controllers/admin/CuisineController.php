<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cuisine;
use App\Models\Subcuisine;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CuisineController extends Controller
{
    public function index(){
        $getcuisine = Cuisine::where('is_deleted','2')->orderbyDesc('id')->get();
        return view('admin.cuisine.cuisine',compact('getcuisine'));
    }
    public function add(){
        return view('admin.cuisine.add');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'cuisine_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ],[
            "cuisine_name.required"=>trans('messages.cuisine_name_required'),
            "image.required"=>trans('messages.image_required'),
            "image.image"=>trans('messages.enter_image_file'),
            "image.mimes"=>trans('messages.valid_image'),
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $image = 'cuisine-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('storage/app/public/admin-assets/images/cuisine', $image);
            $cuisine = new Cuisine;
            $cuisine->image = $image;
            $cuisine->cuisine_name = $request->cuisine_name;
            $cuisine->slug = $this->getcuisineslug($request->cuisine_name,'');
            $cuisine->save();
            return redirect('admin/cuisine')->with('success', trans('messages.success'));
        }
    }
    public function show(Request $request){
        $catdata = Cuisine::where('id',$request->id)->first();
        return view('admin.cuisine.edit',compact('catdata'));
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(),
            ['cuisine_name' => 'required',],
            ["cuisine_name.required"=>trans('messages.cuisine_name_required'),]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $cuisine = Cuisine::find($request->id);
            if($request->file('image') != ""){
                $validator = Validator::make($request->all(),
                ['image' => 'required|image|mimes:jpeg,png,jpg',],
                ["image.required"=>trans('messages.image_required'),
                "image.image"=>trans('messages.enter_image_file'),
                "image.mimes"=>trans('messages.valid_image'),]);
                if ($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }else{
                    if(file_exists('storage/app/public/admin-assets/images/cuisine/'.$cuisine->image)){
                        unlink('storage/app/public/admin-assets/images/cuisine/'.$cuisine->image);
                    }
                    $image = 'cuisine-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move('storage/app/public/admin-assets/images/cuisine', $image);
                    $cuisine->image = $image;
                    $cuisine->save();
                }
            }
            $cuisine->cuisine_name = $request->cuisine_name;
            $cuisine->slug = $this->getcuisineslug($request->cuisine_name,$request->id);
            $cuisine->save();
            return redirect('admin/cuisine')->with('success', trans('messages.success'));
        }
    }
    public function status(Request $request){
        $cuisine = Cuisine::where('id', $request->id)->update( array('is_available'=>$request->status) );
        if ($cuisine) {
            $item = Item::where('cuisine_id', $request->id)->update( array('item_status'=>$request->status) );
            $items = Item::where('cuisine_id', $request->id)->get();
            foreach ($items as $value) {
                $UpdateCart = Cart::where('item_id', $value['id'])->delete();
            }
            return 1;
        } else {
            return 0;
        }
    }
    public function delete(Request $request){
        $cuisine = Cuisine::where('id', $request->id)->first();
        $updatecuisine = Cuisine::where('id', $request->id)->update( array('is_deleted'=>'1') );
        if ($updatecuisine) {
            $item = Item::where('cuisine_id', $request->id)->update( array('is_deleted'=>'1') );
            $items = Item::where('cuisine_id', $request->id)->get();
            foreach ($items as $value) {
                $UpdateCart = Cart::where('item_id', $value['id'])->delete();
            }
            if(file_exists('storage/app/public/admin-assets/images/cuisine/'.$cuisine->image)){
                unlink('storage/app/public/admin-assets/images/cuisine/'.$cuisine->image);
            }
            return 1;
        } else {
            return 0;
        }
    }
    public function getcuisineslug($cuisine_name, $id)
    {
        $slug = Str::slug($cuisine_name,'-');
        $checkslug = Cuisine::where('slug',$slug);
        if($id != ""){
            $checkslug = $checkslug->where('id','!=',$id);
        }
        $checkslug = $checkslug->first();
        if(!empty($checkslug)){
            $lastid = Cuisine::select('id')->orderByDesc('id')->first();
            $slug .= '-'.$lastid->id;
        }
        return $slug;
    }






    
    // subcuisine
    public function subcuisine_index(Request $request){
        $getsubcuisine = Subcuisine::with('cuisine_info')->where('is_deleted',2)->orderByDesc('id')->get();
        return view('admin.subcuisine.index',compact('getsubcuisine'));
    }
    public function subcuisine_add(Request $request){
        $getcuisine = Cuisine::where('is_available',1)->where('is_deleted',2)->orderByDesc('id')->get();
        return view('admin.subcuisine.add',compact('getcuisine'));
    }
    public function subcuisine_store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'cuisine' => 'required',
        ],[
            "name.required"=>trans('messages.subcuisine_name_required'),
            "cuisine.required"=>trans('messages.cuisine_required'),
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $subcuisine = new Subcuisine;
            $subcuisine->subcuisine_name = $request->name;
            $subcuisine->cuisine_id = $request->cuisine;
            $subcuisine->slug = $this->getsubcuisineslug($request->name,'');
            $subcuisine->save();
            return redirect('admin/sub-cuisine')->with('success', trans('messages.success'));
        }
    }
    public function subcuisine_status(Request $request){
        $subcuisine = Subcuisine::where('id', $request->id)->update( ['is_available'=>$request->status] );
        if ($subcuisine) {
            $item = Item::where('subcuisine_id', $request->id)->update( ['item_status'=>$request->status] );
            $items = Item::where('subcuisine_id', $request->id)->get();
            foreach ($items as $value) {
                $UpdateCart = Cart::where('item_id', $value['id'])->delete();
            }
            return 1;
        } else {
            return 0;
        }
    }
    public function subcuisine_delete(Request $request){
        $cuisine = Subcuisine::where('id', $request->id)->update( ['is_deleted'=>'1'] );
        if ($cuisine) {
            $item = Item::where('subcuisine_id', $request->id)->update( ['is_deleted'=>'1'] );
            $items = Item::where('subcuisine_id', $request->id)->get();
            foreach ($items as $value) {
                $UpdateCart = Cart::where('item_id', $value['id'])->delete();
            }
            return 1;
        } else {
            return 0;
        }
    }
    public function subcuisine_show(Request $request){
        $subcatdata = Subcuisine::where('id',$request->id)->first();
        $getcuisine = Cuisine::where('is_available',1)->where('is_deleted',2)->orderByDesc('id')->get();
        return view('admin.subcuisine.edit',compact('subcatdata','getcuisine'));
    }
    public function subcuisine_update(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'cuisine' => 'required',
        ],[
            "name.required"=>trans('messages.subcuisine_name_required'),
            "cuisine.required"=>trans('messages.cuisine_required'),
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $subcuisine = Subcuisine::find($request->id);
            $subcuisine->subcuisine_name = $request->name;
            $subcuisine->cuisine_id = $request->cuisine;
            $subcuisine->slug = $this->getsubcuisineslug($request->name,$request->id);
            $subcuisine->save();
            return redirect('admin/sub-cuisine')->with('success', trans('messages.success'));
        }
    }
    public function getsubcuisineslug($subcuisine_name, $id)
    {
        $slug = Str::slug($subcuisine_name,'-');
        $checkslug = Subcuisine::where('slug',$slug);
        if($id != ""){
            $checkslug = $checkslug->where('id','!=',$id);
        }
        $checkslug = $checkslug->first();
        if(!empty($checkslug)){
            $lastid = Subcuisine::select('id')->orderByDesc('id')->first();
            $slug .= '-'.$lastid->id;
        }
        return $slug;
    }
}
