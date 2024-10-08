<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\FinanceReport;
use App\Models\Sale;
use App\Models\Tax;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {

    DB::table('users')->orderBy('id')->lazy()->each(function (object $user) {
        // ...
    });

    return view('welcome');
});

// Truy vấn kết hợp nhiều bảng (JOIN):
// Route::get('1', function () {

//     DB::table('users as u')
//         ->join('orders as o', 'u.id', '=', 'o.user_id')
//         ->select('u.name', DB::raw('SUM(o.amount) as total_spent'))
//         ->groupBy('u.name')
//         ->having('total_spent', '>', 1000)
//         ->get();
// });

// Truy vấn thống kê dựa trên khoảng thời gian:
// Route::get('2', function () {

//     DB::table('orders')
//         ->select(DB::raw('DATE(order_date) as date'), DB::raw('COUNT(*) as orders_count'), DB::raw('SUM(total_amount) as total_sales'))
//         ->whereBetween('order_date', ['2024-01-01', '2024-09-30'])
//         ->groupBy(DB::raw('DATE(order_date)'))
//         ->get();
// });

// Truy vấn để tìm kiếm giá trị không có trong tập kết quả khác (NOT EXISTS)
// Route::get('3', function () {

//     DB::table('products as p')
//         ->whereNotExists(function ($query) {
//             $query->select(DB::raw(1))
//                 ->from('orders as o')
//                 ->whereRaw('o.product_id = p.id');
//         })
//         ->pluck('product_name');
// });

// Truy vấn với CTE (Common Table Expression)
// Route::get('4', function () {

//     DB::table('products as p')
//         ->join(DB::raw('(SELECT product_id, SUM(quantity) AS total_sold FROM sales GROUP BY product_id) as s'), 'p.id', '=', 's.product_id')
//         ->select('p.product_name', 's.total_sold')
//         ->where('s.total_sold', '>', 100)
//         ->get();
// });

// Truy vấn lấy danh sách người dùng đã mua sản phẩm trong 30 ngày qua:
// Route::get('5', function () {

//     DB::table('users as u')
//         ->join('orders as o', 'u.id', '=', 'o.user_id')
//         ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
//         ->join('products as p', 'oi.product_id', '=', 'p.id')
//         ->select('u.name as user_name', 'p.product_name', 'o.order_date')
//         ->where('o.order_date', '>=', DB::raw('NOW() - INTERVAL 30 DAY'))
//         ->get();
// });

// Truy vấn lấy tổng doanh thu theo từng tháng, chỉ tính những đơn hàng đã hoàn thành
// Route::get('6', function () {

//     DB::table('orders as o')
//         ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
//         ->select(DB::raw("DATE_FORMAT(o.order_date, '%Y-%m') as order_month"), DB::raw('SUM(oi.quantity * oi.price) as total_revenue'))
//         ->where('o.status', 'completed')
//         ->groupBy(DB::raw("DATE_FORMAT(o.order_date, '%Y-%m')"))
//         ->orderBy('order_month', 'desc')
//         ->get();
// });


// Truy vấn các sản phẩm chưa từng được bán (sản phẩm không có trong bảng order_items)
// Route::get('7', function () {

//     DB::table('products as p')
//         ->leftJoin('order_items as oi', 'p.id', '=', 'oi.product_id')
//         ->whereNull('oi.product_id')
//         ->select('p.product_name')
//         ->get();
// });

// Lấy danh sách các sản phẩm có doanh thu cao nhất cho mỗi loại sản phẩm
// Route::get('8', function () {
//     DB::table('products as p')
//         ->join(DB::raw('(SELECT product_id, SUM(quantity * price) AS total FROM order_items GROUP BY product_id) as oi'), 'p.id', '=', 'oi.product_id')
//         ->select('p.category_id', 'p.product_name', DB::raw('MAX(oi.total) AS max_revenue'))
//         ->groupBy('p.category_id', 'p.product_name')
//         ->orderBy('max_revenue', 'desc')
//         ->get();
// });


// Truy vấn thông tin chi tiết về các đơn hàng có giá trị lớn hơn mức trung bình:
// Route::get('9', function () {

//     $subquery = DB::table('order_items')
//         ->select(DB::raw('SUM(quantity * price) AS total'))
//         ->groupBy('order_id');

//     $avgOrderValue = DB::table(DB::raw("({$subquery->toSql()}) as avg_order_value"))
//         ->select(DB::raw('AVG(total)'))
//         ->value('AVG(total)');

//     DB::table('orders')
//         ->join('users', 'users.id', '=', 'orders.user_id')
//         ->join('order_items', 'orders.id', '=', 'order_items.order_id')
//         ->select('orders.id', 'users.name', 'orders.order_date', DB::raw('SUM(order_items.quantity * order_items.price) AS total_value'))
//         ->groupBy('orders.id', 'users.name', 'orders.order_date')
//         ->having('total_value', '>', $avgOrderValue)
//         ->get();
// });

// Truy vấn tìm tất cả các sản phẩm có doanh số cao nhất trong từng danh mục (category)
// Route::get('10', function () {

