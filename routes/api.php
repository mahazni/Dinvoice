<?php

use Dinvoice\Http\Controllers\AppVersionController;
use Dinvoice\Http\Controllers\V1\Auth\ForgotPasswordController;
use Dinvoice\Http\Controllers\V1\Auth\IsRegisteredController;
use Dinvoice\Http\Controllers\V1\Auth\ResetPasswordController;
use Dinvoice\Http\Controllers\V1\Backup\BackupsController;
use Dinvoice\Http\Controllers\V1\Backup\DownloadBackupController;
use Dinvoice\Http\Controllers\V1\Customer\CustomersController;
use Dinvoice\Http\Controllers\V1\Customer\CustomerStatsController;
use Dinvoice\Http\Controllers\V1\CustomField\CustomFieldsController;
use Dinvoice\Http\Controllers\V1\Dashboard\DashboardController;
use Dinvoice\Http\Controllers\V1\Estimate\ChangeEstimateStatusController;
use Dinvoice\Http\Controllers\V1\Estimate\ConvertEstimateController;
use Dinvoice\Http\Controllers\V1\Estimate\EstimatesController;
use Dinvoice\Http\Controllers\V1\Estimate\EstimateTemplatesController;
use Dinvoice\Http\Controllers\V1\Estimate\SendEstimateController;
use Dinvoice\Http\Controllers\V1\Expense\ExpenseCategoriesController;
use Dinvoice\Http\Controllers\V1\Expense\ExpensesController;
use Dinvoice\Http\Controllers\V1\Expense\ShowReceiptController;
use Dinvoice\Http\Controllers\V1\Expense\UploadReceiptController;
use Dinvoice\Http\Controllers\V1\General\BootstrapController;
use Dinvoice\Http\Controllers\V1\General\CountriesController;
use Dinvoice\Http\Controllers\V1\General\CurrenciesController;
use Dinvoice\Http\Controllers\V1\General\NextNumberController;
use Dinvoice\Http\Controllers\V1\General\DateFormatsController;
use Dinvoice\Http\Controllers\V1\General\FiscalYearsController;
use Dinvoice\Http\Controllers\V1\General\LanguagesController;
use Dinvoice\Http\Controllers\V1\General\NotesController;
use Dinvoice\Http\Controllers\V1\General\SearchController;
use Dinvoice\Http\Controllers\V1\General\TimezonesController;
use Dinvoice\Http\Controllers\V1\Invoice\ChangeInvoiceStatusController;
use Dinvoice\Http\Controllers\V1\Invoice\CloneInvoiceController;
use Dinvoice\Http\Controllers\V1\Invoice\InvoicesController;
use Dinvoice\Http\Controllers\V1\Invoice\SendInvoiceController;
use Dinvoice\Http\Controllers\V1\Invoice\InvoiceTemplatesController;
use Dinvoice\Http\Controllers\V1\Item\ItemsController;
use Dinvoice\Http\Controllers\V1\Item\UnitsController;
use Dinvoice\Http\Controllers\V1\Mobile\AuthController;
use Dinvoice\Http\Controllers\V1\Onboarding\DatabaseConfigurationController;
use Dinvoice\Http\Controllers\V1\Settings\MailConfigurationController;
use Dinvoice\Http\Controllers\V1\Onboarding\PermissionsController;
use Dinvoice\Http\Controllers\V1\Onboarding\RequirementsController;
use Dinvoice\Http\Controllers\V1\Onboarding\OnboardingWizardController;
use Dinvoice\Http\Controllers\V1\Onboarding\FinishController;
use Dinvoice\Http\Controllers\V1\Payment\PaymentsController;
use Dinvoice\Http\Controllers\V1\Payment\PaymentMethodsController;
use Dinvoice\Http\Controllers\V1\Payment\SendPaymentController;
use Dinvoice\Http\Controllers\V1\Settings\CompanyController;
use Dinvoice\Http\Controllers\V1\Settings\DiskController;
use Dinvoice\Http\Controllers\V1\Settings\GetCompanySettingsController;
use Dinvoice\Http\Controllers\V1\Settings\GetUserSettingsController;
use Dinvoice\Http\Controllers\V1\Settings\TaxTypesController;
use Dinvoice\Http\Controllers\V1\Settings\UpdateCompanySettingsController;
use Dinvoice\Http\Controllers\V1\Settings\UpdateUserSettingsController;
use Dinvoice\Http\Controllers\V1\Update\CheckVersionController;
use Dinvoice\Http\Controllers\V1\Update\CopyFilesController;
use Dinvoice\Http\Controllers\V1\Update\DeleteFilesController;
use Dinvoice\Http\Controllers\V1\Update\DownloadUpdateController;
use Dinvoice\Http\Controllers\V1\Update\FinishUpdateController;
use Dinvoice\Http\Controllers\V1\Update\MigrateUpdateController;
use Dinvoice\Http\Controllers\V1\Update\UnzipUpdateController;
use Dinvoice\Http\Controllers\V1\Users\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// ping
//----------------------------------

