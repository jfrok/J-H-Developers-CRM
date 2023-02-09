<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\HoursController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\Controller;
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



//Route::get('/dashboard', function () {
//
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('/dashboard', [\App\Http\Controllers\Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/generalSearch', [\App\Http\Controllers\Controller::class, 'generalSearch'])->name('generalSearch');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
/// Controller
    Route::post('/alert-notifications',[Controller::class,'notification'])->name('add-notification');
    Route::get('/get-notifications',[Controller::class,'getNotification'])->name('get-notification');
//// Calendar
    Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');
    Route::get('/event-calendar', [CalendarController::class, 'eventData'])->name('eventData');
    Route::post('/event-calendar-add', [CalendarController::class, 'addEvent'])->name('addEvent');
    Route::post('/calendar-event-edited/{eId}', [CalendarController::class, 'editEvent'])->name('editEvent');
    Route::get('/event-deleted/{eId}', [CalendarController::class, 'deleteEvent'])->name('event.delete');
Route::prefix('customers',)->group(function (){
//// Customers
    Route::get('/customers-overview', [CustomersController::class, 'index'])->name('overview');
    Route::get('/search', [CustomersController::class, 'search'])->name('search');
    Route::get('/customers-details/{cId}', [CustomersController::class, 'details'])->name('details');
    Route::get('/customers-registering', [CustomersController::class, 'form'])->name('customer-form');
    Route::get('/view', [CustomersController::class, 'getCustomers'])->name('get-customers');
    Route::get('/customers-tap-view/{cId}', [CustomersController::class, 'getCustomersInTap'])->name('getCustomersInTap');
    Route::post('/customers-add', [CustomersController::class, 'addCustomer'])->name('add-customer');
    Route::get('/customers-edit/{cId}', [CustomersController::class, 'editCustomer'])->name('edit-customer');
    Route::post('/customers-edit-save/{cId}', [CustomersController::class, 'saveCustomer'])->name('edit-customer-save');
    Route::get('/customer-deleted/{cId}', [CustomersController::class, 'deleteCustomer'])->name('delete-customer');
    //PDF
//  Route::get('generate-pdf', [CustomersController::class,'createPDFv'])->name('Page-generator');
    Route::get('/generate-pdf-view/{cId}', [CustomersController::class, 'createPDFy'])->name('PDF-generator');
//    Route::get('/generate-pdf-view/{cId}', [CustomersController::class, 'createPDFy'])->name('Page-generator');
    Route::get('/pages',[CustomersController::class, 'pages'])->name('pages');
    Route::get('/view-PDF/{pId}', [CustomersController::class, 'viewPDF'])->name('view-Page');
    Route::post('/create-page', [\App\Http\Controllers\PagesController::class, 'createPage'])->name('create-page');
    Route::get('/load-page', [\App\Http\Controllers\PagesController::class, 'getPages'])->name('load-page');
    Route::get('/delete-page/{pId}', [\App\Http\Controllers\PagesController::class, 'deletePage'])->name('delete-page');
    // Scripts
    Route::get('/create-PDF/{pId}', [CustomersController::class, 'createPDF'])->name('create-scripts');
    Route::post('/add-scripts', [CustomersController::class, 'addScripts'])->name('add-scripts');
    Route::get('/view-scripts/{pId}', [CustomersController::class, 'scriptsView'])->name('view-scripts');
    Route::get('/scripts-deleted/{sId}', [CustomersController::class, 'deleteScripts'])->name('delete-scripts');
});
    //emails
    Route::post('/customer-message', [EmailsController::class, 'emailsHistory'])->name('send-message');
    Route::get('/message-view/{cId}', [EmailsController::class, 'messagesView'])->name('view-message');
// Projects
    Route::get('/projects/overview',[ProjectsController::class,'ProjectsOverview'])->name('projects-overview');
    Route::get('/projects/view',[ProjectsController::class,'ProjectsOverview'])->name('projects-overview');
    Route::get('/projects/request', [ProjectsController::class, 'getProjectRequest'])->name('get-project');

    Route::get('/projects/add-project',[ProjectsController::class,'Project'])->name('view-project');
    Route::post('/projects/added',[ProjectsController::class,'addProject'])->name('add-project');
    Route::get('/projects/details/{pId}',[ProjectsController::class,'details'])->name('details-project');
    Route::get('/project-edit/{pId}', [ProjectsController::class, 'editProject'])->name('edit-project');
    Route::get('/project-deleted/{pId}', [ProjectsController::class, 'projectDelete'])->name('delete-project');
    Route::post('/project-edit-save/{pId}', [ProjectsController::class, 'saveProject'])->name('edit-project-save');

    // Hours
    Route::get('/hours-overview', [HoursController::class, 'overview'])->name('hours-overview');
    Route::get('/hour-edit/{hId}', [HoursController::class, 'editHours'])->name('edit-hour');
    Route::get('/hour-deleted/{hId}', [HoursController::class, 'deleteHour'])->name('delete-hour');
    Route::post('/fill-hours', [HoursController::class, 'fillHours'])->name('hours-fill');
    Route::get('/get-hours', [HoursController::class, 'getHours'])->name('hours-get');
//    Route::get('test-hours', [HoursController::class,'getTotalHours'])->name('hours-test');
    //// Trash
    Route::get('/trash',[CustomersController::class,'trash'])->name('trash');
    Route::post('/trash-restore/{cId}', [CustomersController::class, 'restore'])->name('restore');
    Route::post('/trash-delete/{cId}', [CustomersController::class, 'forceDelete'])->name('forceDelete');

});


// testing
Route::fallback(function (){
   return view('404');
});
Route::get('/make-a-request',[\App\Http\Controllers\RequestController::class,'index'])->name('request');
Route::prefix('request')->group(function(){
    Route::get('/website',[\App\Http\Controllers\RequestController::class,'website'])->name('request.website');
    Route::get('/software',[\App\Http\Controllers\RequestController::class,'software'])->name('request.software');
    Route::post('/drop',[\App\Http\Controllers\RequestController::class,'store'])->name('request.drop');
    Route::post('/created',[\App\Http\Controllers\RequestController::class,'createReq'])->name('request.create');
});
//Route::get('test-total',[HoursController::class,'getWorkedHours'])->name('test-total');
//Route::get('/{page}', [Controller::class, 'page']);

require __DIR__ . '/auth.php';
