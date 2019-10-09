<?php

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


Route::get('/', function(){

    return redirect('dashboard');
});

Auth::routes();



Route::group(['prefix' => '/'],function(){

    Route::resource('dashboard', 'Administrator\DashboardController');
    Route::resource('add_menu', 'Administrator\Add_menuController');
    Route::resource('add_subs_menu', 'Administrator\Add_subs_menuController');
    Route::resource('add_user_role', 'Administrator\Add_user_roleController');
    Route::resource('add_user_permission','Administrator\Add_user_permissionController');
    Route::resource('add_user', 'Administrator\Add_userController');
});


Route::group(['prefix' => '/'],function(){

    Route::resource('addSubject', 'upangsho\UpangshoController')
        ->middleware('auth');
});




Route::group(['prefix' => '/'],function(){

    Route::resource('employee', 'employee\EmployeeController')
        ->middleware('auth');

});
Route::group(['prefix' => '/'],function(){
    Route::resource('add_khat', 'khat\KhatController')
        ->middleware('auth');
});

Route::group(['prefix' => '/'],function(){
    Route::resource('addDepertment', 'department\DepartmentsController')
        ->middleware('auth');
});


Route::group(['prefix' => '/'],function(){
    Route::resource('addmission', 'admission\AdmissionController')->middleware('auth');
});

Route::group(['prefix' => '/expensekhat'],function(){
    Route::resource('', 'expensekhat\ExpensekhatController')->middleware('auth');
});


Route::group(['prefix' => '/budget'],function(){

    Route::resource('', 'budget\BudgetController')->middleware('auth');
});

Route::group(['prefix' => '/balance_transfer'],function(){

    Route::resource('', 'balancetransfer\BalancetransferController')->middleware('auth');
});

Route::group(['prefix' => '/balance_sheet'],function(){

    Route::resource('', 'balancesheet\BalancesheetController')->middleware('auth');

});


Route::group(['prefix' => '/bank'],function(){

    Route::resource('', 'bank\BankController')->middleware('auth');
});

Route::group(['prefix' => '/branch'],function(){

    Route::resource('', 'branch\BranchController')->middleware('auth');
});

Route::group(['prefix' => '/'],function(){
    Route::resource('bankdetails', 'bankdetails\BankdetailsController')
        ->middleware('auth');
});

Route::group(['prefix' => '/incoexpense'],function(){

    Route::resource('', 'incoexpense\IncoexpenseController')
        ->middleware('auth');
});

Route::group(['prefix' => '/bank_report'],function(){

    Route::resource('', 'bank_report\Bank_reportController')
        ->middleware('auth');
});

Route::group(['prefix' => '/expense_report'],function(){

    Route::resource('', 'expense_report\Expense_reportController')
        ->middleware('auth');
});

Route::group(['prefix' => '/income_report'],function(){

    Route::resource('', 'income_report\Income_reportController')
        ->middleware('auth');
});
Route::group(['prefix' => '/check_register'],function(){

    Route::resource('', 'check_register\Check_registerController')
        ->middleware('auth');
});
Route::group(['prefix' => '/'],function(){

    Route::resource('bankopnblc', 'bankopnblc\BankopnblcController');
});

Route::group(['prefix' => '/'],function(){

    Route::resource('billingconfigure', 'billingconfiguration\BillingconfigurationController');
});

Route::group(['prefix' => '/'],function(){
    Route::resource('income', 'income\IncomeController');
});


Route::group(['prefix' => '/'],function(){

    Route::resource('expense', 'expense\ExpenseController');
});

Route::resource('abstruct_register', 'abstruct\AbstructController');

Route::group(['prefix' => '/'],function(){

    Route::resource('badget_register', 'badget_register\Badget_registerController');
});

Route::group(['prefix' => '/'], function(){

    Route::resource('vat', 'vat\VatController')->middleware('auth');
});


Route::group(['prefix' => '/'], function(){

    Route::resource('tax', 'tax\TaxController')->middleware('auth');
});



