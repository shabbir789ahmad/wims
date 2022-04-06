<?php
use  App\Models\ProductBrand;
use  App\Models\Brand;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Panel\DashboardController;

use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\UnitController;
use App\Http\Controllers\Pos\MainController;

use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\SubCategoryController;
use App\Http\Controllers\Panel\SupplierController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\PayableController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ReturnProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnvcredentialController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ReportController;

 

Route::get('/', [AuthController::class, 'login'])->name('login');
//password reset linkd
Route::get('/forgot/password', [PasswordController::class, 'forgotPasswordEmail'])->name('forgot.password');
Route::post('password/reset/email', [PasswordController::class, 'sendForgotPasswordEmail'])->name('password.reset.email');
Route::get('reset/{token}password', [PasswordController::class, 'resetView'])->name('reset.password');
Route::post('password/reset', [PasswordController::class, 'resetPassword'])->name('password.reset');



Route::get('/admin/register', [AuthController::class, 'register'])->name('regirter');

Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('register');

Route::middleware(['auth:admin', 'meta'])->group(function() {
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::view('no-permission','permission');
  
 Route::middleware('rolescheck')->group(function(){

 Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

 });

//route only admin can see ad oprate
 Route::middleware('adminonly')->group(function(){

 //brand route
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{id}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');

//unit route
    Route::get('/units', [UnitController::class, 'index'])->name('units.index');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store');
    Route::get('/units/{id}/edit', [UnitController::class, 'edit'])->name('units.edit');
    Route::put('/units/{id}', [UnitController::class, 'update'])->name('units.update');
    Route::delete('/units/{id}', [UnitController::class, 'destroy'])->name('units.destroy');    

//category route

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    //sub category route

    Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
    Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');
    Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
    Route::get('/sub-categories/{id}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
    Route::put('/sub-categories/{id}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
    Route::delete('/sub-categories/{id}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy');

    //supplier route
     Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    //product route
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/copy', [ProductController::class, 'copyProduct'])->name('products.copy');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/create-bulk', [ProductController::class, 'createBulk'])->name('products.create-bulk');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    // Route::post('/products-bulk', [ProductController::class, 'copBulk'])->name('products.storeBulk');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


     //update product in bulk route
    Route::get('/products/bulk', [ProductController::class, 'UpdateBluk'])->name('products.update.bulk');
    Route::get('/get-products2', [ProductController::class, 'getProduct2'])->name('products.get2');
    Route::post('/products-bulk-update', [ProductController::class, 'updateBulkProduct'])->name('products.Bulk-update');
   
   //create new from existing product route
     Route::get('/get-products', [ProductController::class, 'getProduct'])->name('products.get');
     Route::post('/products-bulk-new', [ProductController::class, 'copyBulk'])->name('products.copyBulk');
    
    //stock route
     Route::get('/products/{id}/stock', [StockController::class, 'getProduct'])->name('products.stock');
     Route::post('/stock/add', [StockController::class, 'stockAdd'])->name('stock.add');
    Route::post('stock/all',[StockController::class, 'UpdateStock'])->name('all.stock');
    Route::delete('delete/stock/{id}',[StockController::class, 'DeleteStock'])->name('stock.delete');
        Route::get('/active/stock', [StockController::class, 'activeStock']);

        // add admin user
     Route::get('user', [UserController::class, 'index'])->name('user.index');
     Route::get('create/user', [UserController::class, 'create'])->name('user.create');
     Route::post('user/save', [UserController::class, 'save'])->name('user.save');
     Route::get('edit/{id}/user', [UserController::class, 'edit'])->name('user.edit');
     Route::put('update/{id}/user', [UserController::class, 'update'])->name('update.user');
     Route::delete('user/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');

     //generate barcode

      Route::resource('barcode', BarcodeController::class);
      Route::resource('report', ReportController::class);
      Route::resource('credentials', EnvcredentialController::class);
       Route::get('product/{id}/barcode',[BarcodeController::class,'productBarcode'])->name('product.barcode');
       Route::get('sub-categories/{id}/product',[BarcodeController::class,'product'])->name('sub-categories.product');


     Route::post('products-bulk-ajax',[ProductController::class,'storeProductInBulk'])->name('products.storeBulk');
     Route::get('categories/{id}/sub-categories', function() {

        $data = \DB::table('sub_categories')
            ->select('sub_categories.*')
            ->join('categories', 'categories.id', 'sub_categories.category_id')
            ->where('categories.id', request('id'))
            ->get();
        
        return response()->json($data);

    });
 });


   





   

    
     
    

    // Route::post('/products-bulk-update2', [ProductController::class, 'updateBulkProduct2'])->name('products.Bulk-update2');

// //update Name Route
//      Route::post('/update/{id}/name', [ProductController::class, 'updateName'])->name('product.update.name');
     


//point of Sale
        Route::get('/pos/products/get/{id}', [MainController::class, 'product'])->name('pos.index');
   Route::get('/cancel-order', function() {session()->forget('cart');});
   Route::get('pos/acount-data',[CustomerController::class,'accountData']);
   Route::get('pos/sale-data',[SaleController::class,'SaleData']);

    
     // Route::get('/pos/get/orders/{id}', [MainController::class, 'getOrders'])->name('pos.get.orders');

    Route::get('product-get/{id}',[OrderController::class,'getProduct'])->name('product-get/{id}');

      Route::delete('delete/{id}', [OrderController::class, 'remove']);
Route::view('header','header');
//expensses route and payment route
      Route::get('expence/index',[ExpenseController::class,'index'])->name('expence.index');
      Route::post('add-expense',[ExpenseController::class,'expense']);
      Route::get('expense/type',[ExpenseController::class,'expenseType'])->name('expense.index');
      Route::Post('/expense/create',[ExpenseController::class,'expenseCreateType'])->name('expense.create');
      Route::put('/expense/update', [ExpenseController::class, 'expenseUpdate'])->name('expense.update');
      Route::delete('/expense/{id}/destroy', [ExpenseController::class, 'expenseDelete'])->name('expense.destroy');
      Route::get('/get/expense/type',[ExpenseController::class,'getExpenseType']);
     

     //payment payable route and payment route
     
      Route::get('payable/index',[PayableController::class,'index'])->name('payable.index');
     Route::get('payable/supplier',[PayableController::class,'supplier'])->name('payable.supplier');
      Route::Post('/payable/create',[PayableController::class,'create'])->name('payable.create');
      Route::post('pay/now/{id}', [PayableController::class, 'payNow'])->name('pay.now');
     Route::get('/supplier',[PayableController::class,'allSupplier'])->name('supplier');

//ghbfgh
      Route::post('payment/{id}/get',[PaymentController::class,'paymentRecieve'])->name('payment.edit');
      //installment routes
      Route::get('payment/recive',[InstallmentController::class,'index'])->name('payment/recive');
      Route::get('/get/payment/installment',[InstallmentController::class,'accountInstallment']);
      Route::post('make/Installment',[InstallmentController::class,'makeInstallment'])->name('make.Installment');
      Route::post('/recieve/payment/from/customer',[PaymentController::class,'paymentRecieve']);
     Route::get('account/{id}/all_instalment',[InstallmentController::class,'accountInstallment'])->name('account.installment');
     Route::get('/recieve/installment',[InstallmentController::class,'recieveInstallment']);
     Route::get('/new/installment',[InstallmentController::class,'newInstallmentindex']);

// add or show customer route
    Route::get('customer/{id}/get', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::get('customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('add-customer', [CustomerController::class, 'create']);
    Route::delete('customer/{id}/destory', [CustomerController::class, 'destroy'])->name('customer.destory');
    Route::put('customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');

    
    // Route::put('customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
  
  // return product by customer route

    Route::resource('return',ReturnProductController::class);
    Route::get('invoice/data', [ReturnProductController::class, 'create'])->name('invoice.data');
    Route::get('pos/customer', function() {

        $data = \DB::table('customers')
            ->get();
        
        return response()->json($data);

    });
    
//brand route for pos filter brand

    Route::get('pos/brand/{id}', function() {
     $id=request('id');
        $query = Brand::Branch();

        if($id != 0)
        {
         $query=$query->join('product_brands','brands.id','=','product_brands.brand_id')->where('product_brands.product_id',$id);
        }
        
        $data=$query->get();
        return response()->json($data);

    });
//pos with session route
    Route::post('order/session', [OrderController::class, 'order']);
    Route::post('/order/order/printer', [OrderController::class, 'orderPayment']);
    Route::get('/order/scanner', [OrderController::class, 'dataCanner']);
    Route::delete('delete/', [OrderController::class, 'remove']);
    Route::post('pos/update/orders/ajax', [OrderController::class, 'updateSessionOrder']);

//pos orders and payment route
   Route::post('pos/orders', [OrderController::class, 'order']); 
   Route::post('pos/payment', [OrderController::class, 'orderPayment'])->name('order.payment'); 
   
  // Route::post('pos/update/orders/ajax2', [OrderController::class, 'updateOrder2']); 

   Route::get('/pos/get/orders/ajax', function() {

        $data = \DB::table('orders')->latest()->first();
        
        return response()->json($data);

    });

//dsfdsf

   
    


});
