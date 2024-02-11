<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartGuestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderNowController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Pay\PaymentsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserAddressController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome')->name('welcome');
// });


// PAGES CONTROLLER
Route::get('/', [PagesController::class, 'welcome'])->name('welcome');
Route::get('pages/menu', [PagesController::class, 'menu'])->name('menu');
Route::get('pages/aboutUs', [PagesController::class, 'aboutUs'])->name('about.us');
Route::get('pages/promo', [PagesController::class, 'promo'])->name('promo');
Route::get('pages/contactUs', [PagesController::class, 'contactUs'])->name('contact.us');
Route::get('pages/bachelor', [PagesController::class, 'bachelor'])->name('bachelor');
Route::get('pages/event', [PagesController::class, 'event'])->name('event');
Route::get('pages/career', [PagesController::class, 'career'])->name('career');
Route::get('pages/value', [PagesController::class, 'value'])->name('value');
Route::get('pages/mission', [PagesController::class, 'mission'])->name('mission');
Route::get('pages/privacyPolicy', [PagesController::class, 'privacyPolicy'])->name('privacy');
Route::get('pages/termsConditions', [PagesController::class, 'termsConditions'])->name('terms');
Route::get('pages/registerSuccess', [PagesController::class,'registerSuccess'])->name('register.success');





//ADMIN ROUTE
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

