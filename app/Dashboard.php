<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\InventoryTransaction;
use App\Transaction;
use App\Item;
use App\InvoiceDetail;

class Dashboard extends Model
{

    public function getCurrentMonthQtySale()
    { 
          $total = 0;
          $data = DB::select("SELECT SUM(detail.qty) as total FROM `invoices`
                  LEFT JOIN (SELECT `invoice_id`,SUM(quantity) as qty FROM `invoice_details` GROUP BY `invoice_id` ) as detail
                  ON detail.invoice_id = invoices.id
                  WHERE MONTH(invoices.date) = MONTH(CURDATE())");
         

          if(isset($data[0]->total)){
            $total = $data[0]->total;
          }

          return $total;
    }

    public function getCurrentMonthRevenue()
    { 
          $total = 0;
          $data = DB::select("SELECT SUM(price_tbl.total_price) as total_value FROM `invoices` LEFT JOIN(SELECT invoice_id,SUM(total) as total_price FROM(SELECT `invoice_id`,`item_id`,`subtotal`,(`tax_percent`*`subtotal`)/100 as tax,(subtotal-(`tax_percent`*`subtotal`)/100) as total FROM `invoice_details`)as details
          GROUP BY invoice_id) as price_tbl
          ON price_tbl.invoice_id = invoices.id
          WHERE MONTH(invoices.`date`) = MONTH(CURDATE())");
         
          //d($data,1);
          if(isset($data[0]->total_value)){
            $total = $data[0]->total_value;
          }

          return $total;
    }

    public function getStockValue(){
      $totalSale = 0;
      $totalPurchase = 0;
      $sale = DB::select("SELECT SUM((subtotal-(`tax_percent`*`subtotal`)/100)) as total FROM `invoice_details`");
      $purchase = DB::select("SELECT SUM(total) as total FROM `purchase_orders`");

      if(isset($sale[0]->total)){
            $totalSale = $sale[0]->total;
          }

      if(isset($purchase[0]->total)){
            $totalPurchase = $purchase[0]->total;
          }

          return ($totalPurchase-$totalSale);

    }

    public function getStockProfitValue(){
      $total = 0;
          $data = DB::select("SELECT SUM(details.profit) as total FROM `invoices` LEFT JOIN(SELECT invoice_id,SUM(profit) as profit FROM(SELECT invoice_details.invoice_id,((invoice_details.subtotal-(invoice_details.tax_percent*invoice_details.subtotal)/100)-(invoice_details.quantity*purchase.rate)) as profit FROM invoice_details LEFT JOIN(SELECT item_id,(SUM(subtotal)/SUM(quantity)) as rate FROM `purchase_order_details` GROUP BY item_id)purchase ON purchase.item_id= invoice_details.item_id)profit GROUP BY invoice_id)as details
          ON details.invoice_id = invoices.id
          WHERE MONTH(invoices.`date`) = MONTH(CURDATE())
          "); 
         
        if(isset($data[0]->total)){
            $total = $data[0]->total;
          }

          return $total;
    }

    public function expenseCategory(){
        // $data = DB::select("SELECT category_id, name, SUM(ABS(amount)) as amount FROM transactions
        //   LEFT JOIN expense_categories
        //   ON expense_categories.id = transactions.category_id
        //   WHERE transactions.type = 'expense'
        //   GROUP BY transactions.category_id
        //   ORDER BY transactions.amount DESC
        //   ");
      $data = Transaction::select('category_id', DB::raw('SUM(amount) as amount'))
                                               ->groupBy('category_id')
                                               ->where('type','expense')
                                               ->orderBy('amount','desc')
                                               ->get();

        return $data;
    }

    public function lastThirtyDaysIncomes(){
      $getLastOneMonthDates = getLastOneMonthDates();
      $final = [];
      $data_map = array();
      $today = date('Y-m-d');
      $previousDate = date("Y-m-d", strtotime ("-30 day",strtotime(date('d-m-Y') )));
      
      $data = DB::select("SELECT SUM(amount) as amount,date,MONTH(date) as month,DAY(date) as day FROM transactions WHERE date BETWEEN '$previousDate' AND '$today' AND type IN ('deposit','cash-in-by-sale') GROUP BY date");

      if(!empty($data)){
        foreach ($data as $key => $value) {
         $data_map[$value->day][$value->month] = abs($value->amount);
        }

        $dataArray = [];
        $i = 0;
        foreach ($getLastOneMonthDates as $key => $value) {
          $date = explode('-', $value);
          $td = (int) $date[0];
          $tm = (int) $date[1];
          $dataArray[$i]['day'] =  $date[0];
          $dataArray[$i]['month'] =  $date[1];
          if(isset($data_map[$td][$tm])) {
            $dataArray[$i]['amount'] =  abs($data_map[$td][$tm]);
          }else{
            $dataArray[$i]['amount'] =  0;
         }
          $i++;
        }

        
        foreach($dataArray as $key=>$res){
          $final[$key] = abs($res['amount']);
        }

      }
      return $final;
    }
    public function lastThirtyDaysExpenses(){
      $getLastOneMonthDates = getLastOneMonthDates();
       $final = [];
      $data_map = array();
      $today = date('Y-m-d');
      $previousDate = date("Y-m-d", strtotime ("-30 day",strtotime(date('d-m-Y') )));
      
      $data = DB::select("SELECT SUM(amount) as amount,date,MONTH(date) as month,DAY(date) as day FROM transactions WHERE date BETWEEN '$previousDate' AND '$today' AND type IN ('expense') GROUP BY date");

      if(!empty($data)){
        foreach ($data as $key => $value) {
         $data_map[$value->day][$value->month] = abs($value->amount);
        }

        $dataArray = [];
        $i = 0;
        foreach ($getLastOneMonthDates as $key => $value) {
          $date = explode('-', $value);
          $td = (int) $date[0];
          $tm = (int) $date[1];
          $dataArray[$i]['day'] =  $date[0];
          $dataArray[$i]['month'] =  $date[1];
          if(isset($data_map[$td][$tm])) {
            $dataArray[$i]['amount'] =  $data_map[$td][$tm];
          }else{
            $dataArray[$i]['amount'] =  0;
         }
          $i++;
        }

       
        foreach($dataArray as $key=>$res){
          $final[$key] = $res['amount'];
        }

      }
      return $final;
    }
    
    public function getTotalDue(){
      $invoiced = DB::table('invoices')->where(['is_deleted'=>0])->sum('total');
      $paid     = DB::table('invoices')->where(['is_deleted'=>0])->sum('paid');
      if(!isset($invoiced)){
        $invoiced = 0;
      }

      return ($invoiced-$paid);

    }

    public function getFirstMovinItems(){
        $items = InvoiceDetail::select('item_id',DB::raw('SUM(quantity) as qty'))
                                               ->groupBy('item_id')
                                               ->orderBy('qty','desc')
                                               ->take(10)
                                               ->get(); 

      return $items;
    }

    public function getNotificationsItems(){
        $items = InventoryTransaction::select('item_id','warehouse_id', DB::raw('SUM(qty) as total'))
                                               ->groupBy('item_id','warehouse_id')
                                               ->havingRaw('sum(qty)<10')
                                               ->take(10)
                                               ->get();      
      return $items;
    }



}
