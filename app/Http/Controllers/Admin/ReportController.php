<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\AccountHeadSubType;
use App\Models\AccountHeadType;
use App\Models\BankAccount;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Cash;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\MobileBanking;
use App\Models\PurchaseInventory;
use App\Models\PurchaseOrder;
use App\Models\ProductPurchaseOrder;
use App\Models\Product;
use App\Models\PurchaseProductSalesOrder;
use App\Models\Salary;
use App\Models\SalaryProcess;
use App\Models\SalesOrder;
use App\Models\Supplier;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function purchase(Request $request) {
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $appends = [];
        $query = PurchaseOrder::query();

        if ($request->date && $request->date != '') {
            $dates = explode(' - ', $request->date);
            if (count($dates) == 2) {
                $query->whereBetween('date', [$dates[0], $dates[1]]);
                $appends['date'] = $request->date;
            }
        }

        if ($request->supplier && $request->supplier != '') {
            $query->where('supplier_id', $request->supplier);
            $appends['supplier'] = $request->supplier;
        }

        if ($request->purchaseId && $request->purchaseId != '') {
            $query->where('order_no', $request->purchaseId);
            $appends['purchaseId'] = $request->purchaseId;
        }

        if ($request->product && $request->product != '') {
            $query->whereHas('products', function($q) use ($request) {
                $q->where('product_id', '=', $request->product);
            });

            $appends['product'] = $request->product;
        }

        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');

        $data = [
            'total' => $query->sum('total'),
            'due' => $query->sum('due'),
            'paid' => $query->sum('paid'),
        ];

        $orders = $query->paginate(10);



        return view('admin.report.purchase', compact('orders', 'suppliers',
            'products', 'appends'))->with($data);
    }

    public function sale(Request $request) {
        $banks = Bank::where('status',1)->get();
        $customers = Customer::orderBy('name')->get();
        $products = PurchaseProduct::orderBy('name')->get();
        if (Auth::user()->role == 1)
            $definePercent = 1;
        else
            $definePercent = .4;

        $appends = [];
        $query = SalesOrder::query();

        if ($request->date && $request->date != '') {
            $dates = explode(' - ', $request->date);
            if (count($dates) == 2) {
                $query->whereBetween('date', [$dates[0], $dates[1]]);
                $appends['date'] = $request->date;
            }
        }

        if ($request->customer && $request->customer != '') {
            $query->where('customer_id', $request->customer);
            $appends['customer'] = $request->customer;
        }
        if ($request->due && $request->due != '') {
            $query->where('due', '>',0);
            $appends['due'] = $request->due;
        }

        if ($request->saleId && $request->saleId != '') {
            $query->where('order_no', $request->saleId);
            $appends['saleId'] = $request->saleId;
        }

        if ($request->product && $request->product != '') {
            $query->whereHas('products', function($q) use ($request) {
                $q->where('purchase_product_id', '=', $request->product);
            });

            $appends['product'] = $request->product;
        }

        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');

        $data = [
            'total' => $query->sum('total'),
            'due' => $query->sum('due'),
            'paid' => $query->sum('paid'),
            'refund' => $query->sum('refund'),
        ];

        $orders = $query->paginate(10);

        return view('report.sale', compact('customers', 'products',
            'appends', 'orders','banks','definePercent'))->with($data);
    }

    public function balanceSheet() {

        if (Auth::user()->role == 1)
            $definePercent = 1;
        else
            $definePercent = .4;

        $bankAccounts = BankAccount::where('status', 1)->with('bank', 'branch')->get();
        $cash = Cash::first();
        $card = Card::first();
        $mobileBanking = MobileBanking::first();
        $customerTotalPaid = Customer::all()->sum('due');
        $suppliers = Supplier::all();
        $totalInventory = PurchaseInventory::where('quantity',1)->sum('avg_unit_price');

        return view('report.balance_sheet', compact('bankAccounts',
            'cash','card','mobileBanking', 'customerTotalPaid', 'suppliers', 'totalInventory',
        'definePercent'));
    }

    public function profitAndLoss(Request $request) {
        $incomes = null;
        $expenses = null;
        $totalWorkPurposeAndVat = null;

        if (Auth::user()->role == 1)
            $definePercent = 1;
        else
            $definePercent = .4;

        if ($request->start && $request->end) {
            $incomes = TransactionLog::where('transaction_type', 1)->whereBetween('date', [$request->start, $request->end])->get();
            $expenses = TransactionLog::whereIn('transaction_type', [4, 2,5])->whereBetween('date', [$request->start, $request->end])->get();

            $workPurpose = SalesOrder::whereBetween('date', [$request->start, $request->end])
                            ->sum('work_purpose');

            $vat = SalesOrder::whereBetween('date', [$request->start, $request->end])
                            ->sum('vat');

            $totalWorkPurposeAndVat = $workPurpose + $vat;

        }



        return view('report.profit_and_loss', compact('incomes', 'expenses',
        'totalWorkPurposeAndVat','definePercent'));
    }

    public function ledger(Request $request) {
        $incomes = null;
        $expenses = null;


//        if ($request->start && $request->end) {
//            $incomes = TransactionLog::whereIn('transaction_type', [1, 5])->whereBetween('date', [$request->start, $request->end])->get();
//            $expenses = TransactionLog::whereIn('transaction_type', [3, 2, 6])->whereBetween('date', [$request->start, $request->end])->get();
//        }
        if($request->start !='' && $request->end !=''&& $request->accounthead == '' && $request->accountsubhead == '' ) {
            $incomes = TransactionLog::where('transaction_type', 1)
                ->whereBetween('date', [$request->start, $request->end])->get();
            $expenses = TransactionLog::whereIn('transaction_type', [3, 2])
                ->whereBetween('date', [$request->start, $request->end])->get();

        }elseif ($request->start !='' && $request->end !='' && $request->accounthead !='' && $request->accountsubhead ==''  ) {

            $incomes = TransactionLog::where('transaction_type', 1)
                ->where('account_head_type_id', $request->accounthead)
                ->whereBetween('date', [$request->start, $request->end])->get();
            $expenses = TransactionLog::whereIn('transaction_type', [3, 2])
                ->where('account_head_type_id', $request->accounthead)
                ->whereBetween('date', [$request->start, $request->end])->get();
        }elseif ($request->start !='' && $request->end !=''  && $request->accountsubhead !='' && $request->accounthead ==''  ) {

            $incomes = TransactionLog::where('transaction_type', 1)
                ->where('account_head_sub_type_id', $request->accountsubhead)
                ->whereBetween('date', [$request->start, $request->end])->get();
            $expenses = TransactionLog::whereIn('transaction_type', [3, 2])
                ->where('account_head_sub_type_id', $request->accountsubhead)
                ->whereBetween('date', [$request->start, $request->end])->get();
        }
        elseif ($request->start !='' && $request->end !='' && $request->accounthead !='' && $request->accountsubhead !=''  ) {

            $incomes = TransactionLog::where('transaction_type', 1)
                ->where('account_head_type_id', $request->accounthead)
                ->where('account_head_sub_type_id', $request->accountsubhead)
                ->whereBetween('date', [$request->start, $request->end])->get();
            $expenses = TransactionLog::whereIn('transaction_type', [3, 2])
                ->where('account_head_type_id', $request->accounthead)
                ->where('account_head_sub_type_id', $request->accountsubhead)
                ->whereBetween('date', [$request->start, $request->end])->get();
        }

        return view('report.ledger', compact('incomes', 'expenses'));
    }
    public function productSaleLog(Request $request) {

        if (Auth::user()->role == 1)
            $definePercent = 1;
        else
            $definePercent = .4;

        $products = [];
        if ($request->start != '' && $request->end != '') {

           $saleId = SalesOrder::whereBetween('date', [$request->start, $request->end])
                ->pluck('id')->toArray();

           $products = PurchaseProductSalesOrder::with('saleOrder')->WhereIn('sales_order_id',$saleId)->get();


        }

        return view('report.product_sale_logs',compact('products','definePercent'));
    }

    public function vat(Request $request)
    {
        if (Auth::user()->role == 1)
            $definePercent = 1;
        else
            $definePercent = .4;

        $vats = [];
        if ($request->start != '' && $request->end != '') {
            $vats = SalesOrder::whereBetween('date', [$request->start, $request->end])
                            ->get();
        }

            return view('report.vats',compact('vats','definePercent'));

    }

    public function transaction(Request $request) {
        $result = null;
        $types = AccountHeadType::whereNotIn('id', [1, 2, 3, 4,6,7])->get();
        $subTypes = AccountHeadSubType::whereNotIn('id', [1, 2, 3, 4,6,7])->get();

        if ($request->start && $request->end) {
            $query = TransactionLog::query();
            $query->select(DB::raw('sum(amount) as amount, account_head_type_id, account_head_sub_type_id'));
            $query->whereBetween('date', [$request->start, $request->end]);
            $query->whereNotIn('account_head_type_id', [0, 1, 2, 3, 4,6,7]);
            $query->whereNotIn('account_head_sub_type_id', [0, 1, 2, 3, 4,6,7]);

            if ($request->type && $request->type != '')
                $query->where('account_head_type_id', $request->type);

            if ($request->sub_type && $request->sub_type != '')
                $query->where('account_head_sub_type_id', $request->sub_type);

            $query->groupBy('account_head_sub_type_id', 'account_head_type_id');
            $query->with('accountHead');

            $result = $query->get();
        }

        return view('report.transaction', compact('result', 'types',
            'subTypes'));
    }
    public function receiveAndPayment(Request $request){
        if (Auth::user()->role == 1)
            $definePercent = 1;
        else
            $definePercent = .4;

        $incomes = null;
        $expenses = null;
        $totalWorkPurpose = null;
        $totalInWorkPurpose = null;
        $totalVat = null;
        $incomeQuery = TransactionLog::query();
        $expenseQuery = TransactionLog::query();

        $incomeQuery->where('transaction_type', 1);
        $expenseQuery->where('transaction_type', 2);
        $incomeQuery->select(DB::raw('sum(amount) as amount, account_head_type_id'));
        $expenseQuery->select(DB::raw('sum(amount) as amount, account_head_type_id'));
        $incomeQuery->where('account_head_type_id','!=', 0);
        $expenseQuery->where('account_head_type_id','!=', 0);

        if ($request->account_head_type != '') {
            $incomeQuery->where('account_head_type_id', $request->account_head_type);
            $expenseQuery->where('account_head_type_id', $request->account_head_type);
        }

        if ($request->start != '' && $request->end != '') {
            $incomeQuery->where('date', '>=', $request->start);
            $expenseQuery->where('date', '>=', $request->start);
            $incomeQuery->where('date', '<=', $request->end);
            $expenseQuery->where('date', '<=', $request->end);

            $totalInWorkPurpose = SalesOrder::where('date', '>=', $request->start)
                        ->where('date', '<=', $request->end)
                        ->sum('work_purpose');
            $totalVat = SalesOrder::where('date', '>=', $request->start)
                ->where('date', '<=', $request->end)
                ->sum('vat');
        }


        if ($request->start == '' && $request->end == '') {
           $totalInWorkPurpose = SalesOrder::sum('work_purpose');
           $totalVat = SalesOrder::sum('vat');
        }

        $totalWorkPurpose = $totalInWorkPurpose + $totalVat;


        $incomeQuery->groupBy('account_head_type_id');
        $expenseQuery->groupBy('account_head_type_id');

        $incomes = $incomeQuery->get();
        $expenses = $expenseQuery->get();

        return view('report.receive_and_payment',compact('incomes','expenses','totalWorkPurpose','definePercent'));
    }
    public function stockReport(Request $request){

        return view('report.stock_report');
    }
    public function bankStatement (Request $request){
        $banks = Bank::where('status', 1)->orderBy('name')->get();
        $result = null;
        $metaData = null;

        if ($request->bank && $request->branch && $request->account && $request->start && $request->end) {
            $bankAccount = BankAccount::where('id', $request->account)->first();
            $bank = Bank::where('id', $request->bank)->first();
            $branch = Branch::where('id', $request->branch)->first();

            $metaData = [
                'name' => $bank->name,
                'branch' => $branch->name,
                'account' => $bankAccount->account_no,
                'start_date' => $request->start,
                'end_date' => $request->end,
            ];

            $result = collect();

            $initialBalance = $bankAccount->opening_balance;
            $previousDay = date('Y-m-d', strtotime('-1 day', strtotime($request->start)));

            $totalIncome = TransactionLog::where('transaction_type', 1)
                ->where('bank_account_id', $request->account)
                ->whereDate('date', '<=', $previousDay)
                ->sum('amount');

            $totalExpense = TransactionLog::where('transaction_type', 2)
                ->where('bank_account_id', $request->account)
                ->whereDate('date', '<=', $previousDay)
                ->sum('amount');

            $openingBalance = $initialBalance + $totalIncome - $totalExpense;

            $result->push(['date' => $request->start_date, 'particular' => 'Opening Balance', 'debit' => '', 'credit' => '', 'balance' => $openingBalance]);

            $transactionLogs = TransactionLog::where('bank_account_id', $request->account)
                ->whereBetween('date', [$request->start, $request->end])
                ->get();

            $balance = $openingBalance;
            $totalDebit = 0;
            $totalCredit = 0;
            foreach ($transactionLogs as $log) {
                if ($log->transaction_type == 1) {
                    // Income
                    $balance += $log->amount;
                    $totalDebit += $log->amount;
                    $result->push(['date' => $log->date, 'particular' => $log->particular, 'debit' => $log->amount, 'credit' => '', 'balance' => $balance]);
                } else {
                    $balance -= $log->amount;
                    $totalCredit += $log->amount;
                    $result->push(['date' => $log->date, 'particular' => $log->particular, 'debit' => '', 'credit' => $log->amount, 'balance' => $balance]);
                }
            }

            $metaData['total_debit'] = $totalDebit;
            $metaData['total_credit'] = $totalCredit;

        }
        return view('admin.report.bank_statement', compact('banks', 'result', 'metaData'));
    }

    public function employeeAttendance(Request $request)
    {

        $attendances = [];

        $employee=Employee::pluck('id');

        if ($request->category=='' && $request->start!='' && $request->end!='') {
            $attendances=EmployeeAttendance::whereIn('employee_id',$employee)->whereDate('date','>=',$request->start)->whereDate('date','<=', $request->end)->get();

        }


        return view('report.employee_attendance',compact('attendances'));
    }
    public function salarySheet(Request $request){


        $salaries = [];
        $working_days = '';

        if ($request->month !='' && $request->year!='') {

            $working_days=cal_days_in_month(CAL_GREGORIAN,$request->month,$request->year);

            $salaries=Salary::with('employee')->where('year',$request->year)->where('month',$request->month)->get();

            foreach ($salaries as $salary) {
                $absent = EmployeeAttendance::select(\Illuminate\Support\Facades\DB::raw('count(*) as absent_count'))
                    ->where('employee_id', $salary->employee_id)
                    ->whereYear('date', $request->year)
                    ->whereMonth('date',$request->month)
                    ->where('present_or_absent',0)
                    ->first();
                $late = EmployeeAttendance::select(DB::raw('count(*) as late_count'))
                    ->where('employee_id', $salary->employee_id)
                    ->whereYear('date', $request->year)
                    ->whereMonth('date',$request->month)
                    ->where('late',1)
                    ->first();

                $late2=(int)($late->late_count/3);

                $salary->absent = $absent->absent_count;
                $salary->late = $late2;
            }

            //dd($salaries);
        }

        $salaryDates = SalaryProcess::select('year')->distinct()->get();


        return view('report.salary_sheet',compact('salaries','working_days','salaryDates'));
    }

    public function employeeList(Request $request)
    {

         $employees=Employee::with('designation','department')->get();

        return view('report.employee_list',compact('employees'));
    }


}
