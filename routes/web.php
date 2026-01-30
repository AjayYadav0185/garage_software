<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServicePackageController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\JobCardController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InsurenceDetailController;
use App\Http\Controllers\InventoryClientController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\InventoryPaymentController;
use App\Http\Controllers\InsuranceRoController;
use App\Http\Controllers\TaxConfigurationController;

Route::get('jobcards/preview-pdf/{id}', [JobCardController::class, 'previewPdf'])->name('jobcards.previewPdf');
Route::get('jobcards.estimate/{id}', [JobCardController::class, 'estimateView'])->name('jobcards.estimate');
Route::post('jobcards.estimate-view', [JobCardController::class, 'estimateViewPage'])->name('jobcards.estimate.page');
Route::get('jobcards.approve/{id}', [JobCardController::class, 'approve'])->name('jobcards.approve');
Route::get('jobcards.reject/{id}', [JobCardController::class, 'reject'])->name('jobcards.reject');


// Tax Configuration Routes (Inside your existing user routes group)
Route::middleware(['auth'])->group(function () {

    // Tax Configuration Management
    Route::prefix('settings')->group(function () {

        // Main CRUD routes
        Route::get('tax-configurations', [TaxConfigurationController::class, 'index'])->name('tax-configurations.index');
        Route::get('tax-configurations/ajax', [TaxConfigurationController::class, 'ajax'])->name('tax-configurations.ajax');
        Route::post('tax-configurations', [TaxConfigurationController::class, 'store'])->name('tax-configurations.store');
        Route::get('tax-configurations/{id}/edit', [TaxConfigurationController::class, 'edit'])->name('tax-configurations.edit');
        Route::put('tax-configurations/{id}', [TaxConfigurationController::class, 'update'])->name('tax-configurations.update');
        Route::delete('tax-configurations/{id}', [TaxConfigurationController::class, 'destroy'])->name('tax-configurations.destroy');

        // Additional API routes for inventory form
        Route::get('tax-rates/{country}', [TaxConfigurationController::class, 'getTaxRates'])->name('tax-rates.by-country');
        Route::get('tax-configurations/active/all', [TaxConfigurationController::class, 'getActiveTaxConfigurations'])->name('tax-configurations.active');
    });
});

// Or if you prefer resource route pattern (alternative approach):
/*
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('tax-configurations', TaxConfigurationController::class);
    Route::get('tax-configurations-ajax', [TaxConfigurationController::class, 'ajax'])->name('tax-configurations.ajax');
    Route::get('tax-rates/{country}', [TaxConfigurationController::class, 'getTaxRates'])->name('tax-rates.by-country');
});
*/



Route::post('/insurance/mark-payment', [InsuranceRoController::class, 'markPayment'])
    ->name('insurance.markPayment');

Route::prefix('insurence')->name('insurence.')->group(function () {
    Route::get('/', [InsurenceDetailController::class, 'index'])->name('index');
    Route::get('/ajax', [InsurenceDetailController::class, 'ajax'])->name('ajax');
    Route::post('/', [InsurenceDetailController::class, 'store'])->name('store');
    Route::get('/{insurence}/edit', [InsurenceDetailController::class, 'edit'])->name('edit');
    Route::put('/{insurence}', [InsurenceDetailController::class, 'update'])->name('update');
    Route::delete('/{insurence}', [InsurenceDetailController::class, 'destroy'])->name('destroy');
});


Route::prefix('insurance-ro')->name('insurance-ro.')->group(function () {
    Route::get('/', [InsuranceRoController::class, 'index'])->name('index');
    Route::get('/ajax', [InsuranceRoController::class, 'ajax'])->name('ajax');
    Route::post('/', [InsuranceRoController::class, 'store'])->name('store');
    Route::get('/{ro}/edit', [InsuranceRoController::class, 'edit'])->name('edit');
    Route::put('/{ro}', [InsuranceRoController::class, 'update'])->name('update');
    Route::delete('/{ro}', [InsuranceRoController::class, 'destroy'])->name('destroy');
});