Route::group(['middleware' => 'auth'], function(){

    Route::get('/salaryProcessss',       'salary\SalaryController@getEmployeedetails');
    Route::get('budget_report/{name}',   'budget\BudgetReportController@index');
    Route::post('budget_report/{name}',  'budget\BudgetReportController@store');
    Route::get('budget_management',      'budget\BudgetController@showbudget');
    Route::post('budget_update',         'budget\BudgetController@updatebudget');
    Route::resource('budget_approve',    'budget\BudgetApproveController');
    Route::get('budgetallow',            'budget\BudgetController@budgetallow');




});
Route::namespace('check_register')->middleware('auth')->group(function (){
    Route::get('check_register/{id}',    'Check_registerController@updateexpense');
    Route::get('check_register',         'Check_registerController@store');

});


Route::namespace('student')->middleware('auth')->group(function (){
    Route::get('students',                      'studentController@index');
    Route::post('studentlist',                  'studentController@subjectwisestudent');
    Route::post('subjectwithdetail',            'studentController@subjectwithdetail');
    Route::get('studentpaymentreport',           'studentController@studentpaymentreport');
    Route::post('studentpaymentreport',          'studentController@studentpaymentreportprocess');
    Route::get('student_drop/{id}',              'studentController@deopstudent');
    Route::get('deopstudentlist',              'studentController@deopstudentlist');


});

Route::namespace('courses')->middleware('auth')->group(function (){
    Route::post('getSubjectwhoutseme',  'CourseController@getSubjectwhoutsemed');
    Route::post('view_courses',         'CourseController@viewcourseswithid');
    Route::get('viewcourse',            'CourseController@viewcourses');
    Route::post('getSubject',           'CourseController@degree_id');
    Route::post('getcoursewithseme',    'CourseController@semesterwithsubject');
    Route::post('getcourses_id',       'CourseController@getcourses_id_with_semester');


});

Route::namespace('billingconfiguration')->middleware('auth')->group(function (){

    Route::post('get_billing_with_sub',          'BillingconfigurationController@getbillingwithid');
    Route::post('get_student_session',           'BillingconfigurationController@criculamupdate');
    Route::post('getSubjecbillingt',             'BillingconfigurationController@degree_id');
    Route::post('billingconfigureupdate',        'BillingconfigurationController@update_masterdetails');
    Route::get('semester-billing',               'BillingconfigurationController@view_semester_billing');
    Route::post('semester-billing',              'BillingconfigurationController@store_semester_billing');
    Route::get('student_bill_type',              'BillingconfigurationController@createbilltype');
    Route::post('student_bill_type',             'BillingconfigurationController@storebillltype');
    Route::get('billingofstudenttype',           'BillingconfigurationController@createbilltypes');
    Route::post('billingofstudenttype',           'BillingconfigurationController@storebillinfo');

});

Route::namespace('admission')->middleware('auth')->group(function (){

    Route::get('getstd_masterdetails/{id}/{id1}/{id2}',   'AdmissionController@masterdetails');
    Route::get('admissiondue',                        'AdmissionController@viewallduestduent');
    Route::post('generateid',                         'AdmissionController@adnewstudentid');
    Route::post('admissionpayment/{id}',              'AdmissionController@adm_pay_stpore');
    Route::get('studentRegistrationReport',            'AdmissionController@registrationReport');
    Route::post('studentRegistrationReport',           'AdmissionController@generateRegistrationReport');
    Route::get('admissionSlip',                        'AdmissionController@admissionSlip');
    Route::post('admissionSlip',                       'AdmissionController@admission_slip');
    Route::get('viewAmissionSlip',                     'AdmissionController@viewAmissionSlip');
    Route::get('printAmissionSlip/{id}/{copy}',         'AdmissionController@printAmissionSlip');
    Route::get('addmissiontest',                        'AdmissionController@addmissiontest');
    Route::post('pre_addmission',                        'AdmissionController@pre_addmission');
    Route::get('preadmissiontestresult_show',            'AdmissionController@preadmissiontestresult_show');
    Route::post('admission-test-student-list',           'AdmissionController@getadmissionteststudentlist');
    Route::post('preadmissiontestresult_show',           'AdmissionController@student_test_report_process');
    Route::get('get_student_print', 'AdmissionController@get_student_print');
    Route::post('get_student_print', 'AdmissionController@student_prient_process');

});

