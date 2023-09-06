<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\ServiceProvider\ServiceProviderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

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
//     return view('index');
// });

Route::get('/', [HomeController::class, 'index'])->name('home.index');



// user auth
Route::prefix('user')->middleware('userAuth')->group(function () {
    // user dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    // user profile
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    // user profile update
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    // user credentials
    Route::get('/credentials', [UserController::class, 'credentials'])->name('user.credentials');
    // user credentials update
    Route::post('/updateCredentials', [UserController::class, 'updateCredentials'])->name('user.updateCredentials');
    // user service
    Route::get('/purchaseService', [UserController::class, 'purchaseService'])->name('user.purchaseService');
    // cart
    Route::get('/cart', [UserController::class, 'cart'])->name('user.cart');
    // add to cart
    Route::post('/addToCart', [UserController::class, 'addToCart'])->name('user.addToCart');
    // remove from cart
    Route::get('/removeFromCart/{basket_id}', [UserController::class, 'removeFromCart'])->name('removeFromCart');
    // checkout
    Route::post('/requestOrder', [OrderController::class, 'orderedService'])->name('user.orderedService');
    // order to Recive
    Route::get('/orderToRecive', [UserController::class, 'orderToRecive'])->name('user.orderToRecive');
    // user purchase
    Route::get('/purchaseHistory', [UserController::class, 'purchaseHistory'])->name('user.purchaseHistory');
    // user review
    Route::get('/review', [UserController::class, 'review'])->name('user.review');
    // user review purchase data
    Route::get('/orderDetails', [UserController::class, 'orderDetail'])->name('user.orderDetails');
    // user review post
    Route::post('/addReview', [UserController::class, 'reviewData'])->name('user.reviewData');
    // user ledger
    Route::get('/leger', [UserController::class, 'ledger'])->name('user.ledger');
    // user logout
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

    // new routs
    // user details
    Route::get('/userDetails', [UserController::class, 'userDetail'])->name('user.userDetail');
    // remove all from cart'
    Route::get('/removeAllFromCart', [UserController::class, 'removeAllFromCart'])->name('user.removeAllFromCart');

    // payment success
    Route::get('/paymentSuccess', [UserController::class, 'paymentSucesPage'])->name('user.paymentSuccess');
    // payment failed
    Route::get('/paymentFailed', [UserController::class, 'paymentFailPage'])->name('user.paymentFailed');
});


// user 
Route::prefix('user')->group(function () {
    // user register
    Route::post('/register', [UserAuthController::class, 'registerUser'])->name('registerUser');
    // user login
    Route::post('/login', [UserAuthController::class, 'loginUser'])->name('loginUser');

    Route::get('/changepassword', [UserAuthController::class, 'changepassword'])->name('user.changepassword');
    // user forget password
    Route::get('/forgetPassword', [UserAuthController::class, 'forgetPassword'])->name('user.forgetPassword');
    // user forget password post
    Route::post('/forgetPassword', [UserAuthController::class, 'forgetPasswordData'])->name('user.forgetPasswordData');

    Route::middleware('forgotPassword')->group(function () {
        // user otp page
        Route::get('/otp', [UserAuthController::class, 'otpPage'])->name('user.otpPage');

        // user reset password post
        Route::post('/otp', [UserAuthController::class, 'resetPasswordOtpData'])->name('user.resetPasswordOtpData');

        // // user reset password
        Route::get('/resetPassword', [UserAuthController::class, 'resetPassword'])->name('user.resetPassword');

        // user reset password post
        Route::post('/resetPassword', [UserAuthController::class, 'resetPasswordData'])->name('user.resetPasswordData');
    });
});



// staff auth
Route::prefix('staff')->middleware('staffAuth')->group(function () {

    // staff dashboard
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

    // staff profile
    Route::get('/profile', [StaffController::class, 'profile'])->name('staff.profile');

    // staff profile update
    Route::post('/profile/{id}', [StaffController::class, 'updateProfile'])->name('staff.updateProfile');

    // staff credentials
    Route::get('/credentials', [StaffController::class, 'credentials'])->name('staff.credentials');

    // staff credentials update
    Route::post('/updateCredentials', [StaffController::class, 'updateCredentials'])->name('staff.updateCredentials');

    // staff review
    Route::get('/review', [StaffController::class, 'review'])->name('staff.review');

    // staff ledger
    Route::get('/ledger', [StaffController::class, 'ledger'])->name('staff.ledger');

    // staff order new / incomplete
    Route::get('/orderAsigned', [StaffController::class, 'orderAsigned'])->name('staff.orderAsigned');

    // search order by data
    Route::post('/searchOrder', [StaffController::class, 'searchOrderByDate'])->name('staff.searchOrder');

    // staff order complete
    Route::get('/orderComplete', [StaffController::class, 'orderCompleted'])->name('staff.orderCompleted');

    // staff order cancel
    Route::get('/orderCancel/{id}', [StaffController::class, 'orderCancel'])->name('staff.orderCancel');

    // staff logout 
    Route::get('/logout', [AdminAuthController::class, 'staffLogout'])->name('staff.logout');

    // staff order done
    // Route::get('/orderDone/{id}/', [StaffController::class, 'orderDone'])->name('staff.orderDone');
    Route::get('/orderDone/{tCode}/{id}', [StaffController::class, 'orderDone'])->name('staff.orderDone');
});



// staff And Admin login an register 
Route::prefix('admin')->group(function () {
    // login
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    // login post
    Route::post('/login', [AdminAuthController::class, 'adminLogin'])->name('admin.loginData');

    // register
    Route::get('/register', [AdminAuthController::class, 'register'])->name('admin.register');
    // register post
    Route::post('/register', [AdminAuthController::class, 'adminRegister'])->name('admin.registeData');
});



