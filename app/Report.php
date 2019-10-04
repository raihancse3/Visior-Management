<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Report extends Model
{
	public function getSalesReportData($from, $to,$customer_id){

		$from = date("Y-m-d", strtotime($from));
		$to = date("Y-m-d", strtotime($to));

        $where ="invoices.is_deleted = 0 AND invoices.date BETWEEN '$from' AND '$to'";
          
          if($customer_id){
            $where .= " AND invoices.customer_id = '$customer_id' ";   
          }

		$data = DB::select("SELECT invoice_info.date,SUM(invoice_info.qty) as quanty,SUM(invoice_info.sale) as sales, SUM(invoice_info.purchase) as cost FROM(SELECT invoices.*,invoice_details.* FROM invoices
			LEFT JOIN (SELECT invoice_id,SUM(quantity) as qty,SUM(sale_price)as sale,SUM(purchase_price) as purchase  FROM(SELECT invoice_details.invoice_id,invoice_details.item_id,invoice_details.quantity,(invoice_details.subtotal-(invoice_details.tax_percent*invoice_details.subtotal)/100) as sale_price,purchase.rate as purchase_rate,(purchase.rate*invoice_details.quantity)as purchase_price  
			FROM invoice_details
			LEFT JOIN(SELECT item_id,(SUM(subtotal)/SUM(quantity)) as rate FROM `purchase_order_details` GROUP BY item_id)purchase
			ON purchase.item_id= invoice_details.item_id)detail
			GROUP BY invoice_id)invoice_details
			ON invoice_details.invoice_id = invoices.id
			WHERE $where )invoice_info
			GROUP BY invoice_info.date
			ORDER BY invoice_info.date DESC
			");

		return $data;
	}

	public function getPurchaseReportData($from,$to,$supplier_id,$warehouse_id){
		
		$from = date("Y-m-d", strtotime($from));
		$to = date("Y-m-d", strtotime($to));

        $where ="po.date BETWEEN '$from' AND '$to'";
          
          if($supplier_id){
            $where .= " AND po.supplier_id = '$supplier_id' ";   
          }

         if($warehouse_id){
            $where .= " AND po.warehouse_id = '$warehouse_id' ";   
          }

		$data = DB::select("SELECT po.date,po.reference,po.total,warehouses.name as location,suppliers.name as supplier,pod.quantity FROM purchase_orders as po
			LEFT JOIN warehouses
			ON warehouses.id = po.warehouse_id
			LEFT JOIN suppliers
			ON suppliers.id = po.supplier_id
			LEFT JOIN(SELECT purchase_order_id,SUM(quantity) as quantity FROM `purchase_order_details` GROUP BY purchase_order_id)pod
			ON pod.purchase_order_id = po.id
			WHERE $where
			ORDER BY po.date DESC
			");

		return $data;
	}

	public function getIncomeReportData($from, $to){
		
		$from = date("Y-m-d", strtotime($from));
		$to = date("Y-m-d", strtotime($to));

		$data = DB::select("SELECT bt.amount,bt.date,bt.reference,bt.description,iec.name as category,ba.account_name,ba.account_no,pm.name as method FROM transactions as bt
			LEFT JOIN income_categories as iec
			ON iec.id = bt.category_id
			LEFT JOIN accounts as ba
			ON ba.id = bt.account_id
			LEFT JOIN payment_methods as pm
			ON pm.id = bt.payment_method_id
			WHERE bt.type IN ('deposit','sale-income') AND bt.date BETWEEN '$from' AND '$to'");
		return $data;
	}

	public function getExpenseReportData($from, $to){
		
		$from = date("Y-m-d", strtotime($from));
		$to = date("Y-m-d", strtotime($to));

		$data = DB::select("SELECT bt.amount,bt.date,bt.reference,bt.description,iec.name as category,ba.account_name,ba.account_no,pm.name as method FROM transactions as bt
			LEFT JOIN expense_categories as iec
			ON iec.id = bt.category_id
			LEFT JOIN accounts as ba
			ON ba.id = bt.account_id
			LEFT JOIN payment_methods as pm
			ON pm.id = bt.payment_method_id
			WHERE bt.type IN ('expense') AND bt.date BETWEEN '$from' AND '$to'");
		return $data;
	}

	public function getTotalIncomeExpense(){
		$data = [];
		// Total
		$incomeInfo = DB::select("SELECT SUM(amount) as total FROM transactions WHERE type IN ('deposit','sale-income') ");

		$expenseInfo = DB::select("SELECT SUM(amount) as total FROM transactions WHERE type IN ('expense') ");

		
		$data['totalIncome'] = abs(isset($incomeInfo[0]->total) ? $incomeInfo[0]->total : 0);
		$data['totalExpense'] = abs(isset($expenseInfo[0]->total) ? $expenseInfo[0]->total : 0); 
		//Current Year
		$incomeInfoYear = DB::select("SELECT SUM(amount) as total FROM transactions WHERE type IN ('deposit','sale-income') AND YEAR(date) = YEAR(CURDATE())");

		$expenseInfoYear = DB::select("SELECT SUM(amount) as total FROM transactions WHERE type IN ('expense') AND YEAR(date) = YEAR(CURDATE())");
		
		$data['totalIncomeYear'] = abs(isset($incomeInfoYear[0]->total) ? $incomeInfoYear[0]->total : 0);
		$data['totalExpenseYear'] = abs(isset($expenseInfoYear[0]->total) ? $expenseInfoYear[0]->total : 0); 
		
		//Current Month
		$incomeInfoMonth = DB::select("SELECT SUM(amount) as total FROM transactions WHERE type IN ('deposit','sale-income') AND MONTH(date) = MONTH(CURDATE())");

		$expenseInfoMonth = DB::select("SELECT SUM(amount) as total FROM transactions WHERE type IN ('expense') AND MONTH(date) = MONTH(CURDATE())");
		
		$data['totalIncomeMonth'] = abs(isset($incomeInfoMonth[0]->total) ? $incomeInfoMonth[0]->total : 0);
		$data['totalExpenseMonth'] = abs(isset($expenseInfoMonth[0]->total) ? $expenseInfoMonth[0]->total : 0); 
		//Current Week
		$incomeInfoWeek = DB::select("SELECT SUM(amount) as total FROM transactions WHERE type IN ('deposit','sale-income') AND WEEK(date) = WEEK(CURDATE())");

		$expenseInfoWeek = DB::select("SELECT SUM(amount) as total FROM transactions WHERE type IN ('expense') AND WEEK(date) = WEEK(CURDATE())");
		
		$data['totalIncomeWeek'] = abs(isset($incomeInfoWeek[0]->total) ? $incomeInfoWeek[0]->total : 0);

		$data['totalExpenseWeek'] = abs(isset($expenseInfoWeek[0]->total) ? $expenseInfoWeek[0]->total : 0); 

		
		return $data;
	}

	public function getinventoryReportData(){

		$data = DB::select("SELECT items.*,stock.qty FROM items LEFT JOIN (SELECT item_id,SUM(qty) as qty FROM inventory_transactions GROUP BY item_id)stock ON stock.item_id = items.id WHERE items.deleted_status = 0 ");
		return $data;
	}


}
