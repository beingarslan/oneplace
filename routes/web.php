<?php

use App\Http\Controllers\AppliedAdmissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\EligibilityController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UniversityAddmissionController;
use App\Http\Controllers\UniversityAnnouncementController;
use App\Http\Controllers\UniversityInformationController;
use App\Http\Controllers\UniversityProfileController;
use App\Http\Controllers\UniversityRequestController;
use App\Http\Controllers\UniversitySocialController;
use App\Http\Controllers\UserDetailController;
use App\Http\Middleware\EnsureAdminIsValid;
use App\Http\Middleware\EnsureUniversityIsValid;
use App\Http\Middleware\EnsureUserIsValid;
use App\UniversityInformation;
use App\UserRole;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);
Route::get('/clear-cache', function() {
  $run = Artisan::call('config:clear');
  $run = Artisan::call('cache:clear');
  $run = Artisan::call('config:cache');
  return 'FINISHED';  
});

// Main Page Route
Route::get('/', function(){
  if (Auth::check()) {
    if(UserRole::where('userid', Auth::user()->id)->where('name', 'admin')->exists()){
      return redirect('/dashboard/admin');
    }
    elseif (UserRole::where('userid', Auth::user()->id)->where('name', 'university')->exists()) {
      return redirect('/dashboard/university');
    }
    elseif (UserRole::where('userid', Auth::user()->id)->where('name', 'user')->exists()) {
      return redirect('/dashboard/user');
    }
    else {
      redirect('/logout');
    }
  } else {
    return redirect('/login');
  }
  
})->name('get');
/* Route Dashboards */
Route::group(['prefix' => 'dashboard'], function () {
  Route::get('university', [DashboardController::class,'university'])->name('dashboard-university')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('user', [DashboardController::class,'user'])->name('dashboard-user')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('admin', [DashboardController::class,'admin'])->name('dashboard-admin')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
});


Route::group(['prefix' => 'admin'], function () {
  Route::get('univeristy/requests', [UniversityRequestController::class,'univeristyrequests'])->name('admin-univeristyrequests')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  // Soials
  Route::get('/manage/socials', [SocialController::class,'managesocials'])->name('admin-managesocials')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/save/socials', [SocialController::class,'savesocials'])->name('admin-savesocials')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/update/socials', [SocialController::class,'updatesocials'])->name('admin-updatesocials')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);

});

Route::group(['prefix' => 'university'], function () {
  Route::get('view/profile', [UniversityProfileController::class,'viewprofile'])->name('university-viewprofile')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('edit/profile', [UniversityInformationController::class,'editprofile'])->name('university-editprofile')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/uploadlogo', [UniversityInformationController::class, 'uploadlogo'])->name('uploadlogo')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/update/profile', [UniversityInformationController::class, 'updateprofile'])->name('university-updateprofile')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/update/password', [UniversityInformationController::class, 'updatepassword'])->name('university-updatepassword')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/update/about', [UniversityInformationController::class, 'updateabout'])->name('university-updateabout')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  // University Socials
  Route::post('/programs/universitysocials', [UniversitySocialController::class,'saveuniversitysocials'])->name('university-saveuniversitysocials')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  // Eligibility
  Route::get('manage/eligibilities', [EligibilityController::class,'manageeligibilities'])->name('university-manageeligibilities')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/save/eligibilities', [EligibilityController::class,'saveeligibilities'])->name('university-saveeligibilities')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/update/eligibilities', [EligibilityController::class,'updateeligibilities'])->name('university-updateeligibilities')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  // Department
  Route::get('manage/departments', [DepartmentController::class,'managedepartments'])->name('university-managedepartments')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/save/departments', [DepartmentController::class,'savedepartments'])->name('university-savedepartments')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/update/departments', [DepartmentController::class,'updatedepartments'])->name('university-updatedepartments')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('/view/{id}/programs', [DepartmentController::class,'viewprograms'])->name('university-viewprograms')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('/view/departments', [DepartmentController::class,'viewdepartments'])->name('university-viewdepartments')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    // Program
    Route::get('manage/programs', [ProgramController::class,'manageprograms'])->name('university-manageprograms')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::post('/save/programs', [ProgramController::class,'saveprograms'])->name('university-saveprograms')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::post('/update/programs', [ProgramController::class,'updateprograms'])->name('university-updateprograms')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::get('/view/program/{id}', [ProgramController::class,'viewprogram'])->name('university-viewprogram')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::get('/view/programs', [ProgramController::class,'viewprograms'])->name('university-viewprogramsprograms')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::post('/update/program', [ProgramController::class,'updateprogram'])->name('university-updateprogram')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    // announcements
    Route::get('manage/announcements', [UniversityAnnouncementController::class,'manageannouncements'])->name('university-manageannouncements')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::post('/save/announcements', [UniversityAnnouncementController::class,'saveannouncements'])->name('university-saveannouncements')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::post('/update/announcements', [UniversityAnnouncementController::class,'updateannouncements'])->name('university-updateannouncements')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);

    // addmissions
    Route::get('manage/addmissions', [UniversityAddmissionController::class,'manageaddmissions'])->name('university-manageaddmissions')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::post('/save/addmissions', [UniversityAddmissionController::class,'saveaddmissions'])->name('university-saveaddmissions')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
    Route::post('/update/addmissions', [UniversityAddmissionController::class,'updateaddmissions'])->name('university-updateaddmissions')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
});