// admin auth
Route::prefix('admin')->middleware('adminAuth')->group(function () {
    // admin dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    // =====================================================================================================================
    // Customer details
    Route::get('/customerDetail', [AdminController::class, 'customerDetail'])->name('admin.customerDetail');
    // add customer form
    Route::get('/addCustomer', [AdminController::class, 'addCustomerPage'])->name('admin.addCustomerFormPage');
    // add customer
    Route::post('/addCustomer', [AdminController::class, 'addCustomerData'])->name('admin.addCustomer');

    // active user
    Route::get('/activeUser/{id}', [AdminController::class, 'activeUser'])->name('admin.activeUser');
    // deactive user
    Route::get('/deactiveUser/{id}', [AdminController::class, 'deactiveUser'])->name('admin.deactiveUser');
    // edit user
    Route::get('/editUser/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');
    // update user
    Route::post('/updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');


    // =====================================================================================================================
    // user type form
    Route::get('/userType', [AdminController::class, 'userTypeFormPage'])->name('admin.userTypeFormPage');
    // add user type data
    Route::post('/addUserType', [AdminController::class, 'addUserType'])->name('admin.addUserType');
    // user type dispaly
    Route::get('/userTypeDetails', [AdminController::class, 'userTypeList'])->name('admin.userTypeList');
    // user type edit
    Route::get('/editUserType/{id}', [AdminController::class, 'editUserType'])->name('admin.editUserType');
    // user type update
    Route::post('/updateUserType/{id}', [AdminController::class, 'updateUserType'])->name('admin.updateUserType');
    // user type active
    Route::get('/activeUserType/{id}', [AdminController::class, 'activeUserType'])->name('admin.activeUserType');
    // user type deactive
    Route::get('/deactiveUserType/{id}', [AdminController::class, 'deactiveUserType'])->name('admin.deactiveUserType');


    // =====================================================================================================================
    // service
    Route::get('/addservice', [AdminController::class, 'serviceFormPage'])->name('admin.serviceFormPage');
    // add item
    Route::post('/addService', [AdminController::class, 'addService'])->name('admin.addService');
    // service list
    Route::get('/serviceDetails', [AdminController::class, 'serviceDetails'])->name('admin.serviceDetails');
    // service edit
    Route::get('/editService/{id}', [AdminController::class, 'editService'])->name('admin.editService');
    // service update
    Route::post('/updateService/{id}', [AdminController::class, 'updateService'])->name('admin.updateService');
    // service active
    Route::get('/activeService/{id}', [AdminController::class, 'activeService'])->name('admin.activeService');
    // service deactive
    Route::get('/deactiveService/{id}', [AdminController::class, 'deactiveService'])->name('admin.deactiveService');
    // service delete
    Route::get('/deleteService/{id}', [AdminController::class, 'deleteService'])->name('admin.deleteService');



    // =====================================================================================================================
    // orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');

    // order details
    Route::get('/orderDetails', [AdminController::class, 'orderDetailsByTcode'])->name('admin.orderDetails');

    // order status
    Route::post('/assignTask', [AdminController::class, 'assignTask'])->name('admin.assignTask');
    // assiged orders
    Route::get('/assignedOrders', [AdminController::class, 'assignedOrderDetails'])->name('admin.assignedOrders');
    // completed orders
    Route::get('/completedOrders', [AdminController::class, 'completedOrderDetails'])->name('admin.completedOrders');

    // order status cancel
    Route::get('/cancelOrder', [AdminController::class, 'cancelOrder'])->name('admin.asignedOrderCancel');


    // =====================================================================================================================
    // staff 
    Route::get('/staffRegister', [AdminController::class, 'staffRegisterPage'])->name('admin.staffRegisterPage');
    // staff register
    Route::post('/staffRegister', [AdminController::class, 'addStaff'])->name('admin.staffRegister');
    // staff list
    Route::get('/staffDetail', [AdminController::class, 'staffDetail'])->name('admin.staffDetail');
    // staff edit
    Route::get('/editStaff/{id}', [AdminController::class, 'editStaff'])->name('admin.editStaff');
    // staff update
    Route::post('/updateStaff/{id}', [AdminController::class, 'updateStaff'])->name('admin.updateStaff');
    // staff active
    Route::get('/activeStaff/{id}', [AdminController::class, 'activeStaff'])->name('admin.activeStaff');
    // staff deactive
    Route::get('/deactiveStaff/{id}', [AdminController::class, 'deactiveStaff'])->name('admin.deactiveStaff');
    // staff delete
    Route::get('/deleteStaff/{id}', [AdminController::class, 'deleteStaff'])->name('admin.deleteStaff');


    // =====================================================================================================================
    // asigned order details
    Route::get('/assignedOrderStaffDetails', [AdminController::class, 'assignedOrderStaffDetailsByTcode'])->name('admin.assignedOrderStaffDetails');


    // =====================================================================================================================
    // Report
    Route::get('/purchaseReport', [AdminController::class, 'purchaseReport'])->name('admin.purchaseReport');


    // =====================================================================================================================
    // admin profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    // admin profile update
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    // admin credentials
    Route::get('/credentials', [AdminController::class, 'credentials'])->name('admin.credentials');
    // admin credentials update
    Route::post('/updateCredentials', [AdminController::class, 'updateCredentials'])->name('admin.updateCredentials');
    // admin logout
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
});
