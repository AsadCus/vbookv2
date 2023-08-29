<?php

use App\Events\HelloEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\MonitorController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\guest\GuestController;
use App\Http\Controllers\pantry\FoodController;
use App\Http\Controllers\room\AuthRoomController;
use App\Http\Controllers\admin\DivisionController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MergeRoomController;
use App\Http\Controllers\guest\AuthGuestController;
use App\Http\Controllers\room\ScanQrcodeController;
use App\Http\Controllers\user\AuthGoogleController;
use App\Http\Controllers\pantry\AuthPantryController;
use App\Http\Controllers\admin\ManageRoomController;
use App\Http\Controllers\admin\ManageUserController;
use App\Http\Controllers\admin\SettingWebController;
use App\Http\Controllers\user\BookingRoomController;
use App\Http\Controllers\superadmin\DeviceController;
use App\Http\Controllers\room\RoomDashboardController;
use App\Http\Controllers\superadmin\LicenceController;
use App\Http\Controllers\user\AuthMicrosoftController;
use App\Http\Controllers\user\UserDashboardController;
use App\Http\Controllers\admin\ReportBookingController;
use App\Http\Controllers\pantry\FoodCategoryController;
use App\Http\Controllers\pantry\FoodOrderingController;
use App\Http\Controllers\user\HistoryBookingController;
use App\Http\Controllers\user\SearchRoomUserController;
use App\Http\Controllers\user\DisplayAttendedController;
use App\Http\Controllers\user\RecurringBookingController;
use App\Http\Controllers\user\ParticipantConfirmController;
use App\Http\Controllers\admin\ManageReceptionistController;
use App\Http\Controllers\guest\CreateBookingGuestController;
use App\Http\Controllers\guest\SearchBookingGuestController;
use App\Http\Controllers\receptionist\ManageGuestController;
use App\Http\Controllers\superadmin\ManageCompanyController;
use App\Http\Controllers\user\ParticipantAttendedController;
use App\Http\Controllers\receptionist\ReceptionistController;
use App\Http\Controllers\superadmin\AuthSuperadminController;
use App\Http\Controllers\receptionist\ActivityGuestController;
use App\Http\Controllers\superadmin\SettingSuperadminController;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;
use App\Http\Controllers\receptionist\AuthReceptionistController;
use App\Http\Controllers\superadmin\DashboardSuperadminController;

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



Route::get('/send-event', function () {
    broadcast(new HelloEvent());
});


/*
|--------------------------------------------------------------------------
| OPTIMIZE WEBSITE 🟢
|--------------------------------------------------------------------------
*/
Route::get('/optimize', function () {
    Artisan::call('optimize:clear');
    return redirect()->route('superadmin-setting.index')->with('success', 'your website is successfully optimized');
});
/*
|--------------------------------------------------------------------------
| END OPTIMIZE WEBSITE 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE LOGIN 🟢
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->prefix('/admin')->group(function () {
    Route::get('/login', 'loginAdmin')->name('admin.login');
    Route::post('/login', 'authenticate')->name('admin.authenticate');
    Route::get('/logout', 'logout')->name('admin.logout');
});

Route::controller(AuthSuperadminController::class)->prefix('/suadmin')->group(function () {
    Route::get('/login', 'loginAdmin')->name('suadmin.login');
    Route::post('/login', 'authenticate')->name('suadmin.authenticate');
    Route::get('/logout', 'logout')->name('suadmin.logout');
});

Route::controller(AuthGoogleController::class)->prefix('/')->group(function () {
    Route::get('/login', 'index')->name('user.login');
    Route::get('auth/google', 'redirectToGoogle')->name('user-google.login');
    Route::get('auth/google/callback', 'handleGoogleCallback')->name('user-google.callback');
});

Route::controller(AuthMicrosoftController::class)->prefix('/')->group(function () {
    Route::get('auth/microsoft', 'redirectToMicrosoft')->name('user-microsoft.login');
    Route::get('auth/callback-azure', 'handleMicrosoftCallback')->name('user-microsoft.callback');
});

Route::controller(AuthReceptionistController::class)->prefix('/receptionist')->group(function () {
    Route::get('/login', 'login')->name('receptionist.login');
    Route::get('/logout', 'logout')->name('receptionist.logout');
    Route::post('/login', 'authenticate')->name('receptionist.authenticate');
});

Route::controller(AuthGuestController::class)->prefix('/guest-booking')->group(function () {
    Route::get('/login', 'login')->name('guest-booking.login');
    Route::get('/logout', 'logout')->name('guest-booking.logout');
    Route::post('/login', 'authenticate')->name('guest-booking.authenticate');
});

Route::controller(AuthRoomController::class)->prefix('/room')->group(function () {
    Route::get('/login', 'index')->name('room.login');
    Route::post('/login', 'authenticate_room')->name('room.authenticate');
    Route::get('/logout', 'logout')->name('room.logout');
});

Route::controller(AuthPantryController::class)->prefix('/pantry')->group(function () {
    Route::get('/login', 'loginAdmin')->name('pantry.login');
    Route::post('/login', 'authenticate')->name('pantry.authenticate');
    Route::get('/logout', 'logout')->name('pantry.logout');
});
/*
|--------------------------------------------------------------------------
| END ROUTE LOGIN 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE ATTENDED 🟢
|--------------------------------------------------------------------------
*/
Route::controller(ParticipantConfirmController::class)->prefix('/confirmation')->group(function () {
    Route::get('/present', 'present')->name('user.email-present');
    Route::get('/not-present', 'not_present')->name('user.email-not-present');
});

