<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryStepController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\ChildController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\FamilyMemberController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TeacherVideoController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\TutorialController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\IdeaController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController as DashboardProfileController;
use App\Http\Controllers\Dashboard\PortfolioController as DashboardPortfolioController;
use App\Http\Controllers\Dashboard\ProjectController as DashboardProjectController;
use App\Http\Controllers\HomeController;

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
// admin routes
Route::get('admin/login', [AdminController::class, 'getLogin']);
Route::post('admin/login', [AdminController::class, 'postLogin']);
Route::get('admin/not_allow', [AdminController::class, 'not_allow']);
Route::group(array('prefix' => 'admin', 'middleware' => ['admin']), function () {
    Route::resource('profile', ProfileController::class);
    Route::resource('site', SiteController::class)->middleware('role:site_edit');
    Route::resource('social_media', SocialMediaController::class)->middleware('role:social_media_all,social_media_edit');
    Route::resource('currencies', CurrencyController::class)->middleware('role:currencies_all,currencies_edit');
    Route::resource('countries', CountryController::class)->middleware('role:countries_all,countries_edit');
    Route::resource('log', LogController::class)->middleware('role:log_all');
    Route::resource('notifications', NotificationsController::class)->middleware('role:notifications_all,notifications_add');
    Route::resource('groups', GroupController::class)->middleware('role:groups_all,groups_add,groups_edit,groups_delete');
    Route::resource('admins', AdminsController::class)->middleware('role:admins_all,admins_add,admins_edit,admins_delete');
    Route::resource('users', UserController::class)->middleware('role:users_all,users_add,users_edit,users_delete');
    Route::resource('visitors', VisitorController::class)->middleware('role:visitors_all');
    Route::resource('categories', CategoryController::class)->middleware('role:categories_all,categories_add,categories_edit,categories_delete');
    Route::resource('categories_steps', CategoryStepController::class)->middleware('role:categories_all,categories_add,categories_edit,categories_delete');
    Route::resource('companies', CompanyController::class)->middleware('role:companies_all,companies_add,companies_edit');
    Route::resource('portfolio', PortfolioController::class)->middleware('role:portfolio_all,portfolio_add,portfolio_show,portfolio_edit,portfolio_delete');
    Route::resource('projects', ProjectController::class)->middleware('role:projects_all,projects_add,projects_show,projects_edit');
    Route::resource('gifts', GiftController::class)->middleware('role:gifts_all,gifts_add,gifts_delete,gifts_edit');
    Route::resource('childern', ChildController::class)->middleware('role:childern_all,childern_add,childern_show,childern_edit');
    Route::resource('families', FamilyController::class)->middleware('role:families_all,families_add,families_show,families_edit');
    Route::resource('families_members', FamilyMemberController::class)->middleware('role:families_all,families_add,families_show,families_edit');
    Route::resource('teachers', TeacherController::class)->middleware('role:teachers_all,teachers_add,teachers_show,teachers_edit');
    Route::resource('teachers_videos', TeacherVideoController::class)->middleware('role:teachers_all,teachers_add,teachers_show,teachers_edit');
    Route::resource('donations', DonationController::class)->middleware('role:donations_all');

    Route::resource('tutorials', TutorialController::class)->middleware('role:tutorials_all,tutorial_adds,tutorials_edit,tutorials_delete');
    Route::resource('ads', AdsController::class)->middleware('role:ads_all,ads_add,ads_edit,ads_delete');
    Route::resource('slider', SliderController::class)->middleware('role:slider_all,slider_add,slider_edit,slider_delete');
    Route::resource('pages', PageController::class)->middleware('role:pages_all,pages_add,pages_edit,pages_delete');
    Route::resource('contact', ContactController::class)->middleware('role:contact_all,contact_edit,contact_delete');
    Route::resource('ideas', IdeaController::class)->middleware('role:ideas_all,ideas_edit,ideas_delete');

    Route::get('ajax_categories_steps/{id}', [AdminController::class, 'ajax_categories_steps']);
    Route::get('teachers_reports/{id}', [TeacherController::class, 'teachers_reports']);
    Route::get('families_reports/{id}', [FamilyController::class, 'families_reports']);
    Route::get('childern_reports/{id}', [ChildController::class, 'childern_reports']);
    Route::get('projects_reports/{id}', [ProjectController::class, 'projects_reports']);
    Route::get('delete_portfolio_image/{id}', [PortfolioController::class, 'delete_image']);
    Route::post('delete_all/{type}', [AdminController::class, 'delete_all']);
    Route::get('edit_active/{type}/{id}', [AdminController::class, 'edit_active']);
    Route::get('logout', [AdminController::class, 'logout']);
    Route::get('/', [AdminController::class, 'index']);
});