Route::namespace('incoexpense')->middleware('auth')->group(function (){
    Route::post('update-incomeexpense', 'IncoexpenseController@updatincomeexpense');
    Route::get('incoexpense_managment', 'IncoexpenseController@showincomeexpnses');


});



Route::namespace('employee')->middleware('auth')->group(function (){


    Route::get('getemployee_leave',  'EmployeeController@getemployeeleave');
    Route::post('get_employe_details',  'EmployeeController@employeewith_id');
    Route::post('addemployleave',  'EmployeeController@employleavestore');
    Route::get('employeloan',  'EmployeeController@createloan');
    Route::post('employeloan',  'EmployeeController@storeloan');
    Route::get('loan-type',  'EmployeeController@createloantype');
    Route::post('loan-type',  'EmployeeController@storeloantype');
    Route::post('get_employe_id',  'EmployeeController@get_employe_id');
    Route::get('employee_activity',  'EmployeeController@employee_activity');
    Route::post('employee_activity_with_id',  'EmployeeController@employee_activity_with_id');
    Route::get('temporaray_teacher_list',  'EmployeeController@temporaray_teacher_list');
    Route::get('assigned_teacher',  'EmployeeController@assigned_teacher');
    Route::get('temporaray_teacher_list_payment',  'EmployeeController@temporaray_teacher_list_payment');
    Route::post('assigned_teacher',  'EmployeeController@store_assign_teacher');
    Route::get('payment_adjunct_teacher/{id}',  'EmployeeController@payment_adjunct_teacher');
    Route::post('update_adject_details',  'EmployeeController@update_adject_details');
    Route::post('update_assigned_teacher/{id}',  'EmployeeController@update_assigned_teacher');

    Route::get('employeeleavemangment',  'EmployeeController@employee_leave_management');
    Route::get('employee_leave_report_management',  'EmployeeController@employee_report_leave_management');

    Route::get('employeleavereportprint/{id}',  'EmployeeController@employeleavereportprint');

    Route::get('edit_employee_leave',  'EmployeeController@edit_employee_leave');

});

Route::namespace('bankdetails')->middleware('auth')->group(function (){
    Route::post('get_acounts_details',   'BankdetailsController@getbankdetails');
    Route::post('getbranches',           'BankdetailsController@get_branch');
    Route::post('get_cashacounts_details',   'BankdetailsController@getcashbankdetails');
});

Route::namespace('salary')->middleware('auth')->group(function (){

    Route::resource('SalaryProgress', 'SalaryController');
    Route::get('employesalaryshet', 'SalaryController@employesalaryshet');
    Route::post('employesalaryshet', 'SalaryController@processsalaryshet');
    Route::get('salaryp_update', 'SalaryController@salarypupdate');
    Route::get('salaryp_update/update', 'SalaryController@update');
    Route::post('updatesalary', 'SalaryController@updatesalary');
    Route::get('salary_report', 'SalaryController@salaryreport');
    Route::post('salary_report/details', 'SalaryController@salaryreportdetails');
    Route::get('SalaryOrderbank', 'SalaryController@SalaryOrderbank');
    Route::post('SalaryOrderbank', 'SalaryController@processsbankoredr');


});