Route::controller(ParticipantAttendedController::class)->prefix('/participants-attended')->group(function () {
    Route::get('/{id}/presence', 'index')->name('user.present');
    Route::post('/presence', 'attendanceQrCode')->name('user.present-post');
});

Route::controller(ScanQrcodeController::class)->prefix('/attendance')->group(function () {
        Route::get('/', 'attendance')->name('attendance.scan');
        Route::post('/post', 'postAttendance')->name('attendance.post');
        Route::get('/qr', 'qr');
    });

Route::controller(DisplayAttendedController::class)->prefix('/participants-attended')->group(function () {
    Route::get('/{id}/display-presence', 'index')->name('display.present');
    Route::post('/display-presence', 'attendanceQrCode')->name('display.present-post');
});
/*
|--------------------------------------------------------------------------
| END ROUTE ATTENDED 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE PAGE SUPERADMIN 🟢
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'suadmin'], function () {
    Route::controller(DashboardSuperadminController::class)->prefix('/suadmin')->group(function () {
        Route::get('/', 'index')->name('suadmin.dashboard');
    });

    Route::controller(ManageCompanyController::class)->prefix('/suadmin/manage-company')->group(function () {
        Route::get('/', 'index')->name('manage-company.index');
        Route::get('/create', 'create')->name('manage-company.create');
        Route::get('/{id}/detail', 'detail')->name('manage-company.detail');
        Route::get('/{id}/edit', 'edit')->name('manage-company.edit');
        Route::post('/{id}/update', 'update')->name('manage-company.update');
        Route::post('/', 'store')->name('manage-company.strore');
        Route::delete('/{id}', 'destroy')->name('manage-company.destroy');
    });


    Route::controller(SettingSuperadminController::class)->prefix('/suadmin/setting')->group(function () {
        Route::get('/', 'index')->name('superadmin-setting.index');
        Route::post('/{id}/reset-password', 'update')->name('superadmin-setting.update-password');
    });

    Route::controller(LicenceController::class)->prefix('/suadmin/licence')->group(function () {
        Route::get('/', 'index')->name('superadmin-licence.index');
        Route::post('/{id}/update', 'update')->name('superadmin-licence.update');
    });

    Route::controller(DeviceController::class)->prefix('/suadmin/device')->group(function () {
        Route::get('/', 'index')->name('device-admin.index');
        Route::get('/create', 'create')->name('device-admin.create');
        Route::post('/', 'store')->name('device-admin.post');
        Route::post('/{id}/edit', 'update')->name('device-admin.update');
        Route::delete('/{id}', 'destroy')->name('device-admin.destroy');
    });

    // Route::controller(HealthCheckResultsController::class)->prefix('/suadmin/health')->group(function () {
    //     Route::get('/', 'health')->name('health.index');
    // });

    Route::get('health', HealthCheckResultsController::class);
});
/*
|--------------------------------------------------------------------------
| END ROUTE PAGE SUPERADMIN 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE PAGE ADMIN 🟢
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'admin'], function () {
    Route::controller(DashboardController::class)->prefix('/admin')->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
    });

    Route::controller(ManageRoomController::class)->prefix('/admin/manage-room')->group(function () {
        Route::get('/', 'index')->name('manage-room.index');
        Route::get('/create', 'create')->name('manage-room.create');
        Route::get('/{id}/detail', 'detail')->name('manage-room.detail');
        Route::get('/{id}/edit', 'edit')->name('manage-room.edit');
        Route::get('/{id}/edit-api', 'editApi')->name('manage-room.edit.api');
        Route::post('/{id}/update', 'update')->name('manage-room.update');
        Route::post('/{id}/update-api', 'updateApi')->name('manage-room.update.api');
        Route::post('/', 'store')->name('manage-room.strore');
        Route::delete('/{id}', 'destroy')->name('manage-room.destroy');
    });

    Route::controller(FoodController::class)->prefix('/admin/manage-food')->group(function () {
        Route::get('/', 'index')->name('manage-food.index');
        Route::get('/{id}/detail', 'detail')->name('manage-food.detail');
        Route::get('/{id}/edit', 'edit')->name('manage-food.edit');
        Route::post('/{id}/update', 'update')->name('manage-food.update');
        Route::post('/', 'store')->name('manage-food.store');
        Route::delete('/{id}', 'destroy')->name('manage-food.destroy');
    });

    Route::controller(FoodCategoryController::class)->prefix('/admin/manage-food-categories')->group(function () {
        Route::get('/', 'index')->name('manage-food-categories.index');
        Route::post('/{id}/update', 'update')->name('manage-food-categories.update');
        Route::post('/', 'store')->name('manage-food-categories.store');
        Route::delete('/{id}', 'destroy')->name('manage-food-categories.destroy');
    });

    Route::controller(FoodOrderingController::class)->prefix('/manage-food-ordering')->group(function () {
        Route::post('/store', 'store')->name('manage-food-ordering.store');
    });

    Route::controller(MergeRoomController::class)->prefix('/admin/merge-room')->group(function () {
        Route::get('/', 'index')->name('merge-room.index');
        Route::get('/create', 'create')->name('merge-room.create');
        Route::get('/{id}/detail', 'detail')->name('merge-room.detail');
        Route::get('/{id}/edit', 'edit')->name('merge-room.edit');
        Route::post('/{id}/update', 'update')->name('merge-room.update');
        Route::post('/', 'store')->name('merge-room.strore');
        Route::delete('/{id}', 'destroy')->name('merge-room.destroy');
    });

    Route::controller(ManageUserController::class)->prefix('/admin/manage-user')->group(function () {
        Route::get('/', 'index')->name('manage-user.index');
        Route::get('/create', 'create')->name('manage-user.create');
        Route::get('/{id}/detail', 'detail')->name('manage-user.detail');
        Route::post('/{id}/edit', 'update')->name('manage-user.edit');
        Route::post('/', 'store')->name('manage-user.strore');
        Route::delete('/{id}', 'destroy')->name('manage-user.destroy');
        Route::get('/template', 'export_excel')->name('manage-user.excel');
        Route::post('/upload-user', 'import_excel')->name('manage-user.upload');
    });

    Route::controller(SettingWebController::class)->prefix('/admin/setting')->group(function () {
        Route::get('/', 'index')->name('seeting-admin.index');
        Route::get('/{id}/license', 'license')->name('seeting-admin.license');
        Route::get('/{id}/edit', 'edit')->name('seeting-admin.edit');
        Route::post('/{id}/update', 'update')->name('seeting-admin.update');
    });

    Route::controller(ReportBookingController::class)->prefix('/admin/report')->group(function () {
        Route::get('/', 'index')->name('report-booking.index');
        Route::get('/excel', 'export_excel')->name('report-booking.excel');
        Route::post('/{id}/edit', 'update')->name('report-booking.edit');
    });

    Route::controller(DivisionController::class)->prefix('/admin/manage-division')->group(function () {
        Route::get('/', 'index')->name('manage-division.index');
        Route::post('/', 'store')->name('manage-division.post');
        Route::post('/{id}/edit', 'update')->name('manage-division.edit');
        Route::delete('/{id}', 'destroy')->name('manage-user.destroy');
    });

    Route::controller(ManageReceptionistController::class)->prefix('/admin/manage-receptionist')->group(function () {
        Route::get('/', 'index')->name('manage-receptionist.index');
        Route::get('/create', 'create')->name('manage-receptionist.create');
        Route::post('/', 'store')->name('manage-receptionist.post');
        Route::post('/{id}/edit', 'update')->name('manage-receptionist.edit');
    });
    
    Route::controller(MonitorController::class)->prefix('/admin/monitor')->group(function () {
        Route::get('/', 'index')->name('monitor.index');
        Route::get('/card-info', 'cardInfo')->name('monitor.card');
    });
});
/*
|--------------------------------------------------------------------------
| END ROUTE PAGE ADMIN 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE PAGE ROOM 🟢
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'room', 'cors'], function () {
    Route::controller(RoomDashboardController::class)->prefix('/room')->group(function () {
        Route::get('/', 'index')->name('room.dashboard');
        Route::post('/post-reload', 'reload')->name('room.reload');
    });
    Route::controller(ScanQrcodeController::class)->prefix('/scan')->group(function () {
        Route::get('/', 'index')->name('room.scan-qrcode');
    });
    Route::controller(RoomDashboardController::class)->prefix('/api-display')->group(function () {
        Route::get('/', 'apiDisplay')->name('room.api-display');
    });
    Route::controller(RoomDashboardController::class)->prefix('/api-ongoing')->group(function () {
        Route::get('/', 'apiOngoing')->name('room.api-ongoing');
    });
});
/*
|--------------------------------------------------------------------------
| END ROUTE PAGE ROOM 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE PAGE USER 🟢
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'user'], function () {
    Route::controller(UserDashboardController::class)->prefix('/')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('/user', 'index')->name('user.dashboard');
        Route::get('/user/profile', 'profile')->name('user.profile');
        Route::get('/user/logout', 'logout')->name('user.logout');
        Route::post('/user/guest', 'guestAccess')->name('user.logout');
    });

    // // Route::controller(BookingRoomController::class)->prefix('/user/booking')->group(function () {
    // //     Route::get('/', 'index')->name('user-booking.dashboard');
    // //     Route::get('/{id}/create', 'create')->name('user-booking.create');
    // //     Route::post('/', 'store')->name('user-booking.post');
    // // });

    // // Route::controller(SearchRoomUserController::class)->prefix('/user/booking')->group(function () {
    // //     Route::get('/search', 'index')->name('user-search-booking.dashboard');
    // // });
});
/*
|--------------------------------------------------------------------------
| END ROUTE PAGE USER 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE PAGE BOOKING 🟢
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'multi'], function () {

    Route::controller(UserDashboardController::class)->prefix('/booking')->group(function () {
        Route::get('/', 'index')->name('booking.dashboard');
        Route::get('/logout', 'logout')->name('booking.logout');
    });

    Route::controller(SearchRoomUserController::class)->prefix('/booking')->group(function () {
        Route::get('/search', 'index')->name('booking-searh.dashboard');
    });

    Route::controller(BookingRoomController::class)->prefix('/booking')->group(function () {
        Route::get('/{id}/create', 'create')->name('booking.create');
        Route::get('/{id}/detail', 'show')->name('booking.show');
        Route::get('/{id}/edit', 'edit')->name('booking.edit');
        Route::post('/{id}/cancel', 'cancel')->name('booking.cancel');
        Route::post('/', 'store')->name('booking.post');
        Route::get('/create-order', 'createOrder')->name('booking.order');
        Route::post('/{id}/update', 'update')->name('booking.update');
        Route::delete('/{id}', 'destroy')->name('booking.destroy');
    });

    Route::controller(RecurringBookingController::class)->prefix('/recurring-booking')->group(function () {
        Route::get('/{id}/create', 'create')->name('recurring.create');
        Route::get('/', 'index')->name('recurring.index');
        Route::get('/search', 'search')->name('recurring.search');
        Route::post('/', 'store')->name('recurring.post');
        Route::delete('/{id}', 'destroy')->name('recurring.destroy');
    });

    Route::controller(HistoryBookingController::class)->prefix('/history-booking')->group(function () {
        Route::get('/', 'index')->name('history-booking.index');
        Route::get('/{id}/detail', 'show')->name('history-booking.show');
    });
});
/*
|--------------------------------------------------------------------------
| END ROUTE PAGE BOOKING 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE PAGE RECEPTIONIST 🟢
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'receptionist'], function () {

    Route::controller(ReceptionistController::class)->prefix('/receptionist')->group(function () {
        Route::get('/', 'index')->name('receptionist.dashboard');
    });

    Route::controller(ManageGuestController::class)->prefix('/receptionist/manage-guest')->group(function () {
        Route::get('/', 'index')->name('manage-guest.index');
        Route::get('/create', 'create')->name('manage-guest.create');
        Route::post('/', 'store')->name('manage-guest.strore');
        Route::delete('/{id}', 'destroy')->name('manage-guest.destroy');
        Route::post('/{id}', 'restore')->name('manage-guest.restore');
        Route::post('/{id}/aktif', 'aktif')->name('manage-guest.aktif');
    });

    Route::controller(ActivityGuestController::class)->prefix('/receptionist/manage-guest')->group(function () {
        Route::get('/activity', 'index')->name('manage-guest.activity');
    });
});
/*
|--------------------------------------------------------------------------
| END ROUTE PAGE RECEPTIONIST 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE PAGE GUEST 🟢
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'guest-booking'], function () {

    Route::controller(GuestController::class)->prefix('/guest-booking')->group(function () {
        Route::get('/', 'index')->name('guest.dashboard');
        Route::get('/{id}/detail', 'show')->name('guest.show');
        Route::get('/{id}/edit', 'edit')->name('guest.edit');
        Route::post('/{id}/cancel', 'cancel')->name('guest.cancel');
        Route::post('/{id}/update', 'update')->name('guest.update');
        Route::delete('/{id}', 'destroy')->name('guest.destroy');
    });

    Route::controller(SearchBookingGuestController::class)->prefix('/guest-booking/search')->group(function () {
        Route::get('/', 'index')->name('guest.search');
    });

    Route::controller(CreateBookingGuestController::class)->prefix('/guest-booking/create')->group(function () {
        Route::get('/{id}', 'create')->name('guest.create');
        Route::post('/', 'store')->name('guest.post');
    });
});
/*
|--------------------------------------------------------------------------
| END ROUTE PAGE GUEST 🟤
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ROUTE PAGE GUEST 🟢
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'pantry'], function () {
    Route::controller(FoodOrderingController::class)->prefix('/pantry')->group(function () {
        Route::get('/', 'index')->name('pantry.index');
        // Route::get('/create', 'create')->name('pantry.create');
        // Route::get('/{id}/detail', 'detail')->name('pantry.detail');
        // Route::get('/{id}/edit', 'edit')->name('pantry.edit');
        // Route::post('/{id}/update', 'update')->name('pantry.update');
        Route::post('/{id}', 'done')->name('pantry.done');
    });
});
/*
|--------------------------------------------------------------------------
| END ROUTE PAGE GUEST 🟤
|--------------------------------------------------------------------------
*/