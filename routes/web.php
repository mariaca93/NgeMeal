<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\CuisineController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AddonsController;
use App\Http\Controllers\Admin\RattingController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderotpController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SystemAddonsController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\PromocodeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\OtherPagesController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\front\UserController as WebUserController;
use App\Http\Controllers\front\UserotpController as WebUserotpController;
use App\Http\Controllers\front\ItemController as WebItemController;
use App\Http\Controllers\front\AddToCartController as AddToCartController;
use App\Http\Controllers\front\SubscriptionController as WebSubscriptionController;
use App\Http\Controllers\front\OrderController as WebOrderController;
use App\Http\Controllers\front\OrderotpController as WebOrderotpController;
use App\Http\Controllers\front\PromocodeController as WebPromocodeController;
use App\Http\Controllers\front\OtherPagesController as WebOtherPagesController;
use App\Http\Controllers\front\BookingsController as WebBookingsController;
use App\Http\Controllers\front\RattingController as WebRattingController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\MenuController;
use App\Http\Controllers\front\FavoriteController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\CheckoutotpController;
use App\Http\Controllers\front\AddressController;
use App\Http\Controllers\front\WalletController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These routes are loaded by the RouteServiceProvider within a group which contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace' => 'front', 'middleware' => 'MaintenanceMiddleware'], function () {
	// home
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/direction', [HomeController::class, 'change_dir'])->name('change_dir');
	Route::get('/cuisines', [HomeController::class, 'cuisines'])->name('cuisines');
	// item
	Route::get('/menu', [MenuController::class, 'index'])->name('menu');
	Route::get('/show-item', [WebItemController::class, 'showitem']);
	Route::get('/show-subscription', [WebSubscriptionController::class, 'showsubscription']);
	Route::get('/item-{slug}', [WebItemController::class, 'itemdetails'])->name('itemdetails');
	Route::get('/subscription-{slug}', [WebSubscriptionController::class, 'subscriptiondetails'])->name('subscriptiondetails');
	Route::get('/search', [WebItemController::class, 'search'])->name('search');
	Route::get('/ingredient', [WebItemController::class, 'searchByIngredient'])->name('searchByIngredient');
	Route::get('/view-all', [WebItemController::class, 'viewall'])->name('viewall');
	Route::get('/addtocart', [AddToCartController::class, 'addtocart'])->name('addtocart');
	// otherpages
	Route::get('/abous-us', [WebOtherPagesController::class, 'aboutus'])->name('about-us');
	Route::get('/privacy-policy', [WebOtherPagesController::class, 'privacypolicy'])->name('privacy-policy');
	Route::get('/gallery', [WebOtherPagesController::class, 'gallery'])->name('gallery');
	Route::get('/terms-conditions', [WebOtherPagesController::class, 'termsconditions'])->name('terms-conditions');
	Route::get('/faq', [WebOtherPagesController::class, 'faq'])->name('faq');
	Route::get('/contactus', [WebOtherPagesController::class, 'contactindex'])->name('contact-us');
	Route::post('/contactus/store', [WebOtherPagesController::class, 'contactstore'])->name('createcontact');
	Route::get('/testimonials', [WebOtherPagesController::class, 'testimonials'])->name('testimonials');
	Route::get('/ourteam', [WebOtherPagesController::class, 'ourteam'])->name('ourteam');
	Route::get('/blogs', [WebOtherPagesController::class, 'blogs'])->name('blogs');
	Route::get('/blogs-{slug}', [WebOtherPagesController::class, 'showblog'])->name('blogdetails');
	if (\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated) {
	    Route::group(['middleware'=>'NoUserAuthMiddleware'],function(){
		// auth
		Route::get('/register', [WebUserotpController::class, 'register'])->name('register');
		Route::post('/adduser', [WebUserotpController::class, 'create'])->name('adduser');
		Route::get('/verification', [WebUserotpController::class, 'verification'])->name('verification');
		Route::post('/verify-otp', [WebUserotpController::class, 'verifyotp'])->name('verifyotp');
		Route::get('/resend-otp', [WebUserotpController::class, 'resendotp']);
		Route::get('/forgot-password', [WebUserotpController::class, 'forgotpassword'])->name('forgot-password');
		Route::post('/send-pass', [WebUserotpController::class, 'sendpass'])->name('sendpass');
		Route::get('/login', [WebUserotpController::class, 'login'])->name('login');
		Route::post('/checklogin', [WebUserotpController::class, 'checklogin']);
		// social login
		Route::get('login/google', [WebUserotpController::class, 'redirectToGoogle'])->name('auth.google');
		Route::get('login/google/callback', [WebUserotpController::class, 'handleGoogleCallback']);
		Route::get('login/facebook', [WebUserotpController::class, 'redirectToFacebook'])->name('auth.facebook');
		Route::get('login/facebook/callback', [WebUserotpController::class, 'handleFacebookCallback']);
	    });
	}else{
	    Route::group(['middleware'=>'NoUserAuthMiddleware'],function(){
		// auth
		Route::get('/register', [WebUserController::class, 'register'])->name('register');
		Route::post('/adduser', [WebUserController::class, 'create'])->name('adduser');
		Route::get('/verification', [WebUserController::class, 'verification'])->name('verification');
		Route::post('/verify-otp', [WebUserController::class, 'verifyotp'])->name('verifyotp');
		Route::get('/resend-otp', [WebUserController::class, 'resendotp']);
		Route::get('/forgot-password', [WebUserController::class, 'forgotpassword'])->name('forgot-password');
		Route::post('/send-pass', [WebUserController::class, 'sendpass'])->name('sendpass');
		Route::get('/login', [WebUserController::class, 'login'])->name('login');
		Route::post('/checklogin', [WebUserController::class, 'checklogin']);
		// social login
		Route::get('login/google', [WebUserController::class, 'redirectToGoogle'])->name('auth.google');
		Route::get('login/google/callback', [WebUserController::class, 'handleGoogleCallback']);
		Route::get('login/facebook', [WebUserController::class, 'redirectToFacebook'])->name('auth.facebook');
		Route::get('login/facebook/callback', [WebUserController::class, 'handleFacebookCallback']);
	    });
	}
	Route::group(['middleware'=>'UserMiddleware'],function(){
		if (\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated) {
			// user profile
			Route::get('/profile', [WebUserotpController::class, 'getprofile'])->name('user-profile');
			Route::post('/profile/update', [WebUserotpController::class, 'editprofile']);
			Route::get('/refer-earn', [WebUserotpController::class, 'referearn'])->name('refer-earn');
			Route::get('/changepassword', [WebUserotpController::class, 'changepassword'])->name('user-changepassword');
			Route::post('/changepassword', [WebUserotpController::class, 'updatepassword']);
			Route::get('/logout', [WebUserotpController::class, 'logout'])->name('logout');
			// orders
			Route::get('/orders', [WebOrderotpController::class, 'index'])->name('order-history');
			Route::get('/orders-{order_number}', [WebOrderotpController::class, 'orderdetails'])->name('order-details');
			Route::post('/orders/cancel', [WebOrderotpController::class, 'statusupdate']);
			// checkout
			Route::get('/checkout', [CheckoutotpController::class, 'index'])->name('checkout');
			Route::post('/isopenclose', [CheckoutotpController::class, 'isopenclose']);
			Route::post('/holduser', [CheckoutotpController::class, 'holduser']);
			Route::post('/placeorder', [CheckoutotpController::class, 'placeorder']);
			Route::post('/checkdeliveryzone', [CheckoutotpController::class, 'checkdeliveryzone']);
		}else{
			// user
			Route::get('/profile', [WebUserController::class, 'getprofile'])->name('user-profile');
			Route::post('/profile/update', [WebUserController::class, 'editprofile']);
			Route::get('/refer-earn', [WebUserController::class, 'referearn'])->name('refer-earn');
			Route::get('/changepassword', [WebUserController::class, 'changepassword'])->name('user-changepassword');
			Route::post('/changepassword', [WebUserController::class, 'updatepassword']);
			Route::get('/logout', [WebUserController::class, 'logout'])->name('logout');
			// orders
			Route::get('/orders', [WebOrderController::class, 'index'])->name('order-history');
			Route::get('/orders-{order_number}', [WebOrderController::class, 'orderdetails'])->name('order-details');
			Route::post('/orders/cancel', [WebOrderController::class, 'statusupdate']);
			// checkout
			Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
			Route::post('/isopenclose', [CheckoutController::class, 'isopenclose']);
			Route::post('/holduser', [CheckoutController::class, 'holduser']);
			Route::post('/placeorder', [CheckoutController::class, 'placeorder']);
			Route::post('/checkdeliveryzone', [CheckoutController::class, 'checkdeliveryzone']);
		}
		// address
		Route::get('/address', [AddressController::class, 'index'])->name('address');
		Route::get('/address/add', [AddressController::class, 'add'])->name('add-address');
		Route::post('/address/store', [AddressController::class, 'store']);
		Route::get('/address-{id}', [AddressController::class, 'show'])->name('update-address');
		Route::post('/address/update-{id}', [AddressController::class, 'update']);
		Route::post('/address/delete', [AddressController::class, 'deleteaddress']);
		// favorite
		Route::get('/favouritelist', [FavoriteController::class, 'index'])->name('user-favouritelist');
		Route::post('/managefavorite', [FavoriteController::class, 'managefavorite']);
		// cart
		Route::get('/cart', [CartController::class, 'index'])->name('cart');
		Route::post('addtocart', [CartController::class,'addtocart']);
		Route::post('/cart/deleteitem', [CartController::class, 'deletecartitem']);
		Route::post('/cart/qtyupdate', [CartController::class, 'qtyupdate']);
		// reviews
		Route::post('/add-review', [WebRattingController::class, 'addreview']);
	});
});
//  -------------------------------   for admin  -----------------------------------------   //
Route::get('/auth', function () {
	return view('/auth');
});
Route::post('auth', 'HomeController@auth');
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
	Route::get('/', function () { return view('admin.auth.login'); });
	Route::post('check-login', [AdminController::class,'check_admin']);
	Route::get('/forgot-password', function () { return view('admin.auth.forgot_password'); });
	Route::post('send-pass', [AdminController::class,'send_pass']);
	Route::post('auth', [AdminController::class,'auth']);
	Route::group(['middleware' => 'AdminAuth' ],function(){
		// blogs
		Route::get('blogs', [OtherPagesController::class,'blogs_index']);
		Route::get('blogs/add', [OtherPagesController::class,'blogs_add']);
		Route::post('blogs/store', [OtherPagesController::class,'blogs_store']);
		Route::get('blogs-{id}', [OtherPagesController::class,'blogs_show']);
		Route::post('blogs/update-{id}', [OtherPagesController::class,'blogs_update']);
		Route::post('blogs/delete', [OtherPagesController::class,'blogs_delete']);
		// our-team
		Route::get('our-team', [OtherPagesController::class,'our_team_index']);
		Route::get('our-team/add', [OtherPagesController::class,'our_team_add']);
		Route::post('our-team/store', [OtherPagesController::class,'our_team_store']);
		Route::get('our-team-{id}', [OtherPagesController::class,'our_team_show']);
		Route::post('our-team/update-{id}', [OtherPagesController::class,'our_team_update']);
		Route::post('our-team/delete', [OtherPagesController::class,'our_team_delete']);
		// tutorial
		Route::get('tutorial', [OtherPagesController::class,'tutorial_index']);
		Route::get('tutorial/add', [OtherPagesController::class,'tutorial_add']);
		Route::post('tutorial/store', [OtherPagesController::class,'tutorial_store']);
		Route::get('tutorial-{id}', [OtherPagesController::class,'tutorial_show']);
		Route::post('tutorial/update-{id}', [OtherPagesController::class,'tutorial_update']);
		Route::post('tutorial/delete', [OtherPagesController::class,'tutorial_delete']);
		// faq
		Route::get('faq', [OtherPagesController::class,'faq_index']);
		Route::get('faq/add', [OtherPagesController::class,'faq_add']);
		Route::post('faq/store', [OtherPagesController::class,'faq_store']);
		Route::get('faq-{id}', [OtherPagesController::class,'faq_show']);
		Route::post('faq/update-{id}', [OtherPagesController::class,'faq_update']);
		Route::post('faq/delete', [OtherPagesController::class,'faq_delete']);
		// gallery
		Route::get('gallery', [OtherPagesController::class,'gallery_index']);
		Route::get('gallery/add', [OtherPagesController::class,'gallery_add']);
		Route::post('gallery/store', [OtherPagesController::class,'gallery_store']);
		Route::get('gallery-{id}', [OtherPagesController::class,'gallery_show']);
		Route::post('gallery/update-{id}', [OtherPagesController::class,'gallery_update']);
		Route::post('gallery/delete', [OtherPagesController::class,'gallery_delete']);
		// zone
		Route::get('zone', [ZoneController::class,'index']);
		Route::post('zone/store', [ZoneController::class,'store']);
		Route::post('zone/update-{id}', [ZoneController::class,'update']);
		// others
		Route::get('home', [AdminController::class,'home'])->name('dashboard');
		Route::post('change-password', [AdminController::class,'changepassword']);
		Route::post('edit-profile', [AdminController::class,'editprofile']);
		Route::get('getorder', [AdminController::class,'getorder']);
		Route::get('change-status', [AdminController::class,'changestatus']);
		// bookings
		Route::get('bookings', [BookingsController::class,'bookings']);
		Route::post('bookings/status', [BookingsController::class,'bookingstatus']);
		// slider
		Route::get('slider', [SliderController::class,'index']);
		Route::get('slider/list', [SliderController::class,'list']);
		Route::get('slider/add', [SliderController::class,'add']);
		Route::post('slider/store', [SliderController::class,'store']);
		Route::get('slider-{id}', [SliderController::class,'show']);
		Route::post('slider/update-{id}', [SliderController::class,'update']);
		Route::post('slider/status', [SliderController::class,'status']);
		Route::post('slider/destroy', [SliderController::class,'destroy']);
		// cuisine
		Route::get('cuisine', [CuisineController::class,'index']);
		Route::get('cuisine/add', [CuisineController::class,'add']);
		Route::post('cuisine/store', [CuisineController::class,'store']);
		Route::get('cuisine-{id}', [CuisineController::class,'show']);
		Route::post('cuisine/update-{id}', [CuisineController::class,'update']);
		Route::post('cuisine/status', [CuisineController::class,'status']);
		Route::post('cuisine/delete', [CuisineController::class,'delete']);
		// sub-cuisine
		Route::get('sub-cuisine', [CuisineController::class,'subcuisine_index']);
		Route::get('sub-cuisine/add', [CuisineController::class,'subcuisine_add']);
		Route::post('sub-cuisine/store', [CuisineController::class,'subcuisine_store']);
		Route::post('sub-cuisine/status', [CuisineController::class,'subcuisine_status']);
		Route::post('sub-cuisine/delete', [CuisineController::class,'subcuisine_delete']);
		Route::get('sub-cuisine-{id}', [CuisineController::class,'subcuisine_show']);
		Route::post('sub-cuisine/update-{id}', [CuisineController::class,'subcuisine_update']);
		// item
		Route::get('item', [ItemController::class,'index']);
		Route::get('item/add', [ItemController::class,'additem']);
		Route::post('item/store', [ItemController::class,'store']);
		Route::get('item/list', [ItemController::class,'list']);
		Route::post('item/update', [ItemController::class,'update']);
		Route::post('item/showimage', [ItemController::class,'showimage']);
		Route::post('item/updateimage', [ItemController::class,'updateimage']);
		Route::post('item/storeimages', [ItemController::class,'storeimages']);
		Route::post('item/destroyimage', [ItemController::class,'destroyimage']);
		Route::post('item/status', [ItemController::class,'status']);
		Route::post('item/featured', [ItemController::class,'featured']);
		Route::post('item/delete', [ItemController::class,'delete']);
		Route::post('item/deletevariation', [ItemController::class,'deletevariation']);
		Route::get('item-{id}', [ItemController::class,'edititem']);
		Route::get('item/subcuisines', [ItemController::class,'subcuisines']);
		// payment
		Route::get('payment', [PaymentController::class,'index']);
		Route::post('payment/status', [PaymentController::class,'status']);
		Route::get('payment-{id}', [PaymentController::class,'managepayment']);
		Route::post('payment/update', [PaymentController::class,'update']);
		// addons
		Route::get('addons', [AddonsController::class,'index']);
		Route::get('addons/add', [AddonsController::class,'add']);
		Route::post('addons/store', [AddonsController::class,'store']);
		Route::get('addons-{id}', [AddonsController::class,'show']);
		Route::post('addons/update-{id}', [AddonsController::class,'update']);
		Route::post('addons/status', [AddonsController::class,'status']);
		Route::post('addons/delete', [AddonsController::class,'delete']);
		Route::post('addons/getitem', [AddonsController::class,'getitem']);
		// users
		Route::get('users', [UserController::class,'index']);
		Route::post('users/store', [UserController::class,'store']);
		Route::get('users/list', [UserController::class,'list']);
		Route::post('users/show', [UserController::class,'show']);
		Route::post('users/update', [UserController::class,'update']);
		Route::post('users/status', [UserController::class,'status']);
		Route::get('users-{id}', [UserController::class,'userdetails']);
		Route::post('users/change-wallet', [UserController::class,'add_deduct']);
		Route::post('users/addmoney', [UserController::class,'addmoney']);
		Route::post('users/deductmoney', [UserController::class,'deductmoney']);
		if (\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated) {
			Route::get('orders', [OrderotpController::class,'index']);
			Route::get('invoice/{id}', [OrderotpController::class,'invoice']);
			Route::get('print/{id}', [OrderotpController::class,'print']);
			Route::post('orders/update', [OrderotpController::class,'update']);
			Route::post('orders/assign-driver', [OrderotpController::class,'assign_driver']);
			Route::get('report', [OrderotpController::class,'get_reports']);
		} else {
			Route::get('orders', [OrderController::class,'index']);
			Route::get('invoice/{id}', [OrderController::class,'invoice']);
			Route::get('print/{id}', [OrderController::class,'print']);
			Route::post('orders/update', [OrderController::class,'update']);
			Route::post('orders/assign-driver', [OrderController::class,'assign_driver']);
			Route::get('report', [OrderController::class,'get_reports']);
		}
		Route::get('reviews', [RattingController::class,'index']);
		Route::post('reviews/destroy', [RattingController::class,'destroy']);
		// promocode
		Route::get('promocode', [PromocodeController::class,'index']);
		Route::get('promocode/add', [PromocodeController::class,'add']);
		Route::post('promocode/store', [PromocodeController::class,'store']);
		Route::get('promocode-{id}', [PromocodeController::class,'show']);
		Route::post('promocode/update-{id}', [PromocodeController::class,'update']);
		Route::post('promocode/status', [PromocodeController::class,'status']);
		// banner
		Route::get('bannersection-1', [BannerController::class,'index']);
		Route::get('bannersection-2', [BannerController::class,'index']);
		Route::get('bannersection-3', [BannerController::class,'index']);
		Route::get('bannersection-4', [BannerController::class,'index']);
		Route::get('bannersection-1/add', [BannerController::class,'add']);
		Route::get('bannersection-2/add', [BannerController::class,'add']);
		Route::get('bannersection-3/add', [BannerController::class,'add']);
		Route::get('bannersection-4/add', [BannerController::class,'add']);
		Route::post('banner/store', [BannerController::class,'store']);
		Route::get('bannersection-{section}-{id}', [BannerController::class,'show']);
		Route::post('banner/update-{id}', [BannerController::class,'update']);
		Route::post('banner/status', [BannerController::class,'status']);
		Route::post('banner/destroy', [BannerController::class,'destroy']);
		// settings
		Route::get('settings', [AboutController::class,'index']);
		Route::get('settings/delete-feature-{id}', [AboutController::class,'delete_feature']);
		Route::post('settings/update', [AboutController::class,'settings_update']);
		// contact
		Route::get('contact', [ContactController::class,'index']);
		Route::post('contact/destroy', [ContactController::class,'destroy']);
		// driver
		Route::get('driver', [DriverController::class,'index']);
		Route::get('driver/add', [DriverController::class,'add']);
		Route::post('driver/store', [DriverController::class,'store']);
		Route::get('driver-{id}', [DriverController::class,'show']);
		Route::post('driver/update-{id}', [DriverController::class,'update']);
		Route::post('driver/status', [DriverController::class,'status']);
		// time
		Route::get('time', [TimeController::class,'index']);
		Route::post('time/store', [TimeController::class,'store']);
		// privacypolicy
		Route::get('privacypolicy', [PrivacyPolicyController::class,'index']);
		Route::post('privacypolicy/update', [PrivacyPolicyController::class,'update']);
		// termscondition
		Route::get('termscondition', [TermsController::class,'index']);
		Route::post('termscondition/update', [TermsController::class,'update']);
		// notification
		Route::get('notification', [NotificationController::class,'index']);
		Route::get('notification/add', [NotificationController::class,'add']);
		Route::post('notification/store', [NotificationController::class,'store']);
		// roles
		Route::get('roles', [RolesController::class,'index']);
		Route::get('roles/add', [RolesController::class,'add']);
		Route::post('roles/store', [RolesController::class,'store']);
		Route::post('roles/status', [RolesController::class,'status']);
		Route::get('roles-{id}', [RolesController::class,'show']);
		Route::post('roles/update-{id}', [RolesController::class,'update']);
		// employee
		Route::get('employee', [UserController::class,'employee']);
		Route::get('employee/add', [UserController::class,'add_employee']);
		Route::post('employee/store', [UserController::class,'store_employee']);
		Route::post('employee/status', [UserController::class,'status_employee']);
		Route::get('employee-{id}', [UserController::class,'show_employee']);
		Route::post('employee/update-{id}', [UserController::class,'update_employee']);
		// clear-cache
		Route::get('clear-cache', function() {
			Artisan::call('cache:clear');
			Artisan::call('route:clear');
			Artisan::call('config:clear');
			Artisan::call('view:clear');
			return redirect()->back()->with('success', trans('messages.success'));
		});
		// systemaddons
		Route::get('systemaddons', [SystemAddonsController::class,'index']);
		Route::get('createsystem-addons', [SystemAddonsController::class,'createsystemaddons']);
		Route::post('systemaddons/store', [SystemAddonsController::class,'store']);
		Route::get('systemaddons/list', [SystemAddonsController::class,'list']);
		Route::post('systemaddons/update', [SystemAddonsController::class,'update']);
	});
	Route::get('logout', [AdminController::class,'logout']);
});