Route::group(['prefix' => 'user'], function () {
  Route::get('view/universityprofile/{id}', [UniversityProfileController::class,'userviewuniversityprofile'])->name('user-viewuniversityprofile')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('view/universities', [UniversityProfileController::class,'userviewuniversities'])->name('user-viewuniversities')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('university/view/programs/{id}', [ProgramController::class,'universityviewprograms'])->name('user-universityviewprograms')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('/university/view/program/{id}', [ProgramController::class,'universityviewprogram'])->name('user-universityviewprogram')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  // university/view/departments/{id} 
  Route::get('/university/view/departments/{id}', [DepartmentController::class,'universityviewdepartments'])->name('user-universitydepartments')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  // university/view/{{$department->id}}/programs
  Route::get('/university/view/{id}/programs', [DepartmentController::class,'universityviewdepartmentprograms'])->name('user-universityviewdepartmentprograms')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);

// Update user details
  Route::post('/upload/logo/', [UserDetailController::class,'uploadlogo'])->name('user-uploadlogo')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::post('/update/profile/', [UserDetailController::class,'updateprofile'])->name('user-updateprofile')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('/details/edit/', [UserDetailController::class,'detailsedit'])->name('user-detailsedit')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  // AppliedAdmissions
  Route::post('/appliedAdmission', [AppliedAdmissionController::class,'appliedadmission'])->name('user-appliedAdmission')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  Route::get('/appliedadmissions', [AppliedAdmissionController::class,'index'])->name('user-appliedAdmissions')->withoutMiddleware([EnsureUniversityIsValid::class, Authenticate::class]);
  
});






Route::get('/download/{file}', [DownloadsController::class, 'download'])->name('download');

/* Route Dashboards */
Route::group(['prefix' => 'request'], function () {
  Route::get('new', 'UniversityRequestController@new')->name('request-new');
  Route::post('save', 'UniversityRequestController@save')->name('request-save');
  Route::post('accept', 'UniversityRequestController@accept')->name('request-accept');
  Route::post('reject', 'UniversityRequestController@reject')->name('request-reject');
});
/* Route Dashboards */

/* Route Apps */
Route::group(['prefix' => 'app'], function () {
  Route::get('email', 'AppsController@emailApp')->name('app-email');
  Route::get('chat', 'AppsController@chatApp')->name('app-chat');
  Route::get('todo', 'AppsController@todoApp')->name('app-todo');
  Route::get('calendar', 'AppsController@calendarApp')->name('app-calendar');
  Route::get('kanban', 'AppsController@kanbanApp')->name('app-kanban');
  Route::get('invoice/list', 'AppsController@invoice_list')->name('app-invoice-list');
  Route::get('invoice/preview', 'AppsController@invoice_preview')->name('app-invoice-preview');
  Route::get('invoice/edit', 'AppsController@invoice_edit')->name('app-invoice-edit');
  Route::get('invoice/add', 'AppsController@invoice_add')->name('app-invoice-add');
  Route::get('invoice/print', 'AppsController@invoice_print')->name('app-invoice-print');
  Route::get('ecommerce/shop', 'AppsController@ecommerce_shop')->name('app-ecommerce-shop');
  Route::get('ecommerce/details', 'AppsController@ecommerce_details')->name('app-ecommerce-details');
  Route::get('ecommerce/wishlist', 'AppsController@ecommerce_wishlist')->name('app-ecommerce-wishlist');
  Route::get('ecommerce/checkout', 'AppsController@ecommerce_checkout')->name('app-ecommerce-checkout');
  Route::get('file-manager', 'AppsController@file_manager')->name('app-file-manager');
  Route::get('user/list', 'AppsController@user_list')->name('app-user-list');
  Route::get('user/view', 'AppsController@user_view')->name('app-user-view');
  Route::get('user/edit', 'AppsController@user_edit')->name('app-user-edit');
});
/* Route Apps */

/* Route UI */
Route::group(['prefix' => 'ui'], function () {
  Route::get('typography', 'UserInterfaceController@typography')->name('ui-typography');
  Route::get('colors', 'UserInterfaceController@colors')->name('ui-colors');
});
/* Route UI */

