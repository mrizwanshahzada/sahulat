<?php

use Illuminate\Support\Facades\Route;
use App\Utils\Globals\UserType;
use Illuminate\Support\Facades\Storage;


// Beginning of Public Routes
Route::group(['Public'], function (){
    // Beginning of Frontend Routes
    Route::namespace('Frontend')->group(function () {
        // Beginning of PagesController Routes
        Route::group(['PagesController'], function () {
            Route::get('/','PagesController@index')->name('/');
            Route::get('search','PagesController@search')->name('search');
            Route::post('fetch-nearby-vendors','PagesController@fetchNearbyVendors')->name('fetchNearbyVendors');
            Route::get('suggest-search','PagesController@suggestSearch')->name('suggestSearch');
            Route::get('about', 'PagesController@about')->name('about');
            Route::get('contact', 'PagesController@contact')->name('contact');
            Route::get('payment' , 'PaymentsController@payment');

        });
        // End of PagesController Routes

        // Beginning of ServicesController Routes
        Route::group(['ServicesController'], function () {
            Route::get('services', 'ServicesController@services')->name('services');
            Route::get('service-details/{id}', 'ServicesController@serviceDetails')->name('serviceDetails');
        });
        // End of ServicesController Routes

        Route::post('employee-save-coordinates' , 'UsersController@employeeSaveCoordinates')->name('employeeSaveCoordinates');
        Route::post('employee-last-location' , 'UsersController@employeeLastLocation')->name('employeeLastLocation');
    });
    // End of Frontend Routes
});
// End of Public Routes

