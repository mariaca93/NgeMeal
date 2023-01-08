<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\User;
use App\Helpers\helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class BookingsController extends Controller
{
    public function index(Request $request )
    {
        return view('web.reservation');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "date" => 'required',
            "time" => 'required',
            "guests" => 'required',
            "reservation_type" => 'required',
            "name" => 'required',
            "email" => 'required|email',
            "mobile" => 'required',
        ],[
            "date.required" => trans('messages.date_required'),
            "time.required" => trans('messages.time_required'),
            "guests.required" => trans('messages.guest_required'),
            "reservation_type.required" => trans('messages.reservation_type_required'),
            "name.required" => trans('messages.name_required'),
            "email.required" => trans('messages.email_required'),
            "email.email" => trans('messages.invalid_email'),
            "mobile.required" => trans('messages.mobile_required'),
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            try{
                $date = date("d-m-Y", strtotime($request->date));
                $getadmindata = User::select('id','name','email')->where('type',1)->first();
                $data=['name'=>$getadmindata->name,'adminemail'=>$getadmindata->email,'logo'=>helper::image_path(helper::appdata()->logo),'url'=>url('/admin/bookings'),'fullname'=>$request->name,'email'=>$request->email,'mobile'=>$request->mobile,'guests'=>$request->guests,'reservation_type'=>$request->reservation_type,'date'=>$date,'time'=>$request->time,'special_request'=>$request->special_request,];
                Mail::send('Email.reservation',$data,function($message)use($data){
                    $message->from(env('MAIL_USERNAME'))->subject(trans('labels.new_booking'));
                    $message->to($data['adminemail']);
                });
                $reservation = new Bookings;
                $reservation->date = $date;
                $reservation->time = $request->time;
                $reservation->guests = $request->guests;
                $reservation->reservation_type = $request->reservation_type;
                $reservation->name = $request->name;
                $reservation->email = $request->email;
                $reservation->mobile = $request->mobile;
                $reservation->special_request = $request->special_request;
                $reservation->status = 1;
                $reservation->save();
                return redirect()->back()->with('success', trans('messages.success'));
            } catch (\Throwable $th) {
                return redirect()->back()->with('error',trans('messages.wrong'));
            }
        }
    }
}