//     $subquery = DB::table('order_items')
//         ->join('products', 'order_items.product_id', '=', 'products.id')
//         ->select('products.product_name', DB::raw('SUM(order_items.quantity) AS total_sold'))
//         ->whereColumn('products.category_id', 'p.category_id')
//         ->groupBy('products.product_name');

//     $maxTotalSold = DB::table(DB::raw("({$subquery->toSql()}) as sub"))
//         ->select(DB::raw('MAX(sub.total_sold)'));

//     DB::table('products as p')
//         ->join('order_items as oi', 'p.id', '=', 'oi.product_id')
//         ->select('p.category_id', 'p.product_name', DB::raw('SUM(oi.quantity) AS total_sold'))
//         ->groupBy('p.category_id', 'p.product_name')
//         ->havingRaw('total_sold = ?', [$maxTotalSold->toSql()])
//         ->get();
// });



// (1). Tính tổng doanh thu theo tháng
// 1. QueryBuiler
// Route::get('1', function () {
//     return DB::table('sales')
//         ->select(
//             DB::raw('SUM(total) as total_sales'),
//             DB::raw('EXTRACT(MONTH FROM sale_date) as month'),
//             DB::raw('EXTRACT(YEAR FROM sale_date) as year')
//         )
//         ->groupBy(DB::raw('EXTRACT(MONTH FROM sale_date)'), DB::raw('EXTRACT(YEAR FROM sale_date)'))
//         ->get();
// });

//1. Eloquent
// Route::get('2', function () {
//     return Sale::select(
//         DB::raw('SUM(total) as total_sales'),
//         DB::raw('EXTRACT(MONTH FROM sale_date) as month'),
//         DB::raw('EXTRACT(YEAR FROM sale_date) as year')
//     )
//         ->groupBy(DB::raw('EXTRACT(MONTH FROM sale_date)'), DB::raw('EXTRACT(YEAR FROM sale_date)'))
//         ->get();
// });

//(2) Tính tổng chi phí theo tháng
// 2. QueryBuiler
// Route::get('3', function () {
//     return DB::table('expenses')
//         ->select(
//             DB::raw('SUM(amount) as total_expenses'),
//             DB::raw('EXTRACT(MONTH FROM expense_date) as month'),
//             DB::raw('EXTRACT(YEAR FROM expense_date) as year')
//         )
//         ->groupBy(DB::raw('EXTRACT(MONTH FROM expense_date)'), DB::raw('EXTRACT(YEAR FROM expense_date)'))
//         ->get();
// });
//2. Eloquent
// Route::get('4', function () {
//     return Expense::select(
//         DB::raw('SUM(amount) as total_expenses'),
//         DB::raw('EXTRACT(MONTH FROM expense_date) as month'),
//         DB::raw('EXTRACT(YEAR FROM expense_date) as year')
//     )
//         ->groupBy(DB::raw('EXTRACT(MONTH FROM expense_date)'), DB::raw('EXTRACT(YEAR FROM expense_date)'))
//         ->get();
// });

//3. Tao bao cao tai chinh cho 1 thang
// Route::get('5', function () {
//     DB::table('finance_reports')->insert([
//         'month' => 9,
//         'year' => 2024,
//         'total_sales' => DB::table('sales')
//             ->whereMonth('sale_date', 9)
//             ->whereYear('sale_date', 2024)
//             ->sum('total'),
//         'total_expenses' => DB::table('expenses')
//             ->whereMonth('expense_date', 9)
//             ->whereYear('expense_date', 2024)
//             ->sum('amount'),
//         'profit_before_tax' => DB::raw('total_sales - total_expenses'),
//         'tax_amount' => DB::raw('total_sales * (SELECT rate FROM taxes WHERE tax_name = "VAT")'),
//         'profit_after_tax' => DB::raw('profit_before_tax - tax_amount')
//     ]);
// });

// 3. Eloquent
// Route::get('6', function () {
//     $total_sales = Sale::whereMonth('sale_date', 9)
//         ->whereYear('sale_date', 2024)
//         ->sum('total');

//     $total_expenses = Expense::whereMonth('expense_date', 9)
//         ->whereYear('expense_date', 2024)
//         ->sum('amount');

//     $tax_rate = Tax::where('tax_name', 'VAT')->value('rate');

//     $profit_before_tax = $total_sales - $total_expenses;
//     $tax_amount = $profit_before_tax * $tax_rate;
//     $profit_after_tax = $profit_before_tax - $tax_amount;

//     FinanceReport::create([
//         'month' => 9,
//         'year' => 2024,
//         'total_sales' => $total_sales,
//         'total_expenses' => $total_expenses,
//         'profit_before_tax' => $profit_before_tax,
//         'tax_amount' => $tax_amount,
//         'profit_after_tax' => $profit_after_tax,
//     ]);
// });

Route::resource('customers', CustomerController::class);
Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])->name('customers.forceDestroy');

Route::resource('employees',EmployeeController::class);
Route::delete('employees/{employee}/forceDestroy',[EmployeeController::class, 'forceDestroy'])->name('employees.forceDestroy');