Route::middleware(['auth'])->group(function () {

  Route::middleware(['role.checker'])->group(function () {


  //ADMIN ROUTES 
     Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/admin/reviews', [ReviewController::class, 'manageReviews'])->name('admin.manage-reviews');
    Route::delete('/admin/reviews/{id}', [ReviewController::class, 'deleteReview'])->name('admin.delete-review');
    Route::get('/sales.chart', [AdminController::class, 'salesChart'])->name('sales.chart');
Route::post('/admin/create-coupon-code', [AdminController::class, 'createCouponCode'])->name('admin.createCouponCode');

Route::get('/admin/workers/create', [AdminController::class, 'createWorker'])->name('admin.workers.create');
Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');


Route::get('/admin/welcome-admin', [AdminController::class, 'adminWelcome'])->name('admin.dashboard');


Route::get('/manager/welcome-manager', [AdminController::class, 'managerWelcome'])->name('manager.dashboard');









//USERS ROUTES
Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users.index');
Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');


// CATEGORY ROUTE
Route::get('category.create', [CategoryController::class, 'create'])->name('category.create');
Route::post('category.store', [CategoryController::class, 'store'])->name('category.store');
Route::get('category.index', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('category.edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::delete('category.destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::put('category.update/{id}', [CategoryController::class, 'update'])->name('category.update');

// PRODUCT ROUTE
Route::get('products.create', [ProductsController::class, 'create'])->name('product.create');
Route::get('products.index', [ProductsController::class, 'index'])->name('products.index');
Route::post('products.store',[ProductsController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');


//MAIL ROUTE

Route::get('/send-email-to-all-users', [EmailsController::class, 'showSendEmailForm'])->name('send.email.to.all.users');
Route::post('/send-email-to-all-users', [EmailsController::class, 'sendEmailToAllUsers'])->name('mail.users');







// COUPONS CODE ROUTE

Route::get('/coupons/create', [CouponsController::class, 'create'])->name('coupon.create');
Route::post('/coupons', [CouponsController::class, 'store'])->name('coupon.store');
Route::get('/coupons/index', [CouponsController::class, 'index'])->name('coupon.index');
Route::get('/coupons/{id}', [CouponsController::class, 'show'])->name('coupon.show');
Route::get('/coupons/edit/{coupon_id}', [CouponsController::class, 'edit'])->name('coupon.edit');
Route::delete('/coupons/destroy/{id}', [CouponsController::class, 'destroy'])->name('coupon.destroy');
Route::put('/coupons/update/{id}', [CouponsController::class, 'update'])->name('coupon.update');


//ORDER ROUTE

Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
Route::put('/admin/orders/{orderId}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
Route::get('/admin/orders/{orderId}/view', [OrderController::class, 'showOrderDetails'])->name('orders.view');
Route::get('/admin/orders/search', [OrderController::class, 'search'])->name('orders.search'); 


Route::get('/orders/filter-by-date', [OrderController::class, 'filterByDate'])->name('orders.filter-by-date');



//REVIEW ROUTE
Route::post('admin/reviews/{id}/reply', [ReviewController::class, 'reply'])->name('admin.reply-review');
Route::delete('/admin/reviews/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
Route::get('/admin/reviews/{id}/reply', [ReviewController::class, 'showReplyForm'])->name('admin.reviews.reply');
Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->name('reviews.index');
Route::get('/admin/view', [ReviewController::class, 'adminView'])->name('reviews.view');

});

});



//MAIL ROUTE
Route::post('/sendMail', [EmailsController::class, 'sendContactMail'])->name('send.mail');



//ORDER NOW ROUTE
Route::get('/orderNow', [OrderNowController::class, 'orderNow'])->name('order.now');
Route::get('/breakfast', [OrderNowController::class, 'breakFast'])->name('breakfast');
Route::get('/swallows', [OrderNowController::class, 'swallows'])->name('swallows');
Route::get('/meals', [OrderNowController::class, 'meals'])->name('meals');
Route::get('/soups', [OrderNowController::class, 'soups'])->name('soups');
Route::get('/protein', [OrderNowController::class, 'protein'])->name('protein');
Route::get('/sauce', [OrderNowController::class, 'sauce'])->name('sauce');
Route::get('/drinks', [OrderNowController::class, 'drinks'])->name('drinks');
Route::get('/search', [OrderNowController::class, 'search'])->name('search');
Route::get('/search/sort/{method}', [OrderNowController::class, 'sort'])->name('search.sort');
Route::get('/product/{product}', [OrderNowController::class, 'showDetails'])->name('product.details');


//ADD TO CART ROUTE
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('cart/update/quantity/{productId}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::put('cart/update/color/{productId}', [CartController::class, 'updateColor'])->name('cart.updateColor');
Route::put('cart/update/size/{productId}', [CartController::class, 'updateSize'])->name('cart.updateSize');
Route::delete('cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/cart/set-delivery-option', [CartController::class, 'setDeliveryOption'])->name('set.delivery.option');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');
Route::post('/remove-coupon', [CartController::class, 'removeCoupon'])->name('remove.coupon');



// REVIEW CONTROLLER
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/load-more', [ReviewController::class, 'loadMore'])->name('reviews.loadMore');



//ADD TO WISH LIST ROUTE
Route::post('/wishlist/add/{product}', [CartController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist',[CartController::class, 'wishlist'])->name('wishlist.show');
Route::delete('wishlist/remove/{id}', [CartController::class, 'removeFromWishlist'])->name('wishlist.remove');

Route::post('/wishlist/add/{product}', [CartGuestController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist',[CartGuestController::class, 'wishlist'])->name('wishlist.show');
Route::delete('wishlist/remove/{id}', [CartGuestController::class, 'removeFromWishlist'])->name('wishlist.remove');


//DASHBOARD ROUTE
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/account-details', [DashboardController::class, 'accountDetails'])->name('account.details');
Route::put('/account/update', [UserController::class, 'updateAccount'])->name('account.update');




//ORDER ROUTE
 Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order.history');
Route::get('/order/track', [OrderController::class, 'trackOrder'])->name('order.track');
Route::post('/order/track', [OrderController::class, 'trackOrder'])->name('order.track.post');



//ADDRESS ROUTE
Route::get('/user-address/create', [UserAddressController::class, 'create'])->name('user.address');
Route::post('/user-address', [UserAddressController::class, 'store'])->name('user-address.store');
Route::get('/user-address/edit', [UserAddressController::class, 'edit'])->name('address-edit');
Route::put('/user-address', [UserAddressController::class, 'update'])->name('address.update');
Route::get('/user-address/view', [UserAddressController::class, 'view'])->name('address.view');



//PAYMENT ROUTE
  Route::match(['get', 'post'], '/pay', [PaymentsController::class, 'place_order'])->name('pay.now');
  Route::get('payment/callback/{ref}', [PaymentsController::class, 'handleCallback'])->name('pay.callback');

  

// Guest payment routes
Route::get('/guest/pay/callback/{ref}', [GuestPaymentController::class, 'handleCallback'])->name('guest-pay.callback');
Route::match(['get', 'post'], '/guest/pay', [GuestPaymentController::class, 'placeOrder'])->name('guest.pay.now');
Route::get('/guest-checkout', [GuestController::class, 'guest'])->name('guest-checkout');
Route::post('/guest-checkout', [GuestController::class, 'checkout'])->name('guest-checkout-submit');











Auth::routes([ 'verify' => true ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