/* Route Icons */
Route::group(['prefix' => 'icons'], function () {
  Route::get('feather', 'UserInterfaceController@icons_feather')->name('icons-feather');
});
/* Route Icons */

/* Route Cards */
Route::group(['prefix' => 'card'], function () {
  Route::get('basic', 'CardsController@card_basic')->name('card-basic');
  Route::get('advance', 'CardsController@card_advance')->name('card-advance');
  Route::get('statistics', 'CardsController@card_statistics')->name('card-statistics');
  Route::get('analytics', 'CardsController@card_analytics')->name('card-analytics');
  Route::get('actions', 'CardsController@card_actions')->name('card-actions');
});
/* Route Cards */

/* Route Components */
Route::group(['prefix' => 'component'], function () {
  Route::get('alert', 'ComponentsController@alert')->name('component-alert');
  Route::get('avatar', 'ComponentsController@avatar')->name('component-avatar');
  Route::get('badges', 'ComponentsController@badges')->name('component-badges');
  Route::get('breadcrumbs', 'ComponentsController@breadcrumbs')->name('component-breadcrumbs');
  Route::get('buttons', 'ComponentsController@buttons')->name('component-buttons');
  Route::get('carousel', 'ComponentsController@carousel')->name('component-carousel');
  Route::get('collapse', 'ComponentsController@collapse')->name('component-collapse');
  Route::get('divider', 'ComponentsController@divider')->name('component-divider');
  Route::get('dropdowns', 'ComponentsController@dropdowns')->name('component-dropdowns');
  Route::get('list-group', 'ComponentsController@list_group')->name('component-list-group');
  Route::get('modals', 'ComponentsController@modals')->name('component-modals');
  Route::get('pagination', 'ComponentsController@pagination')->name('component-pagination');
  Route::get('navs', 'ComponentsController@navs')->name('component-navs');
  Route::get('tabs', 'ComponentsController@tabs')->name('component-tabs');
  Route::get('timeline', 'ComponentsController@timeline')->name('component-timeline');
  Route::get('pills', 'ComponentsController@pills')->name('component-pills');
  Route::get('tooltips', 'ComponentsController@tooltips')->name('component-tooltips');
  Route::get('popovers', 'ComponentsController@popovers')->name('component-popovers');
  Route::get('pill-badges', 'ComponentsController@pill_badges')->name('component-pill-badges');
  Route::get('progress', 'ComponentsController@progress')->name('component-progress');
  Route::get('media-objects', 'ComponentsController@media_objects')->name('component-media-objects');
  Route::get('spinner', 'ComponentsController@spinner')->name('component-spinner');
  Route::get('toast', 'ComponentsController@toast')->name('component-toast');
});
/* Route Components */

/* Route Extensions */
Route::group(['prefix' => 'ext-component'], function () {
  Route::get('sweet-alerts', 'ExtensionController@sweet_alert')->name('ext-component-sweet-alerts');
  Route::get('block-ui', 'ExtensionController@block_ui')->name('ext-component-block-ui');
  Route::get('toastr', 'ExtensionController@toastr')->name('ext-component-toastr');
  Route::get('slider', 'ExtensionController@slider')->name('ext-component-slider');
  Route::get('drag-drop', 'ExtensionController@drag_drop')->name('ext-component-drag-drop');
  Route::get('tour', 'ExtensionController@tour')->name('ext-component-tour');
  Route::get('clipboard', 'ExtensionController@clipboard')->name('ext-component-clipboard');
  Route::get('plyr', 'ExtensionController@plyr')->name('ext-component-plyr');
  Route::get('context-menu', 'ExtensionController@context_menu')->name('ext-component-context-menu');
  Route::get('swiper', 'ExtensionController@swiper')->name('ext-component-swiper');
  Route::get('tree', 'ExtensionController@tree')->name('ext-component-tree');
  Route::get('ratings', 'ExtensionController@ratings')->name('ext-component-ratings');
  Route::get('locale', 'ExtensionController@locale')->name('ext-component-locale');
});
/* Route Extensions */

/* Route Page Layouts */
Route::group(['prefix' => 'page-layouts'], function () {
  Route::get('collapsed-menu', 'PageLayoutController@layout_collapsed_menu')->name('layout-collapsed-menu');
  Route::get('boxed', 'PageLayoutController@layout_boxed')->name('layout-boxed');
  Route::get('without-menu', 'PageLayoutController@layout_without_menu')->name('layout-without-menu');
  Route::get('empty', 'PageLayoutController@layout_empty')->name('layout-empty');
  Route::get('blank', 'PageLayoutController@layout_blank')->name('layout-blank');
});
/* Route Page Layouts */