// dashboard routes
Route::get('dashboard/login', [DashboardController::class, 'getLogin']);
Route::post('dashboard/login', [DashboardController::class, 'postLogin']);
Route::get('dashboard/not_allow', [DashboardController::class, 'not_allow']);
Route::group(array('prefix' => 'dashboard', 'middleware' => ['dashboard']), function () {
    Route::resource('profile', DashboardProfileController::class);
    Route::resource('portfolio', DashboardPortfolioController::class);
    Route::resource('projects', DashboardProjectController::class);

    Route::get('ajax_categories_steps/{id}', [DashboardController::class, 'ajax_categories_steps']);
    Route::get('logout', [DashboardController::class, 'logout']);
    Route::get('/', [DashboardController::class, 'index']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('lang', [HomeController::class, 'language']);
Route::get('currency/{id}', [HomeController::class, 'currency']);
Route::get('subscribe', [HomeController::class, 'subscribe']);
Route::post('login', [HomeController::class, 'login']);
Route::post('register', [HomeController::class, 'register']);
Route::post('forget_password', [HomeController::class, 'forget_password']);
Route::get('logout', [HomeController::class, 'logout']);
Route::get('page/{id}', [HomeController::class, 'page']);
Route::get('contact', [HomeController::class, 'contact_get']);
Route::post('contact', [HomeController::class, 'contact_post']);
Route::get('idea', [HomeController::class, 'idea_get']);
Route::post('idea', [HomeController::class, 'idea_post']);
Route::get('childern', [HomeController::class, 'childern']);
Route::get('child/{id}', [HomeController::class, 'child']);
Route::get('ajax_country/{id}', [HomeController::class, 'ajax_country']);
Route::get('families', [HomeController::class, 'families']);
Route::get('family/{id}', [HomeController::class, 'family']);
Route::get('teachers', [HomeController::class, 'teachers']);
Route::get('teacher/{id}', [HomeController::class, 'teacher']);
Route::post('donation/{type}/{id}', [HomeController::class, 'donation']);
Route::post('gift/{type}/{id}', [HomeController::class, 'gift']);
Route::get('payment_result', [HomeController::class, 'payment_result']);
Route::get('sponsorships', [HomeController::class, 'sponsorships']);
Route::get('profile', [HomeController::class, 'profile_get']);
Route::post('profile', [HomeController::class, 'profile_post']);
Route::get('my_childern', [HomeController::class, 'my_childern']);
Route::get('my_families', [HomeController::class, 'my_families']);
Route::get('my_teachers', [HomeController::class, 'my_teachers']);
Route::get('pay/{id}', [HomeController::class, 'pay']);
Route::get('donation_edit/{active}/{id}', [HomeController::class, 'donation_edit']);
Route::get('calculator', [HomeController::class, 'calculator']);
Route::get('projects', [HomeController::class, 'projects']);
Route::get('category/{id}', [HomeController::class, 'category']);
Route::get('project/{id}', [HomeController::class, 'project']);
Route::get('my_projects_donations', [HomeController::class, 'my_projects_donations']);
Route::get('my_projects', [HomeController::class, 'my_projects']);
Route::get('project_add', [HomeController::class, 'project_add_get']);
Route::post('project_add', [HomeController::class, 'project_add_post']);
Route::post('donate', [HomeController::class, 'donate']);
Route::get('delayed_donations', [HomeController::class, 'delayed_donations']);