<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\dashboard\SitemapController;
use Illuminate\Support\Facades\Artisan;
use App\Models\Adds;
use App\Models\Category;
use App\Models\sitting;
use App\Models\Countries;
use App\Models\FixedSites;
use App\Models\PinnedPages;
use App\Models\Sites;
use App\Models\Tag;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\frontSite\ProfileUserController;
use App\Http\Controllers\dalil\SettingsUserAccountController;
use App\Http\Controllers\dalil\PageMeController;
use App\Http\Controllers\dalil\EditDescrController;
use App\Http\Controllers\dalil\NotificController;
use App\Http\Controllers\dalil\dalilController;
use App\Http\Controllers\Auth\CustomForgotPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\dashboard\CitiesController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\Http\Controllers\dalil\ProductController;
use App\Http\Controllers\dashboard\PackageController;
use App\Http\Controllers\dashboard\SubscribeController;




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



Route::get('/send', function () {
    Artisan::call('optimize:clear');
    return "optimize clear done";

    // DB::table('sites')
    // ->whereBetween('id', [4, 1257])
    // ->update(['confirmed' => 1]);

    // return "successfully";
});

Route::get('/cli', function () {
    Artisan::call('route:cach');
    Artisan::call('route:clear');
    return "route cleared";
});



// Generate Sitemap
Route::get('sitemap.xml', [SitemapController::class, 'generatorSitemap']);


// Route::get('/', function () {
//     return view('welcome');

// });


// Route::get('profile/' , [App\Http\Controllers\ProfilesController::class , 'index'])->name('main');
// Route::get('profile/create/' , [App\Http\Controllers\ProfilesController::class , 'create'])->name('create');
// Route::get('profile/edit/{id}' , [App\Http\Controllers\ProfilesController::class , 'edit'])->name('edit');
// Route::post('profile/store/' , [App\Http\Controllers\ProfilesController::class , 'store'])->name('store');
// Route::get('profile/show/{id}' , [App\Http\Controllers\ProfilesController::class , 'show'])->name('show');
// Route::post('profile/update/{id}' , [App\Http\Controllers\ProfilesController::class , 'update'])->name('update');


Auth::routes();






// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/{any}', function () {

//     $Settings = sitting::first();
// $adds = Adds::first();
// $country_names = Countries::select('id', 'country_name','href' , 'country_flag')->get();
// $all_pinned_page = PinnedPages::all();
// // $country = Countries::select('id' , 'country_name' , 'href' , 'title' , 'description', 'keyword')->where('href' , $href)->first();
//     return view('errorPage' , compact('Settings' , 'adds' , 'country_names' , 'all_pinned_page'));
// })->where('any', '.*');

// backend



