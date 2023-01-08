<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\helper;
use App\Models\Promocode;
use Illuminate\Support\Facades\Validator;
class PromocodeController extends Controller
{
    public function index(){
        $getpromocode = Promocode::orderByDesc('id')->get();
        return view('admin.promocode.promocode',compact('getpromocode'));
    }
    public function add(){
        return view('admin.promocode.add');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'offer_name' => 'required',
            'offer_code' => 'required',
            'offer_type' => 'required',
            'offer_amount' => 'required',
            'min_amount' => 'required',
            'start_date' => 'required',
            'expire_date' => 'required',
            'usage_type' => 'required',
            'description' => 'required',
        ],[
            "offer_name.required"=>trans('messages.offer_name_required'),
            "offer_code.required"=>trans('messages.offercode_required'),
            "offer_type.required"=>trans('messages.offer_type_required'),
            "offer_amount.required"=>trans('messages.offer_amount_required'),
            "min_amount.required"=>trans('messages.min_amount_required'),
            "start_date.required"=>trans('messages.start_date_required'),
            "expire_date.required"=>trans('messages.expire_date_required'),
            "usage_type.required"=>trans('messages.type_required'),
            "description.required"=>trans('messages.description_required'),
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $promocode = new Promocode;
            $promocode->offer_name = $request->offer_name;
            $promocode->offer_code = $request->offer_code;
            $promocode->offer_type = $request->offer_type;
            $promocode->offer_amount = helper::number_format($request->offer_amount);
            $promocode->min_amount = helper::number_format($request->min_amount);
            $promocode->start_date = $request->start_date;
            $promocode->expire_date = $request->expire_date;
            $promocode->usage_type = $request->usage_type;
            $promocode->description = $request->description;
            $promocode->is_available = '1';
            $promocode->save();
            return redirect('admin/promocode')->with('success', trans('messages.success'));
        }
    }
    public function show(Request $request){
        $getpromocode = Promocode::find($request->id);
        return view('admin.promocode.edit',compact('getpromocode'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'offer_name' => 'required',
            'offer_code' => 'required',
            'offer_type' => 'required',
            'offer_amount' => 'required',
            'min_amount' => 'required',
            'start_date' => 'required',
            'expire_date' => 'required',
            'usage_type' => 'required',
            'description' => 'required',
        ],[
            "offer_name.required"=>trans('messages.offer_name_required'),
            "offer_code.required"=>trans('messages.offercode_required'),
            "offer_type.required"=>trans('messages.offer_type_required'),
            "offer_amount.required"=>trans('messages.offer_amount_required'),
            "min_amount.required"=>trans('messages.min_amount_required'),
            "start_date.required"=>trans('messages.start_date_required'),
            "expire_date.required"=>trans('messages.expire_date_required'),
            "usage_type.required"=>trans('messages.type_required'),
            "description.required"=>trans('messages.description_required'),
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $promocode = Promocode::find($request->id);
            $promocode->offer_name = $request->offer_name;
            $promocode->offer_code = $request->offer_code;
            $promocode->offer_type = $request->offer_type;
            $promocode->offer_amount = helper::number_format($request->offer_amount);
            $promocode->min_amount = helper::number_format($request->min_amount);
            $promocode->start_date = $request->start_date;
            $promocode->expire_date = $request->expire_date;
            $promocode->usage_type = $request->usage_type;
            $promocode->description = $request->description;
            $promocode->save();
            return redirect('admin/promocode')->with('success', trans('messages.success'));
        }
    }
    public function status(Request $request){
        $promocode = Promocode::where('id', $request->id)->update(['is_available'=>$request->status]);
        if ($promocode) {
            return 1;
        } else {
            return 0;
        }
    }
}
