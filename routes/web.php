<?php

use App\Http\Controllers\Admin\{
    AdminDashboard,
    AuthController,
    ProfileController,
    UserController,
    CmsController,
    GalleryController,
    TestimonialsController,
    BannerController,
    SeoController,
    ProductController,
    SliderController,
    SettingsController,
    CategoryController,
    WorkProcessController,
    SocialLinkController,
    EnqueryController,
    InvestorController,
};

use App\Http\Controllers\Frontend\{
    HomeController,
    LoginController,
    RegisterController,
    CartController,
    CheckoutController,
    UserProfileController,
    OrderHistoryController,
    ProductController as FrontendProductController,
};
use App\Http\Controllers\ResetPasswordController;

use Illuminate\Support\Facades\Route;
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::redirect('/','admin/login');
Route::redirect('admin','admin/login');
Route::post('admin/login',[AuthController::class,'login'])->name('admin.login');
/*Admin Part*/
Route::group(['prefix' => 'admin', 'middleware'=> ['auth:sanctum','isAdmin']], function(){
    Route::get('profile',[ProfileController::class,'getProfile'])->name('admin.profile');
    Route::post('logout',[AuthController::class,'signout'])->name('admin.logout');
    Route::get('/dashboard',[AdminDashboard::class,'getDashboard'])->name('admin.dashboard');
    Route::get('cms',[CmsController::class,'index'])->name('cms.index');
    Route::get('orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('orders/{id}',[OrderController::class,'show'])->name('orders.show');
    Route::get('completed-orders',[OrderController::class,'completedOrder'])->name('completed.orders');
    Route::get('completed-orders/{id}',[OrderController::class,'completedOrderView'])->name('completed.orders.view');
    Route::get('cms/{slug}',[CmsController::class,'edit'])->name('cms.edit');
    Route::get('enqueires',[EnqueryController::class,'index'])->name('enqueires.index');
    Route::get('enqueires/{id}',[EnqueryController::class,'show'])->name('enqueires.show');
    Route::get('seos',[SeoController::class,'index'])->name('seos.index');
    Route::get('seos/{slug}',[SeoController::class,'edit'])->name('seos.edit');
    Route::get('settings',[SettingsController::class,'edit'])->name('settings.edit');
   
    Route::get('change-password',[SettingsController::class,'changePassword'])->name('change.password');
    Route::get('payment-links',[PaymentController::class,'index'])->name('payment.index');
    Route::resources([
        'users' => UserController::class,
        'social-links' => SocialLinkController::class,
        'categories' => CategoryController::class,
        'testimonials' => TestimonialsController::class,
        'galleries' => GalleryController::class,
        'banners' => BannerController::class,
        'sliders' => SliderController::class,
        'products' => ProductController::class,
        'investors' => InvestorController::class,
        'work-processes' => WorkProcessController::class,

    ]);
    Route::post('ckeditor/image_upload',[CmsController::class,'upload'])->name('upload');
});     
Route::group(['prefix' => 'admin', 'middleware'=> ['auth']], function(){
    Route::get('profile',[ProfileController::class,'getProfile'])->name('admin.profile');
    Route::post('logout',[AuthController::class,'signout'])->name('admin.logout');
    Route::get('/dashboard',[AdminDashboard::class,'getDashboard'])->name('admin.dashboard'); 
    Route::resources([
        'investors' => InvestorController::class,

    ]);  
});
/*Admin Part*/
/*Frontend Part*/
 Route::get('/',[HomeController::class,'index'])->name('home');
 Route::get('term-and-conditions',[HomeController::class,'termCondition'])->name('term.and.condition');
 Route::get('vision-statement',[HomeController::class,'visionStatement'])->name('visionStatement');
 Route::get('mission-statement',[HomeController::class,'missionStatement'])->name('missionStatement');
 Route::get('founder-message',[HomeController::class,'founderMessage'])->name('founderMessage');
 Route::get('our-team',[HomeController::class,'ourTeam'])->name('ourTeam');
 Route::get('our-clients',[HomeController::class,'ourClients'])->name('ourClients');
 Route::get('our-presence',[HomeController::class,'ourPresence'])->name('ourPresence');
 Route::get('infrastructure',[HomeController::class,'infrastructure'])->name('infrastructure');
 Route::get('career',[HomeController::class,'carrer'])->name('carrer');
 Route::get('investors',[HomeController::class,'investors'])->name('investors');


 Route::get('contact-us',[HomeController::class,'contactUs'])->name('contact.us');
 Route::post('contact-us/form-submit',[HomeController::class,'contactForm'])->name('contact.us.form.submit');
 Route::get('testimonials',[HomeController::class,'testimonials'])->name('testimonials');
 Route::get('gallery',[HomeController::class,'gallery'])->name('gallery');
 Route::get('products',[FrontendProductController::class,'products'])->name('products');
 Route::get('products/{slug}',[FrontendProductController::class,'productDetails'])->name('productDetails');
 Route::post('products-details',[FrontendProductController::class,'show'])->name('product.show');
  Route::post('enquery-form/submit',[FrontendProductController::class,'enqueryForm'])->name('user.enquery_form.submit');
  Route::post('carrer/submit',[HomeController::class,'carrerForm'])->name('user.carrer.submit');
 

 
Route::get('emails',[CheckoutController::class,'emails']);
Route::post('forgot-password',[ResetPasswordController::class,'forgotPassword'])->name('user.forgot.password');
Route::post('admin/forgot-password',[ResetPasswordController::class,'adminForgotPassword'])->name('admin.forgot.password');
Route::get('reset-password',[ResetPasswordController::class,'resetPassword'])->name('reset_password');
Route::post('reset-password',[ResetPasswordController::class,'resetPasswordSave'])->name('reset_password_save');
/*Frontend Part*/

Route::get('clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    return 'Cleared.';
});