<?php
namespace App\Helpers;
use App\Models\About;
use App\Models\Roles;
use App\Models\Cart;
use App\Models\Cuisine;
use App\Models\Zone;
use App\Models\Payment;
use App\Models\OTPConfiguration;
use App\Models\FooterFeatures;
use App\Models\Ratting;
use App\Models\User;
use App\Models\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use DateTime;

class helper
{
    public static function push_notification($token,$title,$body,$type,$order_id)
    {
        $customdata = array(
            "type" => $type,
            'sub_type'=> "",
            'cuisine_id'=> "",
            'cuisine_name'=> "",
            'item_id'=> "",
            "order_id" => $order_id,
        );

        if($title == ""){
            $title = @helper::appdata()->website_title;
        }
        $msg = array(
            'body' =>$body,
            'title'=>$title,
            'sound'=>1/*Default sound*/
        );
        $fields = array(
            'to'           =>$token,
            'notification' =>$msg,
            'data'=> $customdata
        );
        $headers = array(
            'Authorization: key=' . @helper::appdata()->firebase,
            'Content-Type: application/json'
        );
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        return $result;
    }
    public static function image_path($image)
    {
        $path = url('/admin-assets/images/no-found');

        if(Str::contains($image, 'noaccess')){
            $path = url('/admin-assets/images/'.$image);
        }
        if(Str::contains($image, 'cuisine')){
            $path = url('/admin-assets/images/cuisine/'.$image);
        }
        if(Str::contains($image, 'profile') || Str::contains($image, 'unknown') || Str::contains($image, 'identity') || Str::contains($image, 'check-list') || Str::contains($image, 'favorite') || Str::contains($image, 'change-pass') || Str::contains($image, 'change-address') || Str::contains($image, 'myprofile')){
            $path = url('/admin-assets/images/profile/'.$image);
        }
        if(Str::contains($image, 'item')){
            $path = url('/admin-assets/images/item/'.$image);
        }
        if(Str::contains($image, 'banner-')){
            $path = url('/admin-assets/images/banner/'.$image);
        }
        if(Str::contains($image, 'slider')){
            $path = url('/admin-assets/images/slider/'.$image);
        }
        if(Str::contains($image, 'mobile_app_bg_image') || Str::contains($image, 'booknow_bg_image') || Str::contains($image, 'reviews_bg_image') || Str::contains($image, 'footer_bg_image') || Str::contains($image, 'auth_bg_image') || Str::contains($image, 'breadcrumb_bg_image') || Str::contains($image, 'authformbgimage') || Str::contains($image, 'payment-') || Str::contains($image, 'app_bottom_image') || Str::contains($image, 'mobile_app_image') || Str::contains($image, 'blog') || Str::contains($image, 'veg') || Str::contains($image, 'gallery') || Str::contains($image, 'tutorial') || Str::contains($image, 'team') || Str::contains($image, 'default') || Str::contains($image, 'about') || Str::contains($image, 'footer') || Str::contains($image, 'logo') || Str::contains($image, 'favicon') || Str::contains($image, 'og_image' ) || Str::contains($image, 'search-all') || Str::contains($image, 'cart') || Str::contains($image, 'user') || Str::contains($image, 'profile-black') || Str::contains($image, 'logout') || Str::contains($image, 'ongoing') || Str::contains($image, 'completed') || Str::contains($image, 'cancelled-bar') || Str::contains($image, 'cancelled-button') || Str::contains($image, 'view') || Str::contains($image, 'delete') || Str::contains($image, 'bookmark') || Str::contains($image, 'office') || Str::contains($image, 'edit') || Str::contains($image, 'home') || Str::contains($image, 'search-button') || Str::contains($image, 'trash') || Str::contains($image, 'right-arrow') || Str::contains($image, 'left-arrow')){
            $path = url('/admin-assets/images/about/'.$image);
        }
        return $path;
    }