// Beginning of Private Routes
Route::group(['Private','middleware' => 'auth'], function (){
    // Beginning of Backend Routes
    Route::namespace('Backend')->group(function () {
        // Beginning of Admin Routes
        Route::middleware('UserTypeCheck:' . UserType::ADMIN)->group(function () {
            // Users Controller
            Route::group(['UsersController'], function () {
                Route::get('admin', 'UsersController@index')->name('adminDashboard');
                Route::get('admin-profile', 'UsersController@adminProfile')->name('adminProfile');
            });
            // Services Controller
            Route::group(['ServicesController'], function () {
                Route::get('add-new-service', 'ServicesController@addNewService')->name('addNewService');
                Route::get('view-services/{type}', 'ServicesController@viewServices')->name('viewServices');
                Route::post('add-sahulat-service', 'ServicesController@storeSahulatService')->name('storeSahulatService');
                Route::get('delete-service/{id}', 'ServicesController@removeSahulatService')->name('removeSahulatService');
                Route::get('edit-service/{service}', 'ServicesController@editService')->name('editService');
                Route::post('update-service/{id}', 'ServicesController@updateSahulatService')->name('updateSahulatService');
            });
            // Vendors Controller
            Route::group(['VendorsController'], function () {
                Route::get('view-vendor-requests', 'VendorsController@viewVendorRequests')->name('viewVendorRequests');
                Route::get('verify-vendor/{id}', 'VendorsController@verifyVendor')->name('verifyVendor');
                Route::get('approve-vendor/{id}', 'VendorsController@approveVendor')->name('approveVendor');
                Route::get('cancel-vendor-request/{id}', 'VendorsController@cancelVendorRequest')->name('cancelVendorRequest');
            });
            // Employees Controller
            Route::group(['EmployeesController'], function () {
                Route::get('add-new-employee', 'EmployeesController@addNewEmployee')->name('addNewEmployee');
                Route::get('track-employees', 'EmployeesController@trackEmployees')->name('trackEmployees');
                Route::get('track-employee-location', 'EmployeesController@trackEmployeeLocation')->name('trackEmployeeLocation');
                Route::post('register-new-employee', 'EmployeesController@registerNewEmployee')->name('registerNewEmployee');
                Route::get('view-employees', 'EmployeesController@viewEmployees')->name('viewEmployees');
                Route::get('edit-employees/{id}', 'EmployeesController@editEmployee')->name('editEmployee');
                Route::post('update-employee-salary', 'EmployeesController@updateEmployeeSalary')->name('updateEmployeeSalary');
            });
            // Tasks Controller
            Route::group(['TasksController'], function () {
                Route::get('view-tasks/{type}', 'TasksController@viewTasks')->name('viewTasks');
            });

        });
        // End of Admin Routes
    });
    // End of Backend Routes

    // Beginning of Frontend Routes
    Route::namespace('Frontend')->group(function () {

        // Beginning of Email Verified Routes
        Route::middleware('verified')->group(function () {
            // Beginning of Customer Routes
            Route::middleware('UserTypeCheck:' . UserType::CUSTOMER)->group(function () {
                // Users Controller
                Route::group(['UsersController'], function (){
                    Route::get('customer-profile', 'UsersController@customerProfile')->name('customerProfile');
                    Route::get('customer-edit-profile','UsersController@customerEditProfile')->name('customerEditProfile');
                    Route::post('customer-update-profile','UsersController@customerUpdateProfile')->name('customerUpdateProfile');
                    Route::get('customer-dashboard', 'UsersController@customerDashboard')->name('customerDashboard');
                    Route::get('completed-tasks', 'UsersController@completedTasks')->name('completedTasks');
                    Route::get('cancelled-tasks', 'UsersController@cancelledTasks')->name('cancelledTasks');
                    Route::get('user-buy-service-form/{service}', 'UsersController@userBuyServiceForm')->name('userBuyServiceForm');
                    Route::post('user-buy-service/{service}', 'UsersController@userBuyService')->name('userBuyService');
                    Route::get('customer-pending-tasks' , 'UsersController@customerPendingTasks')->name('customerPendingTasks');
                    Route::get('user-delete-pending-tasks/{task}','UsersController@userDeletePendingTask')->name('userDeletePendingTask');
                    Route::get('logout-customer', 'UsersController@logoutCustomer')->name('logoutCustomer');
                    Route::get('my-subscription' , 'UsersController@mySubscription')->name('mySubscription');
                    Route::get('delete-subscription/{id}' , 'UsersController@deleteSubs')->name('deleteSubs');
                    Route::get('user-rating-task/{task}' , 'UsersController@userRatingTask')->name('userRatingTask');
                    Route::post('user-rating-task/{task}' , 'UsersController@userSubmitRatingTask')->name('userSubmitRatingTask');
                    Route::get('user-Reject-task/{task}' , 'UsersController@userRejectTask')->name('userRejectTask');
                    Route::get('customer-verifying-tasks' , 'UsersController@customerVerifyingTasks')->name('customerVerifyingTasks');
                    Route::get('customer-read-notification/{id}' , 'UsersController@customerReadNotification')->name('customerReadNotification');
                    Route::get('customer-track-employee/{task}' , 'UsersController@customerTrackEmployee')->name('customerTrackEmployee');
                    Route::post('task-cancel-notify/{task}','UsersController@cancelFeedback')->name('cancelNotify');

                });
                // SubscriptionsController
                Route::group(['SubscriptionsController'], function (){
                    Route::get('subscriptions', 'SubscriptionsController@subscriptions')->name('subscriptions');
                    Route::get('subscribe-a-service/{id}', 'SubscriptionsController@subscribeAService')->name('subscribeAService');
                    Route::post('save-subscription', 'SubscriptionsController@subscribeService')->name('subscribeService');
                    Route::get('renew-subscription/{id}/{notification_id}', 'SubscriptionsController@renewSubscription')->name('renewSubscription');
                    Route::post('save-renewed-subscription', 'SubscriptionsController@saveRenewedSubscription')->name('saveRenewedSubscription');
                });
                Route::group(['VendorsController'], function (){
                    Route::get('initialize-task/{vendorId}/{serviceId}/{charges}' , 'VendorsController@initializeTask')->name('initializeTask');

                });
                // PaymentsController
                Route::group(['PaymentsController'], function (){
                    Route::post('task-payment/{service}','PaymentsController@taskPayment')->name('taskPayment');
                    Route::post('payment/{service}/{deadline}' , 'PaymentsController@payment')->name('payment');
                    Route::get('transaction-history' , 'PaymentsController@transactionHistory')->name('transactionHistory');
                });
                // TasksController
                Route::group(['TasksController'], function (){
                    Route::post('createTask','TasksController@createTask')->name('createTask');
                    Route::post('buy-service','TasksController@createTask')->name('createTask');
                    Route::get('buy-service/{id}/{notification_id}','TasksController@requestVendor')->name('requestVendor');
                    Route::get('update-task-status/{task_id}' , 'TasksController@updateTaskStatus')->name('updateTaskStatus');
                    Route::get('reject-offer/{task_id}/{notification_id}' , 'TasksController@rejectOffer')->name('rejectOffer');
                    Route::get('feedback', 'TasksController@feedback')->name('feedback');
                });
                Route::group(['MessageController'], function (){
                    Route::get('customer-chat/{task}' , 'MessageController@index')->name('customerChat');
                });

            });
            // Beginning of Customer Routes

            // Beginning of Vendor Routes
            Route::middleware('UserTypeCheck:' . UserType::VENDOR)->group(function () {
                // VendorsController
                Route::group(['VendorsController'], function (){
                    Route::get('vendor-dashboard', 'VendorsController@vendorDashboard')->name('vendorDashboard');
                    Route::get('edit-vendor-services/{service}', 'VendorsController@editVendorService')->name('editVendorService');
                    Route::get('vendor-profile', 'VendorsController@vendorProfile')->name('vendorProfile');
                    Route::get('edit-vendor-profile', 'VendorsController@editVendorProfile')->name('editVendorProfile');
                    Route::post('update-vendor-profile', 'VendorsController@updateVendorProfile')->name('updateVendorProfile');
                    Route::get('add-vendor-new-service','VendorsController@addNewService')->name('addVendorNewService');
                    Route::post('save-service' , 'ServicesController@storeService')->name('storeService');
                    Route::get('display-service' , 'VendorsController@viewServices')->name('viewVendorServices');
                    Route::get('panding-tasks' , 'VendorsController@pandingTasks')->name('pandingTasks');
                    Route::get('complete-tasks' , 'VendorsController@completeTasks')->name('completeTasks');
                    Route::get('cancel-tasks' , 'VendorsController@cancelTasks')->name('cancelTasks');
                    Route::get('vendor-task' , 'VendorsController@vendorTasks')->name('vendorTasks');
                    Route::get('delete-vendor-service/{service}', 'VendorsController@deleteVendorService')->name('deleteVendorService');
                });
                // TasksController
                Route::group(['TasksController'], function (){
                    Route::get('update-task/{task}', 'TasksController@updateTask')->name('updateTask');
                    Route::get('delete-task/{task}' , 'TasksController@deleteTask')->name('deleteTask');
                    Route::post('save-changes-task/{id}' , 'TasksController@saveChanges')->name('saveChanges');
                    Route::get('assign-task-status/{task_id}' , 'TasksController@assigntTaskStatus')->name('assigntTaskStatus');
                    Route::get('assigned-vendor-task', 'TasksController@assignVendorTask')->name('assignVendorTask');
                    Route::get('progress-task-status/{task_id}' , 'TasksController@progresstaskStatus')->name('progresstaskStatus');
                    Route::get('vendor-current-task' , 'TasksController@vendorCurrentTask')->name('vendorCurrentTask');
                    Route::get('vendor-verifying-task' , 'TasksController@vendorVerifyingTask')->name('vendorVerifyingTask');
                    Route::get('verify-task-status/{task_id}' , 'TasksController@verifyTaskStatus')->name('verifyTaskStatus');
                    Route::get('cancel-task-status/{task_id}' , 'TasksController@cancelTaskStatus')->name('cancelTaskStatus');
                    Route::get('vendor-canceled-task' , 'TasksController@vendorCanceledTask')->name('vendorCanceledTask');
                    Route::post('update-budget' , 'TasksController@updateBudget')->name('updateBudget');
                });
                // ServicesController
                Route::group(['ServicesController'], function (){
                    Route::get('add-service', 'ServicesController@addService')->name('addService');
                    Route::get('show-vendor-services', 'ServicesController@showVendorServices')->name('showVendorServices');
                    Route::post('edit-vendor-service/{service}', 'VendorsController@updateVendorService')->name('updateVendorService');
                    Route::get('reject-task/{id}' ,'TasksController@rejectTask')->name('rejectTask');

                });
                // MessageController
                Route::group(['MessageController'], function (){
                    Route::get('vendor-chat/{task}' , 'MessageController@index')->name('vendorChat');
                });
            });
            // End of Vendor Routes

            // Beginning of Employee Routes
            Route::middleware('UserTypeCheck:' . UserType::EMPLOYEE)->group(function () {
                Route::group(['EmployeesController'], function (){
                    Route::get('employee-dashboard', 'EmployeesController@employeeDashboard')->name('employeeDashboard');
                    Route::get('employee-completed-tasks', 'EmployeesController@employeeCompletedTasks')->name('employeeCompletedTasks');
                    Route::get('employee-cancelled-tasks', 'EmployeesController@employeeCancelledTasks')->name('employeeCancelledTasks');
                    Route::get('vendor-verification-tasks', 'EmployeesController@vendorVerificatoinTasks')->name('vendorVerificatoinTasks');
                    Route::get('track-vendor-location/{id}', 'EmployeesController@trackVendorLocation')->name('trackVendorLocation');
                    Route::get('track-vendor-location/{id}', 'EmployeesController@trackVendorLocation')->name('trackVendorLocation');
                    Route::get('logout-employee', 'EmployeesController@logoutEmployee')->name('logoutEmployee');
                    Route::get('employee-profile' , 'EmployeesController@employeeProfile')->name('employeeProfile');
                    Route::get('employee-update-profile' , 'EmployeesController@updateProfile')->name('updateProfile');
                    Route::PUT('employee-update' , 'EmployeesController@updateEmployee')->name('updateEmployee');
                    Route::get('employee-pending-tasks' , 'EmployeesController@employeePendingTasks')->name('employeePendingTasks');
                    Route::get('accept-user-request/{task}' , 'EmployeesController@acceptUserRequest')->name('acceptUserRequest');
                    Route::get('employee-reject-task/{task}' , 'EmployeesController@employeeRejectTask')->name('employeeRejectTask');
                    Route::get('employee-done-task/{task}' , 'EmployeesController@employeeDoneTask')->name('employeeDoneTask');
                    Route::get('employee-assigned-tasks' , 'EmployeesController@employeeAssignedTasks')->name('employeeAssignedTasks');
                    Route::get('employee-start-task/{task}' , 'EmployeesController@employeeStartTask')->name('employeeStartTask');
                    Route::get('employee-verifying-tasks' , 'EmployeesController@employeeVerifyingTasks')->name('employeeVerifyingTasks');
                    Route::get('employee-read-notification/{id}' , 'EmployeesController@employeeReadNotification')->name('employeeReadNotification');
                    Route::post('employee-update-location' , 'EmployeesController@employeeUpdateLocation')->name('employeeUpdateLocation');
                    Route::post('employee-verify-vendor' , 'EmployeesController@employeeVerifyVendor')->name('employeeVerifyVendor');


                     Route::get('test', 'EmployeesController@nearestEmployee')->name('nearestEmployee');


                });

                Route::group(['MessageController'], function (){
                    Route::get('employee-chat/{task}' , 'MessageController@index')->name('employeeChat');
                });
            });
            // End of Employee Routes
        });
        // End of Email Verified Routes

    });
    // End of Frontend Routes
});
// End of Private Routes

// Beginning of Auth Routes
Route::group(['Auth'], function (){

    Auth::routes(['verify' => true]);

    Route::namespace('Auth')->group(function () {
        Route::get('logout', 'LoginController@logout')->name('logout');
        Route::get('vendor-registration', 'RegisterVendorController@showRegistrationForm')->name('registerVendor');
        Route::post('vendor-registration', 'RegisterVendorController@create')->name('registerVendor');
        Route::post('check-email-availability', 'RegisterVendorController@checkEmailAvailability')->name('checkEmailAvailability');
        Route::post('check-phone-availability', 'RegisterVendorController@checkPhoneAvailability')->name('checkPhoneAvailability');
    });
});
// End of Auth Routes


Route::post('send-message', 'Frontend\MessageController@sendMessage')->name('sendMessage');

Route::get('saad.geojson', function(){
    $json = Storage::disk('public')->get('saad.geojson');
    $json = json_decode($json,true);
    return $json;
})->name('saad.geojson');
Route::get('location.geojson', function(){
    $json = Storage::disk('local')->get('location.geojson');
    $json = json_decode($json,true);
    return $json;
})->name('location.geojson');

