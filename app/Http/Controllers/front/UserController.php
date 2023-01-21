<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Helpers\helper;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
class UserController extends Controller
{
    public function register(Request $request)
    {
        return view('web.auth.register');
    }
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,mobile',
            'checkbox' => 'accepted'
        ], [
            'name.required' => trans('messages.name_required'),
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'email.unique' => trans('messages.email_exist'),
            'mobile.required' => trans('messages.mobile_required'),
            'mobile.numeric' => trans('messages.numbers_only'),
            'mobile.unique' => trans('messages.mobile_exist'),
            'checkbox.accepted' => trans('messages.accept_terms'),
        ]);
        $email = "";
        $password = "";
        $login_type = "";
            $email = $request->email;
            $data = $request->validate([
                'password' => 'required',
                'password_confirmation' => 'required_with:password|same:password',
            ], [
                'password.required' => trans('messages.password_required'),
                'password_confirmation.required_with' => trans('messages.confirm_password_required'),
                'password_confirmation.same' => trans('messages.confirm_password_same'),
            ]);
            $login_type = "email";
            $password = Hash::make($request->password);
        
        $checkmobile = User::where('mobile', '+'.$request->country.''.$request->mobile)->first();
        if(!empty($checkmobile)){
            return redirect()->back()->with('error', trans('messages.mobile_exist'));
        }

            $user = new User;
            $user->name = $request->name;
            $user->mobile = '+'.$request->country.''.$request->mobile;
            $user->email = $email;
            $user->profile_image = 'unknown.png';
            $user->password = $password;
            $user->login_type = $login_type;
            $user->type = 2;
            $user->is_available = 1;
            $user->token = "f-LadU5sQKSINz_D7JgVtW:APA91bGpXy0_4bDKavbGoc0xZeFLddyeIYETg33UVxBfBc-JQtNSyxRq8AykHCHIK2hhIPbz6uzA9pTSGJ8UaaKGyOXnCYidXmESus79gIbuwTpcgn-1eNIFFTocaOqXvQUwqOxoTbBK";
            $user->remember_token = "0dEuopnHovMOfHbA82q9ohAvX2zWfXZnZCGYo93JiFpkuyeJ9Os4jtfSosOj";
            $user->is_verified = 2;
            $user->save();

            session()->put('verification_email',$email);
            return redirect(route('login'))->with('success', trans('messages.success'));
    }
    public function verification(Request $request)
    {
        return view('web.auth.verification');
    }
    
    public function login(Request $request)
    {
        return view('web.auth.login');
    }
    public function checklogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'password.required' => trans('messages.password_required'),
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect(route('home'));    
        } else {
            return redirect(route('login'))->with('error', trans('messages.email_pass_invalid'));
        }
    }
    
    public function getprofile(Request $request)
    {
        return view('web.profile.profile');
    }
    public function editprofile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ],[
            "name.required"=>trans('messages.name_required'),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if($request->hasFile('profile_image')){
                $validator = Validator::make($request->all(),[
                    'profile_image' => 'image|mimes:jpeg,jpg,png',
                ],[
                    "profile_image.image"=>trans('messages.enter_image_file'),
                    "profile_image.mimes"=>trans('messages.valid_image'),
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }else{
                    if(Auth::user()->profile_image != "unknown.png" && file_exists('storage/app/public/admin-assets/images/profile/'.Auth::user()->profile_image)){
                        unlink('storage/app/public/admin-assets/images/profile/'.Auth::user()->profile_image);
                    }
                    $file = $request->file("profile_image");
                    $filename = 'profile-'.time().".".$file->getClientOriginalExtension();
                    $file->move('storage/app/public/admin-assets/images/profile', $filename);
                    $checkuser = User::find(Auth::user()->id);
                    $checkuser->profile_image = $filename;
                    $checkuser->save();
                }
            }
            $checkuser = User::find(Auth::user()->id);
            $checkuser->name = $request->name;
            $checkuser->save();
            return redirect()->back()->with('success',trans('messages.success'));
        }
    }

    public function changepassword(Request $request)
    {
        return view('web.changepassword');
    }
    public function updatepassword(Request $request)
    {
        $validator = Validator::make($request->all(),
        [   'old_password' => 'required',
            'new_password' => 'required|different:old_password',
            'confirm_password' => 'required|same:new_password'],
        [   'old_password.required' => trans('messages.old_password_required'),
            'new_password.required' => trans('messages.new_password_required'),
            'new_password.different' => trans('messages.new_password_diffrent'),
            'confirm_password.required' => trans('messages.confirm_password_required'),
            'confirm_password.same' => trans('messages.confirm_password_same') ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if (Hash::check($request->old_password,Auth::user()->password)){
                $pass = User::find(Auth::user()->id);
                $pass->password = Hash::make($request->new_password);
                $pass->save();
                return redirect()->back()->with("success",trans('messages.success'));
            }else{
                return redirect()->back()->with("error",trans('messages.old_password_invalid'))->withInput();
            }
        }
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect(route('home'));
    }
}
