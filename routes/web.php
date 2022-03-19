<?php

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

//DEFAULT GENERATED CODE:
// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/', function () {
//     return view('pages.home');
// });

//SAMPLES ONLY HERE:
// Route::get('/about', function () {
//     return view('pages.about');
// });

// Route::get('/hello', function () {
//     return "hello there!!! am ivy";
// });

// Route::get('/hello/{id}', function ($id) {
//     return "hello there!!! I am $id";
// });

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SendGmailController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/email/verify', function () {
    return view('verification.verify');
})->middleware('auth');

Route::get('/', function () {
    return view('index');
})->middleware('guest');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//password reset
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


//USERS ROUTE

Route::get('/register/organization', [HomeController::class, 'register_org'])->name('register_org');
Route::get('/demo', [HomeController::class,'demoonly']);
Route::get('/demo2', [HomeController::class,'demoonly2']);

//To verify email
Route::group(['middleware' => ['auth']], function() {

    Route::get('/email/verify', [VerificationController::class,'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', [VerificationController::class,'resend'])->name('verification.resend');

});

//email dashboard controller
Route::group(['middleware' => ['auth']], function() {
    //only verified account can access with this group
    Route::group(['middleware' => ['verified']], function() {

            //layout
            Route::get('/home/layout', [PostsController::class,'userLayout'])->middleware('role:USER');

            //home page / feed / all post
            Route::get('/home', [PostsController::class, 'index'])->name('home')->middleware('role:USER');

            Route::resource('/page', PostsController::class)->middleware('role:USER');
            Route::get('/about', [PagesController::class,'about']);
            Route::get('/services', [PagesController::class,'services']);
            Route::get('/pages/home2', [PagesController::class,'home2']);
            Route::get('/activity/you-donated', [PagesController::class,'activitiesDonated'])->middleware('role:USER');;
            Route::get('/activity/you-received', [PagesController::class,'activitiesReceived'])->middleware('role:USER');;
            Route::get('/location/filter', [PagesController::class,'filterByLocation'])->name('filterlocation')->middleware('role:USER');
            Route::get('/location/filter=All/', [PagesController::class,'preFilterByLocation'])->name('filterlocation2')->middleware('role:USER');
            Route::get('/leaderboards', [PagesController::class,'leaderboardBarangay'])->middleware('role:USER');
            

            Route::get('/home', [PostsController::class,'index'])->middleware('role:USER');
            Route::resource('/home', PostsController::class)->middleware('role:USER');
            Route::get('/home/{home?}/edit', [PostsController::class,'edit'])->middleware('role:USER');

            //Route::get('/post/postid?={post}', [PostsController::class,'show']);

            Route::get('/search/', [PostsController::class,'search'])->name('search')->middleware('role:USER');

            //not final or practice lang 
            Route::get('/try/settings', [PostsController::class,'settingsTopNav'])->middleware('role:USER');
            
            Route::post('/user/profile/post', [PostsController::class,'storeFromTimeline'])->middleware('role:USER');

            Route::resource('users', UsersController::class)->middleware('role:USER');
            Route::get('/users/user/home', [UsersController::class,'home'])->middleware('role:USER');
            Route::get('/users/user/userTopNav', [UsersController::class,'userTopNav'])->middleware('role:USER');
            Route::get('/users/{user}/change_password', [UsersController::class,'viewChangePassword'])->middleware('role:USER');

            //for profile timeline
            Route::get('/users/profile/{user}', [UsersController::class,'viewTimeline'])->middleware('role:USER');;

            Route::get('/users/settings/{user}', [UsersController::class,'general_settings'])->middleware('role:USER');
            //Route::get('/changePassword', [UsersController::class, 'typepassword'])->name('changePasswordGet');
            Route::post('/changePassword', [UsersController::class, 'password_verification'])->name('changePasswordPost')->middleware('role:USER');

            Route::post('/request-verification', [UsersController::class, 'request_verification'])->name('request_verification')->middleware('role:USER');
            Route::get('/request-deletion', [UsersController::class, 'request_deletion'])->name('request_deletion')->middleware('role:USER');


            Route::resource('transaction', TransactionController::class)->middleware('role:USER');
            Route::resource('comment', CommentController::class)->middleware('role:USER');
            Route::resource('like', LikeController::class)->middleware('role:USER');
            Route::resource('share', ShareController::class)->middleware('role:USER');
            Route::resource('follow', FollowController::class)->middleware('role:USER');
            Route::post('/follow2', [FollowController::class, 'store2'])->middleware('role:USER');
            Route::post('/follow', [FollowController::class, 'store'])->middleware('role:USER');

            Route::get('/notification', [PostsController::class, 'thisnotif'])->name('thisnotif')->middleware('role:USER');

            
            Route::get('/payment/', [TransactionController::class,'payment1']);
            Route::get('/payment2/', [TransactionController::class,'payment2']);

            Route::get('badge/save', [BadgeController::class,'store2'])->name('badge_save')->middleware('role:USER');
            Route::get('badge/remove', [BadgeController::class,'destroy2'])->name('badge_delete')->middleware('role:USER');

            Route::get('report', [ReportController::class,'report'])->name('report')->middleware('role:USER');

            //message inquiry
            Route::get('inquiry_message', [InquiryController::class,'show1'])->middleware('role:USER');
            Route::get('inquiry_message/message', [InquiryController::class,'inquiryUser'])->name('inquiryToAdmin')->middleware('role:USER');
    });
});

//ADMIN ROUTES

Route::group(['middleware' => ['auth']], function() {
    //only verified account can access with this group
    Route::group(['middleware' => ['verified']], function() {

        Route::get('/admin', [AdminController::class,'adminhome'])->name('Dashboard')->middleware('role:ADMIN');
        Route::get('/admin/users', [AdminController::class,'adminUsersTable'])->name('People')->middleware('role:ADMIN');
        Route::get('/admin/organization', [AdminController::class,'adminOrgsTable'])->name('Organization')->middleware('role:ADMIN');
        Route::get('/admin/posts', [AdminController::class,'adminPostsTable'])->name('Posts')->middleware('role:ADMIN');
        Route::get('/admin/settings', [AdminController::class,'adminSettings'])->name('Settings')->middleware('role:ADMIN');
        Route::get('/verify-account/', [AdminController::class,'adminVerifyUser'])->name('admin_verify_user')->middleware('role:ADMIN');
        Route::get('/verify-post/', [AdminController::class,'adminVerifyPost'])->name('admin_verify_post')->middleware('role:ADMIN');
        Route::get('/ban/', [AdminController::class,'adminBan'])->name('admin_ban')->middleware('role:ADMIN');
        Route::get('/admin/leaderboards', [AdminController::class,'adminLeaderboards'])->name('Users Leaderboards')->middleware('role:ADMIN');
        Route::get('/admin/reports/users', [AdminController::class,'adminReportsUsers'])->name('Manage Reports')->middleware('role:ADMIN');
        Route::get('/admin/reports/posts', [AdminController::class,'adminReportsPosts'])->name('Manage Reports 2')->middleware('role:ADMIN');
        Route::get('/admin/reports/comments', [AdminController::class,'adminReportsComments'])->name('Manage Reports 3')->middleware('role:ADMIN');
        Route::get('/admin/logs', [AdminController::class,'adminLogs'])->name('Logs')->middleware('role:ADMIN');
        Route::get('/admin/comment-review', [AdminController::class,'reviewComment'])->name('comment_review')->middleware('role:ADMIN');
        Route::get('/admin/set-admin', [AdminController::class,'make_admin'])->name('make_admin')->middleware('role:ADMIN');

        //message inquiry
        Route::get('/admin/inquiry_message/', [InquiryController::class,'show2'])->name('Users Inquiries')->middleware('role:ADMIN');
        Route::get('/admin/inquiry_message/message/', [InquiryController::class,'inquiryAdmin'])->name('inquiryToUser')->middleware('role:ADMIN');

        //to pdf
        Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
        Route::get('/generate-admin-users-pdf/', [PDFController::class, 'adminUsersPDF'])->name('admin_users_pdf')->middleware('role:ADMIN');
        Route::get('/generate-admin-orgs-pdf/', [PDFController::class, 'adminOrgsPDF'])->name('admin_orgs_pdf')->middleware('role:ADMIN');
        Route::get('/generate-admin-posts-pdf/', [PDFController::class, 'adminPostsPDF'])->name('admin_posts_pdf')->middleware('role:ADMIN');

        //stats
        Route::get('admin/stats', [AdminController::class,'stats'])->name('Donation Monitoring')->middleware('role:ADMIN');

        //admin layout
        Route::get('admin/layout', [AdminController::class,'adminLayout'])->middleware('role:ADMIN');

        //to delete
        Route::get('/delete', [AdminController::class, 'deleteSelected'])->name('admin_delete')->middleware('role:ADMIN');
    });
});