Route::namespace('inventory')->middleware('auth')->group(function (){


    Route::get('inventorycategory',   'InventoryController@index');
    Route::post('createinventory',   'InventoryController@store');
    Route::get('subcategory',          'InventoryController@create');
    Route::post('createinventorysubcat',   'InventoryController@postsubcat');
    Route::get('addproduct',         'InventoryController@addproduct');
    Route::post('addproduct',        'InventoryController@storeproduct');
    Route::get('add_supplier',       'InventoryController@add_supplier');
    Route::post('add_supplier',      'InventoryController@add_supplierstore');
    Route::post('getsubcategory',     'InventoryController@getsubcategory');
    Route::post('payment_typecheck',  'InventoryController@getpaymenttype');
    Route::post('product',            'InventoryController@getproductfrominventory');
    Route::get('damageproduct',       'InventoryController@createdamageproduct');
    Route::post('damageproduct',       'InventoryController@storeedamageproduct');
    Route::get('print_product',        'InventoryController@print_product');
    Route::get('print_product/{id}',        'InventoryController@print_product_process');

    Route::post('subcategory_id',       'InventoryController@subcategory_id');
    Route::get('product_distribution',       'InventoryController@product_distribution');
    Route::post('product_distribution',       'InventoryController@product_distribution_stor');

    Route::get('product_report',       'InventoryController@product_report');

});

Route::namespace('designation')->middleware('auth')->group(function (){

    Route::resource('addDesignation', 'DesignationsController');
    Route::post('getdesignation',       'DesignationsController@show');
});

Route::namespace('expense')->middleware('auth')->group(function () {
    Route::get('expenseType', 'ExpenseController@expenseType');
    Route::get('yearlyExpenseType', 'ExpenseController@yearlyExpenseType');
    Route::get('yearlyExpense', 'ExpenseController@yearlyExpense');
    Route::get('expense', 'ExpenseController@expense');
    Route::get('balanceTransfer', 'ExpenseController@balanceTransfer');
    Route::post('expenseType', 'ExpenseController@makeExpenseType');
    Route::post('expensesubtype', 'ExpenseController@expensesubtype');
    Route::post('yearlyExpenseType', 'ExpenseController@makeYearlyExpenseType');
    Route::post('yearlyExpense', 'ExpenseController@makeYearlyExpense');
    Route::post('expense', 'ExpenseController@makeExpense');
    Route::post('balanceTransfer', 'ExpenseController@makeBalanceTransfer');
    Route::get('credit_voucher/{id}', 'ExpenseController@credit_voucher_print');

});

Route::namespace('report')->middleware('auth')->group(function () {
    Route::get('balanceSheet', 'BalanceSheetReportController@balanceSheet');
    Route::post('updateopeningbalance', 'BalanceSheetReportController@updateopening');
});

Route::namespace('financial')->middleware('auth')->group(function () {
    Route::resource('financial', 'FinancialController');
    Route::post('financial', 'FinancialController@finacial_report');
    Route::get('receipts_payments', 'FinancialController@receipts_payments');
    Route::post('receipts_payments', 'FinancialController@receipts_payments_post');
});

Route::namespace('income')->middleware('auth')->group(function () {
    Route::resource('income_type', 'IncomeController');
    Route::post('income_type2', 'IncomeController@stor2');
    Route::get('income', 'IncomeController@income_form');
    Route::post('income', 'IncomeController@income_post');
    Route::get('debit_voucher/{id}', 'IncomeController@debit_voucher_print');

});

Route::get('getemployee',  'employee\EmployeeController@getemployee');
Route::post('updateemployee',  'employee\EmployeeController@updateemployee');

Route::namespace('cashbook')->middleware('auth')->group(function () {

    Route::resource('cashbook', 'CashbookController');
    Route::get('ledger', 'CashbookController@ledger');
    Route::post('cashbook_year', 'CashbookController@cashbook_year');
    Route::get('cashbook_year', 'CashbookController@index');
    Route::post('ledger', 'CashbookController@ledger_post');
    Route::post('updateaccounts', 'CashbookController@updateaccounts');
});

Route::namespace('depreciation')->middleware('auth')->group(function () {

    Route::resource('cost_depreciation', 'DepreciationController');

});

Route::get('getemployee',  'employee\EmployeeController@getemployee');
Route::get('getemployeedetails',  'employee\EmployeeController@getemployeedetails');
Route::post('updateemployee',  'employee\EmployeeController@updateemployee');
