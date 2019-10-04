<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Account;
use App\Transaction;
use App\Deposit;
use App\ActivityLog;
use App\IncomeCategory;
use App\PaymentMethod;
use App\Report;
use Validator;
use DB;
use session;
use PDF;
use Excel;



class ReportController extends Controller

{

    public function __construct(Report $report){

        $this->report = $report;

    }



    public function salesReport()

    {

        $data['menu'] = 'report';

        $data['sub_menu'] = 'sales';

        $data['header'] = 'Sales Report';

        $sales = [];

        $cost = [];

        $profit = [];

        $date = [];



        $data['from'] = $from = date("d-m-Y", strtotime("-1 months"));

        $data['to'] = $to = date('d-m-Y');

        $data['customer_id'] = $customer_id = NULL;

        if(isset($_GET['from']) && isset($_GET['to'])){

            $data['from'] = $from = $_GET['from'];

            $data['to'] = $to = $_GET['to'];

        }

        if(isset($_GET['customer_id'])){

            $data['customer_id'] = $customer_id = $_GET['customer_id'];

        }





        $data['salesReportData'] = $dataList = $this->report->getSalesReportData($from,$to,$customer_id);



        foreach($dataList as $index=>$result){

            $sales[$index] = (int)$result->sales;

            $cost[$index] = (int)$result->cost;

            $profit[$index] = (int)($result->sales-$result->cost);

            $date[$index] = date('d-m-Y', strtotime($result->date));

        }

        $data['salesArray'] = json_encode($sales);

        $data['costArray'] = json_encode($cost);

        $data['profitArray'] = json_encode($profit);

        $data['dateArray'] = json_encode($date);

	//d($data,1);

        $data['customers'] = DB::table('customers')->where(['status'=>1])->get();

        return view('admin.report.sales_report', $data);

    }



    public function salesReportPdf()

    {

        $data['from'] = $from = $_GET['from'];

        $data['to'] = $to = $_GET['to'];

        $customer_id = $_GET['customer_id'];



        if(!empty($customer_id)){

        $customerInfo = DB::table('customers')->where(['customer_id'=>$customer_id])->first();

        $data['customer'] = $customerInfo->name;

        }else{

          $data['customer'] = 'All';  

        }

        $data['salesReportData'] = $this->report->getSalesReportData($from,$to,$customer_id);



        $pdf = PDF::loadView('admin.report.sales_report_pdf', $data);

        return $pdf->stream('Sales_Report.pdf'); 

    }

    public function salesReportCsv()