Route::post('/insurance-ro/check-split', [InsuranceROController::class, 'checkSplit'])->name('insurance-ro.check-split');
Route::post('/insurance-ro/toggle-split', [InsuranceROController::class, 'toggleSplit'])->name('insurance-ro.toggle-split');
Route::post('/insurance-ro/save-split', [InsuranceROController::class, 'saveSplit'])->name('insurance-ro.save-split');

Route::get('/insurance-search', [InsuranceRoController::class, 'search'])
    ->name('insurance.search');


// Define the route for the Thank You page
Route::get('/thank-you', function () {
    return view('staticPage.thankyou');  // This will load the thankyou.blade.php view
})->name('thankyou.page');


// Define the route for the Thank You page
Route::get('/pricing', function () {
    return view('staticPage.pricing');  // This will load the thankyou.blade.php view
})->name('pricing.page');





Route::middleware('auth')->group(function () {

    // ---------------- Inventory Module ----------------
    Route::prefix('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
        Route::get('/ajax', [InventoryController::class, 'ajax'])->name('inventory.ajax');
        Route::post('/store', [InventoryController::class, 'store'])->name('inventory.store');
        Route::get('/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::delete('/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

        Route::get('/export', [InventoryController::class, 'export'])->name('inventory.export');
        Route::post('/import', [InventoryController::class, 'import'])->name('inventory.import');
    });

    // ---------------- Client Module ----------------
    Route::prefix('clients')->group(function () {
        Route::get('/', [InventoryClientController::class, 'index'])->name('clients.index');
        Route::get('/ajax', [InventoryClientController::class, 'ajax'])->name('clients.ajax');
        Route::post('/store', [InventoryClientController::class, 'store'])->name('clients.store');
        Route::get('/{client}/edit', [InventoryClientController::class, 'edit'])->name('clients.edit');
        Route::delete('/{client}', [InventoryClientController::class, 'destroy'])->name('clients.destroy');
    });



    // Route for showing details of a specific order (GET request)


    // ---------------- Sales Order Module ----------------
    Route::prefix('orders')->group(function () {
        Route::get('/', [SalesOrderController::class, 'index'])->name('orders.index');
        Route::get('/ajax', [SalesOrderController::class, 'ajax'])->name('orders.ajax');

        Route::post('/store', [SalesOrderController::class, 'store'])->name('orders.store');

        Route::get('/{order}/edit', [SalesOrderController::class, 'edit'])->name('orders.edit');
        Route::put('/{order}', [SalesOrderController::class, 'update'])->name('orders.update'); // ✅ Add this
        Route::delete('/{order}', [SalesOrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/{id}', [SalesOrderController::class, 'show'])->name('orders.show');
    });

    // ---------------- Payment Module ----------------
    Route::prefix('payments')->group(function () {
        Route::get('/', [InventoryPaymentController::class, 'index'])->name('payments.index');
        Route::get('/ajax', [InventoryPaymentController::class, 'ajax'])->name('payments.ajax');
        Route::post('/store', [InventoryPaymentController::class, 'store'])->name('payments.store');
        Route::get('/{payment}/edit', [InventoryPaymentController::class, 'edit'])->name('payments.edit');
        Route::delete('/{payment}', [InventoryPaymentController::class, 'destroy'])->name('payments.destroy');
    });



    Route::get('/payment-history', [InventoryPaymentController::class, 'Historyindex'])->name('payment-history.index');
    Route::get('/payment-history/ajax', [InventoryPaymentController::class, 'Historyajax'])->name('payment-history.ajax');

    // optional delete action
    Route::delete('/payment-history/{id}', [InventoryPaymentController::class, 'Historydestroy'])->name('payment-history.destroy');


    Route::prefix('expenses')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::get('/ajax', [ExpenseController::class, 'ajax'])->name('expenses.ajax');
        Route::post('/', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('/{id}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
        Route::put('/{id}', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::delete('/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
    });

    // Show role permissions page (or modal)
    Route::get('/roles/{role}/permissions', [UserController::class, 'editRolePermission'])
        ->name('roles.permissions.edit');

    // Update role permissions
    Route::post('/roles/{role}/permissions', [UserController::class, 'updateRolePermission'])
        ->name('roles.permissions.update');

    // Show permission management for a user
    Route::get('users/{user}/permissions', [UserController::class, 'editPermission'])->name('permissions.edit');
    Route::post('users/{user}/permissions', [UserController::class, 'updatePermission'])->name('permissions.update');


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/roles', [UserController::class, 'roleIndex'])->name('roles.index');
    Route::get('/users/datatable', [UserController::class, 'datatable'])->name('users.datatable');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');   // ← Missing route
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

    // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');

    // Edit Role
    Route::get('/users/roles/{role}/edit', [UserController::class, 'editRole'])->name('roles.edit');

    // Update Role
    Route::put('/users/roles/{role}', [UserController::class, 'updateRole'])->name('roles.update');
    Route::get('/users/roles.ajax', [UserController::class, 'ajax'])->name('users.roles.ajax');
    Route::get('/users/roles/permissions/{g_id}', [UserController::class, 'permissions'])->name('users.roles.permissions');

    Route::post('/users/roles', [UserController::class, 'storeRole'])->name('users.roles.add');


    Route::any('/users/{g_id}/update', [UserController::class, 'update'])->name('users.update');
    Route::any('/users/{g_id}/edit', [UserController::class, 'edit'])->name('users.edit');


    Route::prefix('reminder')->group(function () {

        // Blade page showing all reminders
        Route::get('/', [ReminderController::class, 'index'])->name('reminder.index');

        // AJAX endpoint for DataTables
        Route::get('/ajax', [ReminderController::class, 'ajax'])->name('reminder.ajax');

        // Store new reminder
        Route::post('/store', [ReminderController::class, 'store'])->name('reminder.store');

        // Edit reminder
        Route::get('/{id}/edit', [ReminderController::class, 'edit'])->name('reminder.edit');

        // Update reminder
        Route::put('/{id}', [ReminderController::class, 'update'])->name('reminder.update');

        // Delete reminder
        Route::delete('/{id}', [ReminderController::class, 'destroy'])->name('reminder.destroy');

        // Send individual reminder
        Route::post('/send', [ReminderController::class, 'send'])->name('reminder.send');
    });

    Route::prefix('services')->group(function () {
        // Show the main page for services (Blade view)
        Route::get('/', [ServiceController::class, 'index'])->name('services.index');

        // DataTable AJAX request to fetch the services
        Route::get('ajax', [ServiceController::class, 'ajax'])->name('services.ajax');

        // Create or update service (store route)
        Route::post('/', [ServiceController::class, 'store'])->name('services.store');

        // Edit a specific service (for loading the edit form)
        Route::get('{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');

        // Delete a specific service
        Route::delete('{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    });


    Route::get('/jobcards/print/{id}', [JobCardController::class, 'thermalInvoice'])->name('jobcard.print');

    Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue.index');
    Route::get('/revenue/download', [RevenueController::class, 'download'])->name('revenue.download');

    Route::get('/car-models-by-maker/{maker}', [VehicleController::class, 'getModelsByMaker'])
        ->name('car-models.by-maker');

    Route::post('/jobcards/send-email/{jobcard}', [JobCardController::class, 'sendEmail'])
        ->name('jobcards.send-email');

    Route::post('/jobcards/store', [JobCardController::class, 'store'])->name('jobcard.store');
    // Job Card Routes

    Route::post('/jobcards/update-status', [JobCardController::class, 'updateStatus'])->name('jobcards.updateStatus');
    Route::get('/jobcards', [JobCardController::class, 'index'])->name('jobcards.index');
    Route::get('/jobcards-pending', [JobCardController::class, 'pendingPay'])->name('jobcards.pendingPay');
    Route::get('/jobcards-completed', [JobCardController::class, 'pendingPay'])->name('jobcards.completePay');
    Route::get('/jobcards/ajax', [JobCardController::class, 'ajax'])->name('jobcards.ajax');
    // Route::post('/jobcards', [JobCardController::class, 'estimateView'])->name('jobcards.store');
    Route::post('/jobcards/store', [JobCardController::class, 'store'])->name('jobcards.store');
    Route::post('/jobcards/markPayment', [JobCardController::class, 'markPayment'])->name('jobcards.markPayment');
    Route::get('/jobcards/{id}/edit', [JobCardController::class, 'edit'])->name('jobcards.edit');
    Route::post('/jobcards/{id}', [JobCardController::class, 'update'])->name('jobcards.update');
    Route::delete('/jobcards/{id}', [JobCardController::class, 'destroy'])->name('jobcards.destroy');
    Route::get('jobcards/list', [JobCardController::class, 'getList'])->name('jobcards.list');
    Route::get('jobcards/list-pending', [JobCardController::class, 'getListPending'])->name('jobcards.list-pending');





    // Inventory Routes
    // Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    // Route::get('/inventory/ajax', [InventoryController::class, 'ajax'])->name('inventory.ajax');
    // Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
    // Route::get('/inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    // Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
    // Route::delete('/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');


    Route::prefix('vendors')->name('vendors.')->group(function () {
        Route::get('/', [VendorController::class, 'index'])->name('index');
        Route::get('/ajax', [VendorController::class, 'ajax'])->name('ajax');
        Route::post('/', [VendorController::class, 'store'])->name('store');
        Route::get('/{vendor}/edit', [VendorController::class, 'edit'])->name('edit');
        Route::put('/{vendor}', [VendorController::class, 'update'])->name('update');
        Route::delete('/{vendor}', [VendorController::class, 'destroy'])->name('destroy');
    });



    Route::prefix('servicepackage')->group(function () {
        Route::get('/', [ServicePackageController::class, 'index'])->name('servicepackage.index');
        Route::get('/ajax', [ServicePackageController::class, 'ajax'])->name('servicepackage.ajax');
        Route::post('/', [ServicePackageController::class, 'store'])->name('servicepackage.store');
        Route::get('/{servicePackage}/edit', [ServicePackageController::class, 'edit'])->name('servicepackage.edit');
        Route::put('/{servicePackage}', [ServicePackageController::class, 'update'])->name('servicepackage.update'); // POST instead of PUT
        Route::delete('servicepackage/{servicePackage}', [ServicePackageController::class, 'destroy'])->name('servicepackage.destroy');
    });


    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/ajax', [CustomerController::class, 'ajax'])->name('ajax');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
        Route::get('/search', [CustomerController::class, 'search'])->name('search');
    });


    Route::resource('vehicles', VehicleController::class);
    Route::get('/vehicle-search', [VehicleController::class, 'search'])->name('vehicle.search');

    // Route::resource('mechanics', MechanicController::class);
    // Route::get('ajax/mechanics', [MechanicController::class, 'ajaxList'])->name('mechanics.ajax');


    // Mechanics CRUD
    Route::prefix('mechanics')->group(function () {
        Route::get('/', [MechanicController::class, 'index'])->name('mechanics.index'); // view page
        Route::get('/ajax', [MechanicController::class, 'ajaxList'])->name('mechanics.ajax'); // datatables AJAX
        Route::post('/', [MechanicController::class, 'store'])->name('mechanics.store'); // create
        Route::get('/{mechanic}/edit', [MechanicController::class, 'edit'])->name('mechanics.edit'); // edit
        Route::put('/{mechanic}', [MechanicController::class, 'update'])->name('mechanics.update'); // update
        Route::delete('/{mechanic}', [MechanicController::class, 'destroy'])->name('mechanics.destroy'); // delete
    });


    Route::get('ajax/vehicles', [VehicleController::class, 'ajax'])->name('vehicles.ajax');

    // Route::get('/', function () {
    //     // return view('welcome');
    //     return view('user.dashboard.index');
    // });

    // Route::get('/dashboard', function () {
    //     return view('user.dashboard.index');
    // });

    // routes/web.php

    Route::get('/', [DashboardController::class, 'index'])
        ->name('user.dashboard');


    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('user.dashboard');


    Route::get('/profile-edit', [ProfileController::class, 'editPage'])->name('profile.edit-page');
    Route::any('/profile-language-update', [ProfileController::class, 'updateLanguage'])->name('profile.language.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.change-password');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile-update-profile', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::any('/verify-change-password', [ProfileController::class, 'verifyChangePassword'])->name('profile.verify-change-password');
    Route::post('/profile-update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

require __DIR__ . '/auth.php';