/* Route Forms */
Route::group(['prefix' => 'form'], function () {
  Route::get('input', 'FormsController@input')->name('form-input');
  Route::get('input-groups', 'FormsController@input_groups')->name('form-input-groups');
  Route::get('input-mask', 'FormsController@input_mask')->name('form-input-mask');
  Route::get('textarea', 'FormsController@textarea')->name('form-textarea');
  Route::get('checkbox', 'FormsController@checkbox')->name('form-checkbox');
  Route::get('radio', 'FormsController@radio')->name('form-radio');
  Route::get('switch', 'FormsController@switch')->name('form-switch');
  Route::get('select', 'FormsController@select')->name('form-select');
  Route::get('number-input', 'FormsController@number_input')->name('form-number-input');
  Route::get('file-uploader', 'FormsController@file_uploader')->name('form-file-uploader');
  Route::get('quill-editor', 'FormsController@quill_editor')->name('form-quill-editor');
  Route::get('date-time-picker', 'FormsController@date_time_picker')->name('form-date-time-picker');
  Route::get('layout', 'FormsController@layouts')->name('form-layout');
  Route::get('wizard', 'FormsController@wizard')->name('form-wizard');
  Route::get('validation', 'FormsController@validation')->name('form-validation');
  Route::get('repeater', 'FormsController@form_repeater')->name('form-repeater');
});
/* Route Forms */

/* Route Tables */
Route::group(['prefix' => 'table'], function () {
  Route::get('', 'TableController@table')->name('table');
  Route::get('datatable/basic', 'TableController@datatable_basic')->name('datatable-basic');
  Route::get('datatable/advance', 'TableController@datatable_advance')->name('datatable-advance');
  Route::get('ag-grid', 'TableController@ag_grid')->name('ag-grid');
});
/* Route Tables */

/* Route Pages */
Route::group(['prefix' => 'page'], function () {
  Route::get('account-settings', 'PagesController@account_settings')->name('page-account-settings');
  Route::get('profile', 'PagesController@profile')->name('page-profile');
  Route::get('faq', 'PagesController@faq')->name('page-faq');
  Route::get('knowledge-base', 'PagesController@knowledge_base')->name('page-knowledge-base');
  Route::get('knowledge-base/category', 'PagesController@kb_category')->name('page-knowledge-base');
  Route::get('knowledge-base/category/question', 'PagesController@kb_question')->name('page-knowledge-base');
  Route::get('pricing', 'PagesController@pricing')->name('page-pricing');
  Route::get('blog/list', 'PagesController@blog_list')->name('page-blog-list');
  Route::get('blog/detail', 'PagesController@blog_detail')->name('page-blog-detail');
  Route::get('blog/edit', 'PagesController@blog_edit')->name('page-blog-edit');

  // Miscellaneous Pages With Page Prefix
  Route::get('coming-soon', 'MiscellaneousController@coming_soon')->name('misc-coming-soon');
  Route::get('not-authorized', 'MiscellaneousController@not_authorized')->name('misc-not-authorized');
  Route::get('maintenance', 'MiscellaneousController@maintenance')->name('misc-maintenance');
});
/* Route Pages */
Route::get('/error', 'MiscellaneousController@error')->name('error');

/* Route Authentication Pages */
Route::group(['prefix' => 'auth'], function () {
  Route::get('login-v1', 'AuthenticationController@login_v1')->name('auth-login-v1');
  Route::get('login-v2', 'AuthenticationController@login_v2')->name('auth-login-v2');
  Route::get('register-v1', 'AuthenticationController@register_v1')->name('auth-register-v1');
  Route::get('register-v2', 'AuthenticationController@register_v2')->name('auth-register-v2');
  Route::get('forgot-password-v1', 'AuthenticationController@forgot_password_v1')->name('auth-forgot-password-v1');
  Route::get('forgot-password-v2', 'AuthenticationController@forgot_password_v2')->name('auth-forgot-password-v2');
  Route::get('reset-password-v1', 'AuthenticationController@reset_password_v1')->name('auth-reset-password-v1');
  Route::get('reset-password-v2', 'AuthenticationController@reset_password_v2')->name('auth-reset-password-v2');
  Route::get('lock-screen', 'AuthenticationController@lock_screen')->name('auth-lock_screen');
});
/* Route Authentication Pages */

/* Route Charts */
Route::group(['prefix' => 'chart'], function () {
  Route::get('apex', 'ChartsController@apex')->name('chart-apex');
  Route::get('chartjs', 'ChartsController@chartjs')->name('chart-chartjs');
  Route::get('echarts', 'ChartsController@echarts')->name('chart-echarts');
});
/* Route Charts */

// map leaflet
Route::get('/maps/leaflet', 'ChartsController@maps_leaflet')->name('map-leaflet');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