    {

        $from = $_GET['from'];

        $to = $_GET['to'];

        $customer_id = $_GET['customer_id'];

        $dataList = $this->report->getSalesReportData($from,$to,$customer_id);



        foreach ($dataList as $key => $value) {

            $data[$key]['date'] = date('d-m-Y',strtotime($value->date));

            $data[$key]['cost'] = number_format($value->cost,2,'.',',');

            $data[$key]['sales'] = number_format($value->sales,2,'.',',');

            $data[$key]['profit'] = number_format(($value->sales-$value->cost),2,'.',',');

        }



        return Excel::create('sales_report_'.time().'', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            }); 

        })->download();

    }





    public function purchaseReport()

    {

        $data['menu'] = 'report';

        $data['sub_menu'] = 'purchases';

        $data['header'] = 'Purchase Report';



        $data['from'] = $from = date("d-m-Y", strtotime("-1 months"));

        $data['to'] = $to = date('d-m-Y');

        $data['supplier_id'] = $supplier_id = NULL;

        $data['warehouse_id'] = $warehouse_id = NULL;

        

        if(isset($_GET['from']) && isset($_GET['to'])){

            $data['from'] = $from = $_GET['from'];

            $data['to'] = $to = $_GET['to'];

        }

        if(isset($_GET['supplier_id'])){

            $data['supplier_id'] = $supplier_id = $_GET['supplier_id'];

        }

        if(isset($_GET['warehouse_id'])){

            $data['warehouse_id'] = $warehouse_id = $_GET['warehouse_id'];

        }



        $data['purchaseReportData'] = $dataList = $this->report->getPurchaseReportData($from,$to,$supplier_id,$warehouse_id);

        //d($data['purchaseReportData'],1);

        $data['suppliers'] = DB::table('suppliers')->where(['is_deleted'=>0])->get();

        $data['warehouses'] = DB::table('warehouses')->where(['is_deleted'=>0])->get();

        

        return view('admin.report.purchases_report', $data);

    }

    public function purchaseReportPdf()

    {

        $data['from'] = $from = $_GET['from'];

        $data['to'] = $to = $_GET['to'];

        $supplier_id = $_GET['supplier_id'];

        $warehouse_id = $_GET['warehouse_id'];



        if(!empty($supplier_id)){

        $supplierInfo = DB::table('customers')->where(['supplier_id'=>$supplier_id])->first();

        $data['supplier'] = $supplierInfo->name;

        }else{

          $data['supplier'] = 'All';  

        }



        if(!empty($warehouse_id)){

        $locationInfo = DB::table('warehouse')->where(['id'=>$warehouse_id])->first();

        $data['warehouse'] = $locationInfo->name;

        }else{

          $data['warehouse'] = 'All';  

        }



        $data['purchaseReportData'] = $dataList = $this->report->getPurchaseReportData($from,$to,$supplier_id,$warehouse_id);



        $pdf = PDF::loadView('admin.report.purchases_report_pdf', $data);

        return $pdf->stream('Purchases_Report.pdf'); 

    }



    public function purchaseReportCsv()

    {

        $from = $_GET['from'];

        $to = $_GET['to'];

        $supplier_id = $_GET['supplier_id'];

        $warehouse_id = $_GET['warehouse_id'];



        $dataList = $this->report->getPurchaseReportData($from,$to,$supplier_id,$warehouse_id);



        foreach ($dataList as $key => $value) {

            $data[$key]['Date'] = date('d-m-Y',strtotime($value->date));

            $data[$key]['Reference'] = PURCHASE.$value->reference;

            $data[$key]['Warehouse'] = $value->location;

            $data[$key]['Quantity'] = $value->quantity;

            $data[$key]['Total'] = $value->total;

        }



        return Excel::create('purchases_report_'.time().'', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            }); 

        })->download();

    }



    public function incomeReport(){

        $data['menu'] = 'report';

        $data['sub_menu'] = 'income';

        $data['header'] = 'Income Report';

        $income = [];

        $date = [];

        $data['from'] = $from = date("d-m-Y", strtotime("-1 months"));

        $data['to'] = $to = date('d-m-Y');



        if(isset($_GET['from']) && isset($_GET['to'])){

            $data['from'] = $from = $_GET['from'];

            $data['to'] = $to = $_GET['to'];

        }  

        $data['incomeReportData'] = $dataList = $this->report->getIncomeReportData($from,$to);

//dd($dataList);

        foreach($dataList as $index=>$result){

            $income[$index] = (int)$result->amount;

            $date[$index] = date('d-m-Y', strtotime($result->date));

        }

        $data['incomeArray'] = json_encode($income);

        $data['dateArray'] = json_encode($date);



        return view('admin.report.income_report', $data);



    }



    public function incomeReportPdf()

    {

        $data['from'] = $from = $_GET['from'];

        $data['to'] = $to = $_GET['to'];

        $data['incomeReportData'] = $this->report->getIncomeReportData($from,$to);
        $pdf = PDF::loadView('admin.report.income_report_pdf', $data);
        return $pdf->stream('Income_Report.pdf'); 

    }



    public function incomeReportCsv()

    {

        $from = $_GET['from'];

        $to = $_GET['to'];

        $dataList = $this->report->getIncomeReportData($from,$to);



        foreach ($dataList as $key => $value) {

            $data[$key]['Date'] = date('d-m-Y',strtotime($value->trans_date));

            $data[$key]['Account Name'] = $value->account_name;

            $data[$key]['Account No'] = $value->account_no;

            $data[$key]['Reference'] = INVOICE.$value->reference;

            $data[$key]['Description'] = $value->description;

            $data[$key]['Category'] = $value->category;

            $data[$key]['Payment Method'] = $value->method;

            $data[$key]['Amount'] = $value->amount;

        }



        return Excel::create('Purchases_Report', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            }); 

        })->download();

    }



    public function expenseReport(){

        $data['menu'] = 'report';

        $data['sub_menu'] = 'expense';

        $data['header'] = 'Expense Report';

        $expense = [];

        $date = [];

        $data['from'] = $from = date("d-m-Y", strtotime("-1 months"));

        $data['to'] = $to = date('d-m-Y');



        if(isset($_GET['from']) && isset($_GET['to'])){

            $data['from'] = $from = $_GET['from'];

            $data['to'] = $to = $_GET['to'];

        }  

        $data['expenseReportData'] = $dataList = $this->report->getExpenseReportData($from,$to);



        foreach($dataList as $index=>$result){

            $expense[$index] = abs((int)$result->amount);

            $date[$index] = date('d-m-Y', strtotime($result->date));

        }

        $data['expenseArray'] = json_encode($expense);

        $data['dateArray'] = json_encode($date);



        return view('admin.report.expense_report', $data);



    }



    public function expenseReportPdf()

    {

        $data['from'] = $from = $_GET['from'];
        $data['to'] = $to = $_GET['to'];
        $data['expenseReportData'] = $this->report->getExpenseReportData($from,$to);
        $pdf = PDF::loadView('admin.report.expense_report_pdf', $data);
        return $pdf->stream('Expense_Report.pdf'); 

    }



    public function expenseReportCsv()

    {

        $from = $_GET['from'];

        $to = $_GET['to'];

        $dataList = $this->report->getExpenseReportData($from,$to);



        foreach ($dataList as $key => $value) {

            $data[$key]['Date'] = date('d-m-Y',strtotime($value->trans_date));

            $data[$key]['Account Name'] = $value->account_name;

            $data[$key]['Account No'] = $value->account_no;

            $data[$key]['Reference'] = $value->reference;

            $data[$key]['Description'] = $value->description;

            $data[$key]['Category'] = $value->category;

            $data[$key]['Payment Method'] = $value->method;

            $data[$key]['Amount'] = abs($value->amount);

        }



        return Excel::create('Expense_Report', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            }); 

        })->download();

    }



    public function incomeVSexpenseReport(){

        $data['menu'] = 'report';

        $data['sub_menu'] = 'income-vs-expense';  

        $data['header'] = 'Income VS Expense';

        $data['totalIncomeExpense'] = $this->report->getTotalIncomeExpense();

       // d($data,1);

        return view('admin.report.income_vs_expense', $data);

    }

    public function inventoryReport(){

        $data['menu'] = 'report';

        $data['sub_menu'] = 'inventory';

        $data['header'] = 'Inventory Report'; 

        $data['inventoryReportData'] = $this->report->getinventoryReportData();

        return view('admin.report.inventory_report', $data);



    }



    public function inventoryReportCsv()

    {

        $dataList = $this->report->getinventoryReportData();



        foreach ($dataList as $key => $value) {

            $data[$key]['Name'] = $value->name;

            $data[$key]['Inventory On Hand'] = $value->qty;

            $data[$key]['Cost Value'] = $value->qty*$value->purchase_price;

            $data[$key]['Sales value'] = $value->qty*$value->retail_price;

            $data[$key]['Profit Value'] = $value->qty*$value->retail_price - $value->qty*$value->purchase_price;

        }



        return Excel::create('Inventory_Report', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            }); 

        })->download();

    }



    public function inventoryReportPdf()

    {

        $data['inventoryReportData'] = $this->report->getinventoryReportData();
        $pdf = PDF::loadView('admin.report.inventory_report_pdf', $data);
        return $pdf->stream('Inventory_Report.pdf'); 

    }



}