    public static function web_image_path($image)
    {
        $path = url('/web-assets/images/'.$image);
        return $path;
    }
    public static function verificationemail($email, $otp){
        $data=['title'=>trans('messages.email_code'),'email'=>$email,'otp'=>$otp,'logo'=>Helper::image_path(@Helper::appdata()->logo)];
        try {
            Mail::send('Email.emailverification',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function send_pass($email, $name, $password){
        $data = ['title'=>trans('labels.new_password'),'email'=>$email,'name'=>$name,'password'=>$password,'logo'=>Helper::image_path(@Helper::appdata()->logo)];
        try {
            Mail::send('Email.email',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function referral($email,$name,$toname,$referralmessage){
        $data = ['title'=>trans('labels.referral_earning'),'email'=>$email,'name'=>$name,'toname'=>$toname,'logo'=>Helper::image_path(@Helper::appdata()->logo),'referralmessage'=>$referralmessage];
        try {
            Mail::send('Email.referral',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function create_order_invoice($user_email,$user_name,$order_number,$orderdata,$itemdata)
    {
        $data = ['title'=>trans('labels.order_placed'),'email'=>$user_email,'name'=>$user_name,'order_number'=>$order_number,'orderdata'=>$orderdata,'itemdata'=>$itemdata,'logo'=>Helper::image_path(@Helper::appdata()->logo)];
        try {
            Mail::send('Email.emailinvoice', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function order_status_email($email,$name,$title,$message_text)
    {
        $data = ['email'=>$email,'name'=>$name,'title'=>$title,'message_text'=>$message_text,'logo'=>Helper::image_path(@Helper::appdata()->logo)];
        try {
            Mail::send('Email.orderemail', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function get_roles(){
        $data = Roles::select('modules')->where('id',Auth::user()->role_id)->first();
        return @$data->modules;
    }
    public static function get_user_cart(){
        $count = 0;
        if(Auth::user()){
            $count = Cart::where('user_id',Auth::user()->id)->count();
        }
        return $count;
    }
    public static function currency_format($price){
        $price = floatval($price);
        if (@helper::appdata()->currency_position == "1") {
            return @helper::appdata()->currency.number_format($price, 0);
        }
        if (@helper::appdata()->currency_position == "2") {
            return number_format($price, 0).@helper::appdata()->currency;
        }
    }
    public static function appdata(){
        $data = About::select('*',\DB::raw("CONCAT('".url('/admin-assets/images/about')."/', app_bottom_image) AS app_bottom_image_url"),\DB::raw('(case when app_bottom_image is null then 0 else 1 end) as is_app_bottom_image'))->first();
        return $data;
    }
    public static function stripe_data()
    {
        return Payment::select('environment','public_key','secret_key','currency')->where('id','=',4)->where('is_available',1)->first();
    }
    public static function check_alert()
    {
        if(@Helper::appdata()->max_order_qty != "" && @Helper::appdata()->min_order_amount != "" && @Helper::appdata()->max_order_amount != "" && @Helper::appdata()->address != "" && @Helper::appdata()->firebase != "" && @Helper::appdata()->map != "" ){
            return 1;
        }else{
            return 0;
        }
    }
    public static function check_restaurant_closed()
    {
        if(@helper::appdata()->timezone != ""){
            date_default_timezone_set(helper::appdata()->timezone);
        }
        $checkstatus = User::find(Auth::user()->id);

        $isopenclose = Time::where('day','=',date('l', strtotime(date('Y/m/d h:i:sa'))))->first();
        $current_time = DateTime::createFromFormat('H:i a', date("h:i a"));
        $open_time = DateTime::createFromFormat('H:i a', $isopenclose->open_time);
        $close_time = DateTime::createFromFormat('H:i a', $isopenclose->close_time);
        $break_start = DateTime::createFromFormat('H:i a', $isopenclose->break_start);
        $break_end = DateTime::createFromFormat('H:i a', $isopenclose->break_end);
        if ($isopenclose->always_close == "2" && ( ($current_time > $open_time && $current_time < $break_start) || ($current_time > $break_end && $current_time < $close_time) )   ) {
            $status = $checkstatus->is_online;
        } else {
            $checkstatus->is_online = 2;
            $checkstatus->save();
            $status = 2;
        }
        return $status;
    }
    public static function date_format($date){
        return date("j F Y",strtotime($date));
    }
    public static function date_time_format($date){
        return date("j F Y, g:i a",strtotime($date));
    }
    public static function number_format($number){
        // $number = (float)$number;
        // return number_format($number, 2, '.', '');
        return $number;
    }



    // front & App
    public static function checkzone($lat,$lang)
    {
        // used at add-update-address(Web+app) and before place-order(Web+app) time...
        if (env('Environment') == 'sendbox') {
            return true;
        }else{
            $zonedata = Zone::select('id','name','coordinates')->first();
            if(!empty($zonedata)){
                return false;
            }else{

                $coordinates = str_replace(['(',')',' '],'',explode('),',$zonedata->coordinates));
                foreach($coordinates as $value){
                    $arr = explode(',',$value);
                    $vertices_x[] = (float)$arr[0]; // create array of all latitude points from the polygon OR your area
                    $vertices_y[] = (float)$arr[1]; // create array of all longitude points from the polygon OR your area
                }
                $points_polygon = count($vertices_x) - 1;  // number vertices - zero-based array
                $latitude_y = $lang;    // y-coordinate of the point(longitude of your test point)
                $longitude_x = $lat;  // x-coordinate of the point(latitude of your test point)
                $i = $j = $c = 0;
                for ($i = 0, $j = $points_polygon ; $i < $points_polygon; $j = $i++) {
                    if ( (($vertices_y[$i]  >  $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
                    ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) )
                    $c = !$c;
                }
                return $c;
            }
        }
    }
    public static function verificationsms($mobile, $otp){
        try {
            $getconfiguration = OTPConfiguration::where('status',1)->first();
            if(!empty($getconfiguration)){
                if ($getconfiguration->name == "twilio") {
                    $sid    = $getconfiguration->twilio_sid;
                    $token  = $getconfiguration->twilio_auth_token;
                    $twilio = new Client($sid, $token);
                    $message = $twilio->messages->create($mobile,array("from" => $getconfiguration->twilio_mobile_number,"body" => "Your Verification Code is : ".$otp) );
                }
                if ($getconfiguration->name == "msg91") {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.msg91.com/api/v5/otp?template_id=".$getconfiguration->msg_template_id."&mobile=".$mobile."&authkey=".$getconfiguration->msg_authkey."",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array("content-type: application/json"),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                }
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function check_review_exist($user_id){
        $data = Ratting::where('user_id',$user_id)->first();
        if (!empty($data)) {
            return 1;
        }
        return 0;
    }



    // front
    public static function footer_features()
    {
        return FooterFeatures::select('id','icon','title','description')->orderByDesc('id')->get();
    }
    public static function get_cuisines()
    {
        return Cuisine::select('id','cuisine_name','slug','image')->where('is_available','=','1')->get();
    }
    public static function get_item_cart($item_id)
    {
        return Cart::where('item_id',$item_id)->where('user_id',Auth::user()->id)->sum('qty');
    }
}
