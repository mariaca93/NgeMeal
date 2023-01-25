<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\UserController as WebUserController;
use App\Http\Controllers\front\ItemController as WebItemController;
use App\Http\Controllers\front\AddToCartController as AddToCartController;
use App\Http\Controllers\front\SubscriptionController as WebSubscriptionController;
use App\Http\Controllers\front\OrderController as WebOrderController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\FavoriteController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\AddressController;
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
	Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
	// item
	Route::get('/menu', [WebItemController::class, 'getbycuisine'])->name('menu');
	Route::get('/show-item', [WebItemController::class, 'showitem']);
	Route::get('/show-subscription', [WebSubscriptionController::class, 'showsubscription'])->name('showsubscription');
	Route::get('/item-{slug}', [WebItemController::class, 'itemdetails'])->name('itemdetails');
	Route::get('/subscription-{slug}', [WebSubscriptionController::class, 'subscriptiondetails'])->name('subscriptiondetails');
	Route::get('/search', [WebItemController::class, 'search'])->name('search');
	Route::get('/ingredient', [WebItemController::class, 'searchByIngredient'])->name('searchByIngredient');
	Route::get('/view-all', [WebItemController::class, 'viewall'])->name('viewall');
	Route::get('/addtocart', [AddToCartController::class, 'addtocart'])->name('addtocart');

	Route::group(['middleware'=>'NoUserAuthMiddleware'],function(){
	// auth
	Route::get('/register', [WebUserController::class, 'register'])->name('register');
	Route::post('/adduser', [WebUserController::class, 'create'])->name('adduser');
	Route::get('/verification', [WebUserController::class, 'verification'])->name('verification');
	Route::get('/forgot-password', [WebUserController::class, 'forgotpassword'])->name('forgot-password');
	Route::post('/send-pass', [WebUserController::class, 'sendpass'])->name('sendpass');
	Route::get('/login', [WebUserController::class, 'login'])->name('login');
	Route::post('/checklogin', [WebUserController::class, 'checklogin'])->name('checklogin');
	});

	Route::group(['middleware'=>'UserMiddleware'],function(){
		// user
		Route::get('/profile', [WebUserController::class, 'getprofile'])->name('user-profile');
		Route::post('/profile/update', [WebUserController::class, 'editprofile'])->name('editprofile');
		Route::get('/refer-earn', [WebUserController::class, 'referearn'])->name('refer-earn');
		Route::get('/changepassword', [WebUserController::class, 'changepassword'])->name('user-changepassword');
		Route::post('/changepassword', [WebUserController::class, 'updatepassword'])->name('updatepassword');
		Route::get('/logout', [WebUserController::class, 'logout'])->name('logout');
		// orders
		Route::get('/orders', [WebOrderController::class, 'index'])->name('order-history');
		Route::get('/orders-{order_number}', [WebOrderController::class, 'orderdetails'])->name('order-details');
		Route::post('/orders/cancel', [WebOrderController::class, 'statusupdate'])->name('cancelorder');
		// checkout
		Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
		Route::post('/isopenclose', [CheckoutController::class, 'isopenclose']);
		Route::post('/holduser', [CheckoutController::class, 'holduser']);
		Route::post('/placeorder', [CheckoutController::class, 'placeorder'])->name('placeorder');
		Route::post('/checkdeliveryzone', [CheckoutController::class, 'checkdeliveryzone']);

		// address
		Route::get('/address', [AddressController::class, 'index'])->name('address');
		Route::get('/address/add', [AddressController::class, 'add'])->name('add-address');
		Route::post('/address/store', [AddressController::class, 'store'])->name('store-address');
		Route::get('/address-{id}', [AddressController::class, 'show'])->name('update-address');
		Route::post('/address/update-{id}', [AddressController::class, 'update']);
		Route::post('/address/delete', [AddressController::class, 'deleteaddress']);
		// favorite
		Route::get('/favouritelist', [FavoriteController::class, 'index'])->name('user-favouritelist');
		Route::post('/managefavorite', [FavoriteController::class, 'managefavorite'])->name('managefavorites');
		// cart
		Route::get('/cart', [CartController::class, 'index'])->name('cart');
		Route::post('addtocart', [CartController::class,'addtocart'])->name('additemtocart');
		Route::post('/cart/deleteitem', [CartController::class, 'deletecartitem'])->name('deletecartitem');
		Route::post('/cart/qtyupdate', [CartController::class, 'qtyupdate']);
	});
});