Route::get('ping', function () {
    return response()->json([
        'success' => 'dinvoice-self-hosted'
    ]);
})->name('ping');


// Version 1 endpoints
// --------------------------------------
Route::prefix('/v1')->group(function () {


    // App version
    // ----------------------------------

    Route::get('/app/version', AppVersionController::class);


    // Authentication & Password Reset
    //----------------------------------

    Route::group(['prefix' => 'auth'], function () {

        Route::post('login', [AuthController::class, 'login']);

        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

        // Send reset password mail
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware("throttle:10,2");;

        // handle reset password form process
        Route::post('reset/password', [ResetPasswordController::class, 'reset']);

    });


    // Countries
    //----------------------------------

    Route::get('/countries', CountriesController::class);


    // Onboarding
    //----------------------------------

    Route::middleware(['redirect-if-installed'])->group(function () {

        Route::get('/onboarding/wizard-step', [OnboardingWizardController::class, 'getStep']);

        Route::post('/onboarding/wizard-step', [OnboardingWizardController::class, 'updateStep']);

        Route::get('/onboarding/requirements', [RequirementsController::class, 'requirements']);

        Route::get('/onboarding/permissions', [PermissionsController::class, 'permissions']);

        Route::post('/onboarding/database/config', [DatabaseConfigurationController::class, 'saveDatabaseEnvironment']);

        Route::get('/onboarding/database/config', [DatabaseConfigurationController::class, 'getDatabaseEnvironment']);

        Route::post('/onboarding/finish', FinishController::class);

    });


    Route::middleware(['auth:sanctum', 'admin'])->group(function () {

        // Bootstrap
        //----------------------------------

        Route::get('/bootstrap', BootstrapController::class);


        // Dashboard
        //----------------------------------

        Route::get('/dashboard', DashboardController::class);


        // Search users
        //----------------------------------

        Route::get('/search', SearchController::class);


        // MISC
        //----------------------------------

        Route::get('/currencies', CurrenciesController::class);

        Route::get('/timezones', TimezonesController::class);

        Route::get('/date/formats', DateFormatsController::class);

        Route::get('/fiscal/years', FiscalYearsController::class);

        Route::get('/languages', LanguagesController::class);

        Route::get('/next-number', NextNumberController::class);


        // Self Update
        //----------------------------------

        Route::get('/check/update', CheckVersionController::class);

        Route::post('/update/download', DownloadUpdateController::class);

        Route::post('/update/unzip', UnzipUpdateController::class);

        Route::post('/update/copy', CopyFilesController::class);

        Route::post('/update/delete', DeleteFilesController::class);

        Route::post('/update/migrate', MigrateUpdateController::class);

        Route::post('/update/finish', FinishUpdateController::class);


        // Customers
        //----------------------------------

        Route::post('/customers/delete', [CustomersController::class, 'delete']);

        Route::get('customers/{customer}/stats', CustomerStatsController::class);

        Route::resource('customers', CustomersController::class);


        // Items
        //----------------------------------

        Route::post('/items/delete', [ItemsController::class, 'delete']);

        Route::resource('items', ItemsController::class);

        Route::resource('units', UnitsController::class);


        // Invoices
        //-------------------------------------------------

        Route::post('/invoices/{invoice}/send', SendInvoiceController::class);

        Route::post('/invoices/{invoice}/clone', CloneInvoiceController::class);

        Route::post('/invoices/{invoice}/status', ChangeInvoiceStatusController::class);

        Route::post('/invoices/delete', [InvoicesController::class, 'delete']);

        Route::get('/invoices/templates', InvoiceTemplatesController::class);

        Route::apiResource('invoices', InvoicesController::class);


        // Estimates
        //-------------------------------------------------

        Route::post('/estimates/{estimate}/send', SendEstimateController::class);

        Route::post('/estimates/{estimate}/status', ChangeEstimateStatusController::class);

        Route::post('/estimates/{estimate}/convert-to-invoice', ConvertEstimateController::class);

        Route::get('/estimates/templates', EstimateTemplatesController::class);

        Route::post('/estimates/delete', [EstimatesController::class, 'delete']);

        Route::apiResource('estimates', EstimatesController::class);


        // Expenses
        //----------------------------------

        Route::get('/expenses/{expense}/show/receipt', ShowReceiptController::class);

        Route::post('/expenses/{expense}/upload/receipts', UploadReceiptController::class);

        Route::post('/expenses/delete', [ExpensesController::class, 'delete']);

        Route::apiResource('expenses', ExpensesController::class);

        Route::apiResource('categories', ExpenseCategoriesController::class);


        // Payments
        //----------------------------------

        Route::post('/payments/{payment}/send', SendPaymentController::class);

        Route::post('/payments/delete', [PaymentsController::class, 'delete']);

        Route::apiResource('payments', PaymentsController::class);

        Route::apiResource('payment-methods', PaymentMethodsController::class);


        // Custom fields
        //----------------------------------

        Route::resource('custom-fields', CustomFieldsController::class);


        // Backup & Disk
        //----------------------------------

        Route::apiResource('backups', BackupsController::class);

        Route::apiResource('/disks', DiskController::class);

        Route::get('download-backup', DownloadBackupController::class);

        Route::get('/disk/drivers', [DiskController::class, 'getDiskDrivers']);


        // Settings
        //----------------------------------

        Route::get('/me', [CompanyController::class, 'getUser']);

        Route::put('/me', [CompanyController::class, 'updateProfile']);

        Route::get('/me/settings', GetUserSettingsController::class);

        Route::put('/me/settings', UpdateUserSettingsController::class);

        Route::post('/me/upload-avatar', [CompanyController::class, 'uploadAvatar']);


        Route::put('/company', [CompanyController::class, 'updateCompany']);

        Route::post('/company/upload-logo', [CompanyController::class, 'uploadCompanyLogo']);

        Route::get('/company/settings', GetCompanySettingsController::class);

        Route::post('/company/settings', UpdateCompanySettingsController::class);


        // Mails
        //----------------------------------

        Route::get('/mail/drivers', [MailConfigurationController::class, 'getMailDrivers']);

        Route::get('/mail/config', [MailConfigurationController::class, 'getMailEnvironment']);

        Route::post('/mail/config', [MailConfigurationController::class, 'saveMailEnvironment']);

        Route::post('/mail/test', [MailConfigurationController::class, 'testEmailConfig']);


        Route::apiResource('notes', NotesController::class);


        // Tax Types
        //----------------------------------

        Route::apiResource('tax-types', TaxTypesController::class);


        // Users
        //----------------------------------

        Route::post('/users/delete', [UsersController::class, 'delete']);

        Route::apiResource('/users', UsersController::class);

    });
});