Route::prefix('admin')->group(function () {

    // for Login and Dashboard
    Route::get('/login', [App\Http\Controllers\dashboard\AdminController::class, 'index'])->name('login_form');
    Route::post('/login/owner', [App\Http\Controllers\dashboard\AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard', [App\Http\Controllers\dashboard\AdminController::class, 'Dashboard'])->name('admin.dashboard')
        ->middleware('admin');
    Route::get('/logout', [App\Http\Controllers\dashboard\AdminController::class, 'AdminLogout'])->name('admin.logout')
        ->middleware('admin');
    Route::get('/register', [App\Http\Controllers\dashboard\AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create', [App\Http\Controllers\dashboard\AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');


    #######################################################################  الصفحة الرئيسية ##########################################################/
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'Rtl'])->name('home');
    ####################################################################### نهاية الصفحة الرئيسية #########################################################


    ####################################################################  الاعدادات العامة ##########################################################/
    Route::get('/sittings', [App\Http\Controllers\dashboard\sittingController::class, 'getSetting'])->name('sittings');
    Route::post('/setter', [App\Http\Controllers\dashboard\sittingController::class, 'setSittings'])->name('setSittings');
    #######################################################################  نهاية الاعدادات العامة ##########################################################/


    ####################################################################  الاعلانات  ##########################################################/
    Route::post('/setAdd', [App\Http\Controllers\dashboard\setAddsController::class, 'setAdd'])->name('setAdd');
    Route::get('/AddControl', [App\Http\Controllers\dashboard\setAddsController::class, 'AddControl'])->name('AddControl');
    ####################################################################  انهاية الاعلانات ##########################################################/


    ####################################################################  صفحات الثابتة  ##########################################################/
    Route::get('/home/pages/all', [App\Http\Controllers\dashboard\PinnedPagesController::class, 'index'])->name('main.pages');
    Route::get('/home/create/page/', [App\Http\Controllers\dashboard\PinnedPagesController::class, 'create'])->name('createPage');
    Route::post('/home/store/page/', [App\Http\Controllers\dashboard\PinnedPagesController::class, 'store'])->name('create.store');
    Route::get('/home/edit/page/{id}', [App\Http\Controllers\dashboard\PinnedPagesController::class, 'edit'])->name('edit');
    Route::post('/home/update/page/{id}', [App\Http\Controllers\dashboard\PinnedPagesController::class, 'update'])->name('update');
    Route::get('/home/delete/page/{id}', [App\Http\Controllers\dashboard\PinnedPagesController::class, 'destroy'])->name('delete');
    #################################################################### نهاية صفحات الثابتة  ##########################################################/


    ####################################################################  التصنيفات  ##########################################################/

    Route::get('categories', [App\Http\Controllers\dashboard\CategoryController::class, 'index'])->name('categories.main');
    Route::get('categories/all/{count_id}', [App\Http\Controllers\dashboard\CategoryController::class, 'getCategorWithCountry'])->name('getCateCount');
    Route::get('categories/create', [App\Http\Controllers\dashboard\CategoryController::class, 'create'])->name('categories.create');
    Route::match(['get', 'post'], 'categories/store', [App\Http\Controllers\dashboard\CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/edit/{id}', [App\Http\Controllers\dashboard\CategoryController::class, 'edit'])->name('categories.edit');
    Route::match(['post', 'put'], 'categories/update/{id}', [App\Http\Controllers\dashboard\CategoryController::class, 'update'])->name('categories.update');
    Route::match(['get', 'delete'], 'categories/destroy/{id}', [App\Http\Controllers\dashboard\CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('supcateadmin/', [App\Http\Controllers\dashboard\CategoryController::class, 'supCate'])->name('supcateadmin');
    Route::post('getcat/', [App\Http\Controllers\dashboard\CategoryController::class, 'getCate'])->name('getcate');
    // Route::post('filter/', [App\Http\Controllers\dashboard\CategoryController::class , 'filterCategory'])->name('filtercte');


    // Route::get('categ', [App\Http\Controllers\dashboard\CategoryController::class , 'getCateg']);
    // Route::get('subcateg', [App\Http\Controllers\dashboard\CategoryController::class , 'getSubCateg']);


    ####################################################################  نهاية التصنيفات  ##########################################################/



    ####################################################################  الدول  ##########################################################/

    Route::get('countries', [App\Http\Controllers\dashboard\CountriesController::class, 'index'])->name('countries.main');
    Route::get('countries/all/{count_id}', [App\Http\Controllers\dashboard\CountriesController::class, 'getCitiesWithCountry'])->name('getCitiesCounttry');
    Route::get('countries/create', [App\Http\Controllers\dashboard\CountriesController::class, 'create'])->name('countries.create');
    Route::match(['get', 'post'], 'countries/store', [App\Http\Controllers\dashboard\CountriesController::class, 'store'])->name('countries.store');
    Route::get('countries/edit/{id}', [App\Http\Controllers\dashboard\CountriesController::class, 'edit'])->name('countries.edit');
    Route::match(['post', 'put'], 'countries/update/{id}', [App\Http\Controllers\dashboard\CountriesController::class, 'update'])->name('countries.update');
    Route::get('countries/destroy/{id}', [App\Http\Controllers\dashboard\CountriesController::class, 'destroy'])->name('countries.destroy');
    #################################################################### نهاية الدول  ##########################################################/

    #################################################################### المدن  ##########################################################/
    Route::get('/city/all', [App\Http\Controllers\dashboard\CitiesController::class, 'index'])->name('city.all');
    Route::get('/city/create/', [App\Http\Controllers\dashboard\CitiesController::class, 'create'])->name('city.create');
    Route::post('/city/store/', [App\Http\Controllers\dashboard\CitiesController::class, 'store'])->name('city.store');
    Route::get('/city/edit/{id}', [App\Http\Controllers\dashboard\CitiesController::class, 'edit'])->name('city.edit');
    Route::post('/city/update/{id}', [App\Http\Controllers\dashboard\CitiesController::class, 'update'])->name('city.update');
    Route::get('/city/delete/{id}', [App\Http\Controllers\dashboard\CitiesController::class, 'destroy'])->name('city.delete');
    ####################################################################  نهاية المدن ##########################################################/

    ####################################################################  المواقع المثبتة للرئيسية  ##########################################################/

    Route::get('fixedsitesmain/', [App\Http\Controllers\dashboard\FixedSitesMainController::class, 'index'])->name('fixedsitesmain.main');
    Route::get('fixedsitesmain/create', [App\Http\Controllers\dashboard\FixedSitesMainController::class, 'create'])->name('fixedsitesmain.create');
    Route::match(['get', 'post'], 'fixedsitesmain/store', [App\Http\Controllers\dashboard\FixedSitesMainController::class, 'store'])->name('fixedsitesmain.store');
    Route::get('fixedsitesmain/edit/{id}', [App\Http\Controllers\dashboard\FixedSitesMainController::class, 'edit'])->name('fixedsitesmain.edit');
    Route::match(['post', 'put'], 'fixedsitesmain/update/{id}', [App\Http\Controllers\dashboard\FixedSitesMainController::class, 'update'])->name('fixedsitesmain.update');
    Route::get('fixedsitesmain/destroy/{id}', [App\Http\Controllers\dashboard\FixedSitesMainController::class, 'destroy'])->name('fixedsitesmain.destroy');
    #################################################################### نهاية المواقع المثبتة للرئيسية  ##########################################################/

    ####################################################################  المواقع المثبتة للرئيسية  ##########################################################/

    Route::get('fixedsitesnews/', [App\Http\Controllers\dashboard\FixedSitesNewsController::class, 'index'])->name('fixedsitesnews.main');
    Route::get('fixedsitesnews/create', [App\Http\Controllers\dashboard\FixedSitesNewsController::class, 'create'])->name('fixedsitesnews.create');
    Route::match(['get', 'post'], 'fixedsitesnews/store', [App\Http\Controllers\dashboard\FixedSitesNewsController::class, 'store'])->name('fixedsitesnews.store');
    Route::get('fixedsitesnews/edit/{id}', [App\Http\Controllers\dashboard\FixedSitesNewsController::class, 'edit'])->name('fixedsitesnews.edit');
    Route::match(['post', 'put'], 'fixedsitesnews/update/{id}', [App\Http\Controllers\dashboard\FixedSitesNewsController::class, 'update'])->name('fixedsitesnews.update');
    Route::get('fixedsitesnews/destroy/{id}', [App\Http\Controllers\dashboard\FixedSitesNewsController::class, 'destroy'])->name('fixedsitesnews.destroy');
    #################################################################### نهاية المواقع المثبتة للرئيسية  ##########################################################/


    ####################################################################  الصفحات  ##########################################################/

    // Route::get('pages' ,  [App\Http\Controllers\dashboard\PageController::class, 'index'])->name('pages.main');
    // Route::get('pages/create' , [App\Http\Controllers\dashboard\PageController::class, 'create'])->name('pages.create');
    // Route::match(['get', 'post'],'pages/store', [App\Http\Controllers\dashboard\PageController::class , 'store'])->name('pages.store');
    // Route::get('pages/edit/{id}' , [App\Http\Controllers\dashboard\PageController::class, 'edit'])->name('pages.edit');
    // Route::match(['post' , 'put'],'pages/update/{id}' , [App\Http\Controllers\dashboard\PageController::class, 'update'])->name('pages.update');
    // Route::get('pages/show/{id}' , [App\Http\Controllers\dashboard\PageController::class, 'show'])->name('pages.show');
    // Route::get('pages/destroy/{id}', [App\Http\Controllers\dashboard\PageController::class, 'destroy'])->name('pages.destroy');
    // Route::post('supcate/', [App\Http\Controllers\dashboard\CategoryController::class , 'supCate'])->name('supcate');
    ################################################################## نهاية الصفحات  ##########################################################/

    #################################################################### الشركات  ##########################################################/

    Route::get('companies', [App\Http\Controllers\dashboard\SitesController::class, 'index'])->name('sites.main');
    Route::get('companies/all/{count_id}', [App\Http\Controllers\dashboard\SitesController::class, 'getSitesWithCountry'])->name('getSitesCounttry');
    Route::get('companies/bycate/{cat_id}', [App\Http\Controllers\dashboard\SitesController::class, 'getSitesByCategory'])->name('getSitesCategory');
    Route::get('companies/create', [App\Http\Controllers\dashboard\SitesController::class, 'create'])->name('sites.create');
    Route::match(['get', 'post'], 'companies/store', [App\Http\Controllers\dashboard\SitesController::class, 'store'])->name('sites.store');
    Route::get('companies/edit/{id}', [App\Http\Controllers\dashboard\SitesController::class, 'edit'])->name('sites.edit');
    Route::match(['post', 'put'], 'companies/update/{id}', [App\Http\Controllers\dashboard\SitesController::class, 'update'])->name('sites.update');
    Route::get('companies/show/{id}', [App\Http\Controllers\dashboard\SitesController::class, 'show'])->name('sites.show');
    Route::get('companies/destroy/{id}', [App\Http\Controllers\dashboard\SitesController::class, 'destroy'])->name('sites.destroy');
    Route::post('supcateadmin2/', [App\Http\Controllers\dashboard\CategoryController::class, 'supCate'])->name('supcateadmin2');
    Route::post('getcities/', [App\Http\Controllers\dashboard\SitesController::class, 'getCitiesOfCountry'])->name('getcities');
    Route::get('searchCompanies/', [App\Http\Controllers\dashboard\Searchajax::class, 'liveAjaxSearch'])->name('live_search.action');

    #################################################################### نهاية الشركات  ##########################################################/
    #################################################################### الاخبار  ##########################################################/

    Route::get('news', [App\Http\Controllers\dashboard\NewsController::class, 'index'])->name('news.main');
    Route::get('news/create', [App\Http\Controllers\dashboard\NewsController::class, 'create'])->name('news.create');
    Route::post('news/store', [App\Http\Controllers\dashboard\NewsController::class, 'store'])->name('news.store');
    Route::get('news/edit/{id}', [App\Http\Controllers\dashboard\NewsController::class, 'edit'])->name('news.edit');
    Route::post('news/update/{id}', [App\Http\Controllers\dashboard\NewsController::class, 'update'])->name('news.update');
    Route::get('news/destroy/{id}', [App\Http\Controllers\dashboard\NewsController::class, 'destroy'])->name('news.destroy');


    #################################################################### نهاية الاخبار  ##########################################################/


    #################################################################### تاغات  ##########################################################/

    Route::get('tags/', [App\Http\Controllers\dashboard\TagController::class, 'index'])->name('tags.main');
    Route::get('tags/create', [App\Http\Controllers\dashboard\TagController::class, 'create'])->name('tags.create');
    Route::match(['get', 'post'], 'tags/store', [App\Http\Controllers\dashboard\TagController::class, 'store'])->name('tags.store');
    Route::get('tags/edit/{id}', [App\Http\Controllers\dashboard\TagController::class, 'edit'])->name('tags.edit');
    Route::match(['post', 'put'], 'tags/update/{id}', [App\Http\Controllers\dashboard\TagController::class, 'update'])->name('tags.update');
    Route::get('tags/destroy/{id}', [App\Http\Controllers\dashboard\TagController::class, 'destroy'])->name('tags.destroy');

    #################################################################### نهاية تاغات  ##########################################################/



    ####################################################################  المواقع المثبة  ##########################################################/
    Route::get('fixedsites', [App\Http\Controllers\dashboard\FixedSitesController::class, 'index'])->name('fixedsites.main');
    Route::get('fixedsites/all/{count_id}', [App\Http\Controllers\dashboard\FixedSitesController::class, 'getfixedSitesWithCountry'])->name('getfixedSitesCounttry');
    Route::get('fixedsites/create', [App\Http\Controllers\dashboard\FixedSitesController::class, 'create'])->name('fixedsites.create');
    Route::match(['get', 'post'], 'fixedsites/store/', [App\Http\Controllers\dashboard\FixedSitesController::class, 'store'])->name('fixedsites.store');
    Route::get('fixedsites/edit/{id}', [App\Http\Controllers\dashboard\FixedSitesController::class, 'edit'])->name('fixedsites.edit');
    Route::put('fixedsites/update/{id}', [App\Http\Controllers\dashboard\FixedSitesController::class, 'update'])->name('fixedsites.update');
    Route::get('fixedsites/show/{id}', [App\Http\Controllers\dashboard\FixedSitesController::class, 'show'])->name('fixedsites.show');
    Route::get('fixedsites/destroy/{id}', [App\Http\Controllers\dashboard\FixedSitesController::class, 'destroy'])->name('fixedsites.destroy');
    ####################################################################   نهاية المواقع المثبة   ##########################################################/

    ####################################################################  المستخدمين  ##########################################################/
    Route::get('users', [App\Http\Controllers\dashboard\UsersController::class, 'index'])->name('users.main');
    Route::get('users/edit/{id}', [App\Http\Controllers\dashboard\UsersController::class, 'edit'])->name('users.edit');
    Route::post('users/update/{id}', [App\Http\Controllers\dashboard\UsersController::class, 'update'])->name('users.update');
    Route::get('users/destroy/{id}', [App\Http\Controllers\dashboard\UsersController::class, 'destroy'])->name('users.destroy');

    ####################################################################   نهاية قسم المستخدمين   ##########################################################/

    ####################################################################  المدراء  ##########################################################/
    Route::get('managers', [App\Http\Controllers\dashboard\AdminController::class, 'showAllManagers'])->name('managers.main');
    Route::get('managers/edit/{id}', [App\Http\Controllers\dashboard\AdminController::class, 'editManagers'])->name('managers.edit');
    Route::post('managers/update/{id}', [App\Http\Controllers\dashboard\AdminController::class, 'updateManagers'])->name('managers.update');

    ####################################################################   نهاية قسم المدراء   ##########################################################/

    #################################################################### قائمة الانتظار لوحة تحكم  ##########################################################/

    Route::get('view/Sites-Waitting/', [App\Http\Controllers\dashboard\SitesController::class, 'toShowSites'])->name('SitesWait');
    Route::get('apply-sites/sd/{id}', [App\Http\Controllers\dashboard\SitesController::class, 'apply'])->name('applySites');
    Route::get('editwaiting-sites/wd/{id}', [App\Http\Controllers\dashboard\SitesController::class, 'editWaitSite'])->name('edit.waitingSites');
    Route::post('updatewaiting-sites/wd/{id}', [App\Http\Controllers\dashboard\SitesController::class, 'updateWaitSite'])->name('update.waitingSites');
    Route::get('destroywaiting-sites/wd/{id}', [App\Http\Controllers\dashboard\SitesController::class, 'destroyWaitSite'])->name('destroy.waitingSites');

    ####################################################################نهاية قائمة الانتظار لوحة تحكم ##########################################################/

    #################################################################### قائمة طلبات تعديل الموقع لوحة تحكم  ##########################################################/

    Route::get('view/orders/', [App\Http\Controllers\dashboard\OrdersSitesController::class, 'orderShow'])->name('sites.order');
    Route::get('approve/{id}', [App\Http\Controllers\dashboard\OrdersSitesController::class, 'approve'])->name('approve.order.site');
    Route::get('destroy/{id}', [App\Http\Controllers\dashboard\OrdersSitesController::class, 'destroy'])->name('delete.order.site');
    Route::get('edit/order/{id}', [App\Http\Controllers\dashboard\OrdersSitesController::class, 'edit'])->name('edit.order.site');
    Route::post('update/order/{id}', [App\Http\Controllers\dashboard\OrdersSitesController::class, 'update'])->name('update.order.site');

    ####################################################################نهاية قائمة طلبات تعديل الموقع لوحة تحكم ##########################################################/


    #################################################################### قسم اشعار الموقع لا يعمل لوحة تحكم  ##########################################################/

    Route::get('view/notification/', [App\Http\Controllers\dashboard\AlertController::class, 'notificationShow'])->name('notification');
    Route::get('destroy/notification/{id}', [App\Http\Controllers\dashboard\AlertController::class, 'destroy'])->name('delete.notification');
    Route::get('edit/notification/{id}', [App\Http\Controllers\dashboard\AlertController::class, 'edit'])->name('edit.notification');
    Route::post('update/notification/{id}', [App\Http\Controllers\dashboard\AlertController::class, 'update'])->name('update.notification');
    Route::get('update/sites-link/{id}', [App\Http\Controllers\dashboard\AlertController::class, 'updateSitesLink'])->name('update.site.link');
    ####################################################################نهاية قسم اشعار الموقع لا يعمل لوحة تحكم ##########################################################/

    //المنتجات
    Route::prefix('product')->group(function () {
        Route::get('all/{site_id}', [ProductController::class, 'admin_index'])->name('admin.product');
        Route::get('create/{site_id}', [ProductController::class, 'admin_create']);
        Route::post('store', [ProductController::class, 'admin_store']);
        Route::post('update/{id}', [ProductController::class, 'admin_update']);
        Route::get('edit/{id}', [ProductController::class, 'admin_edit']);
        Route::post('delete/{id}', [ProductController::class, 'admin_destroy']);
    });
    //الباقات
    Route::prefix('package')->group(function () {
        Route::get('all', [PackageController::class, 'index'])->name('admin.package');
        Route::get('create', [PackageController::class, 'create']);
        Route::post('store', [PackageController::class, 'store']);
        Route::post('update/{id}', [PackageController::class, 'update']);
        Route::get('edit/{id}', [PackageController::class, 'edit']);
        Route::post('delete/{id}', [PackageController::class, 'destroy']);
    });
    //الاشتراكات
    Route::prefix('subscribe')->group(function () {
        Route::get('all', [SubscribeController::class, 'admin_index'])->name('admin.subscribe');
        Route::get('create', [SubscribeController::class, 'admin_create']);
        Route::post('store', [SubscribeController::class, 'admin_store']);
        Route::post('update/{id}', [SubscribeController::class, 'admin_update']);
        Route::get('edit/{id}', [SubscribeController::class, 'admin_edit']);
        Route::post('delete/{id}', [SubscribeController::class, 'admin_destroy']);
    });
       //الاشتراكات بانتظار الموافقة
       Route::prefix('wait-subscribe')->group(function () {
        Route::get('all', [SubscribeController::class, 'admin_index_wait'])->name('admin.wait-subscribe');
       // Route::get('create', [SubscribeController::class, 'admin_create']);
      //  Route::post('store', [SubscribeController::class, 'admin_store']);
        Route::post('update/{id}', [SubscribeController::class, 'admin_update_wait']);
        Route::get('edit/{id}', [SubscribeController::class, 'admin_edit_wait']);
       // Route::post('delete/{id}', [SubscribeController::class, 'admin_destroy']);
    });

});





// end backend


// Login User System
/******************** Users Route **********************/
Route::prefix('users')->group(function () {
    Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('registerr');
    Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('store.Users');
    Route::get('/loginu', [AuthenticatedSessionController::class, 'create'])->name('loginu');
    Route::post('/loginu', [AuthenticatedSessionController::class, 'store'])->name('setlogin');
    Route::get('/logoutu', [AuthenticatedSessionController::class, 'destroy'])->name('logoutu');

    // Settings Account
    Route::get('setting-account/{name}', [SettingsUserAccountController::class, 'settingAccount'])->name('mainPageSetting.userr');
    Route::post('setting-account-update/', [SettingsUserAccountController::class, 'updatesettingAccount'])->name('updatePageSetting.userr');

    //
    Route::get('page-me/{name_user}', [PageMeController::class, 'index'])->middleware('auth')->name('pageme.user');
    Route::post('page-me/store', [PageMeController::class, 'storeAjaxSitesMe'])->middleware('auth')->name('pageme.storeSites.user');
    Route::get('fetch-data/', [PageMeController::class, 'fetchSites'])->middleware('auth')->name('get.sites');
    Route::get('edit-data/{id}', [PageMeController::class, 'editFetchSites'])->middleware('auth')->name('pageme.editSites.user');
    Route::post('update-data/{id}', [PageMeController::class, 'updateFetchSites'])->middleware('auth')->name('pageme.updateSites.user');
    Route::get('delete-data/{id}', [PageMeController::class, 'deleteFetchSites'])->middleware('auth')->name('pageme.deleteSites.user');


    // Forget Password

    // Route::get('/custom-forgot-password', [CustomForgotPasswordController::class, 'showForgotPasswordForm'])->name('custom.password.request');
    // Route::post('/custom-forgot-password', [CustomForgotPasswordController::class, 'sendResetLinkEmail'])->name('custom.password.email');
    Route::get('ureset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('upassword.reset');
    Route::get('uforgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('upassword.request');
    Route::post('uforgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('upassword.email');
    Route::post('ureset-password', [NewPasswordController::class, 'store'])
        ->name('upassword.update');
    //product
    Route::prefix('product')->group(function () {
        Route::get('all/{site_id}', [ProductController::class, 'index'])->middleware('auth')->name('users.product');
        Route::get('create/{site_id}', [ProductController::class, 'create'])->middleware('auth');
        Route::post('store', [ProductController::class, 'store'])->middleware('auth');
        Route::post('update/{id}', [ProductController::class, 'update'])->middleware('auth');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->middleware('auth');
        Route::post('delete/{id}', [ProductController::class, 'destroy'])->middleware('auth');
    });

    //end product
});
/******************** end Users Route **********************/






//frontend

#################################################################### صفحة الموقع الرئيسية  ##########################################################/
Route::get('/', [App\Http\Controllers\dalil\dalilController::class, 'index'])->name('index');
// Route::get('/' ,  [App\Http\Controllers\dalil\dalilController::class, 'HomePage'])->name('HomePage');
// Route::post('fetch-category/' ,  [App\Http\Controllers\dalil\dalilController::class, 'fetchCategory'])->name('fetch');
Route::get('search/', [App\Http\Controllers\dalil\SearchItemsController::class, 'search'])->name('search');
Route::get('visits/', [App\Http\Controllers\dalil\dalilController::class, 'moreVisit'])->name('visits');
Route::get('{href}/', [App\Http\Controllers\dalil\dalilController::class, 'getCountry'])->name('reload');
Route::get('category/{country_href}/{href}', [App\Http\Controllers\dalil\dalilController::class, 'showCategory'])->name('showSubCat');
Route::get('subofcategory/{country_name}/{category_href}/{setname}', [App\Http\Controllers\dalil\dalilController::class, 'showSubCategoryByCategory'])->name('subofcategory');
Route::get('companydetails/get/{country_name}/{id}', [App\Http\Controllers\dalil\dalilController::class, 'showDescr'])->name('get_descr');
Route::get('company/get/{id}', [App\Http\Controllers\dalil\dalilController::class, 'showby_id']);
Route::get('pages/{href}', [App\Http\Controllers\dalil\dalilController::class, 'about'])->name('about-dalil');

// Route::match(['post' , 'get'],'/{country_id}/{category_name}' ,  [App\Http\Controllers\dalil\dalilController::class, 'categor'])->name('goBack');
Route::get('all/tags/{id}', [App\Http\Controllers\dalil\dalilController::class, 'showTag'])->name('tags.sites');
Route::get('news/all', [dalilController::class, 'getAllNews'])->name('news.all');
Route::get('news/{id}', [dalilController::class, 'getDescrNews'])->name('news.descr');
Route::get('user/create-sites', [App\Http\Controllers\dalil\dalilController::class, 'createSites'])->name('create-sites.user');
//update
Route::get('user/edit-sites/{id}', [App\Http\Controllers\dalil\dalilController::class, 'editSites'])->name('edit-sites.user');
Route::post('user/update-sites/{id}', [App\Http\Controllers\dalil\dalilController::class, 'update'])->name('update-sites.user');
//delete
Route::post('user/sites/destroy/{id}', [App\Http\Controllers\dalil\dalilController::class, 'destroy'])->name('destroy-sites.user');

Route::post('supcate/', [App\Http\Controllers\dalil\dalilController::class, 'supCate'])->name('supcate');
Route::post('/store-sites', [App\Http\Controllers\dalil\dalilController::class, 'StoreSites'])->name('store-sites.user');
Route::get('/up-to-date/sites', [App\Http\Controllers\dalil\dalilController::class, 'newSites'])->name('new.site');
// Map search
Route::post('/searchmap', [App\Http\Controllers\dalil\SearchItemsController::class, 'query']);
Route::post('/searchbyid', [App\Http\Controllers\dalil\SearchItemsController::class, 'querybyid']);
Route::get('/subcity/{id}', [App\Http\Controllers\dalil\SearchItemsController::class, 'getsublist']);

//subscribe
Route::get('/subscribeyears/{id}', [SubscribeController::class, 'duration_byid']);
// Map end
//product
Route::get('product/{id}', [App\Http\Controllers\dalil\ProductController::class, 'showby_id']);
//
Route::prefix('package')->group(function () {
    Route::get('all', [PackageController::class, 'user_index'])->name('user.package');
    Route::get('create', [PackageController::class, 'user_create']);
    Route::post('store', [SubscribeController::class, 'user_store']);
    // Route::post('update/{id}', [PackageController::class, 'update']);
    // Route::get('edit/{id}', [PackageController::class, 'edit']);
    // Route::post('delete/{id}', [PackageController::class, 'destroy']);
});
#################################################################### نهاية صفحة الموقع الرئيسية  ##########################################################/


/******************** Route edit descr **********************/

Route::post('update-descr/{id}', [EditDescrController::class, 'editByUserAjax'])->name('update.descr');

/******************** end Route edit descr **********************/

/******************** Route button no work site **********************/

Route::post('notification/{id}', [NotificController::class, 'notificAjaxButton'])->name('notific.button');

/******************** end Route button no work site **********************/












// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__ . '/auth.php';
