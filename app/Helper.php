<?php  

    function thirtyDaysNameList(){
        $data = array();
        for ($j = 30; $j > -1; $j--) {
            $data[30-$j] = date("d M", strtotime("-$j day"));
        }
        return $data;
    }

    function lastThirtyDaysProfit($income,$expense){
        $profit = [];
        for($i = 0; $i<=30;$i++){
            $incomeAmount = !empty($income[$i]) ? abs($income[$i]) : 0;
            $expenseAmount = !empty($expense[$i]) ? abs($expense[$i]) : 0;
            if($incomeAmount>0 && $incomeAmount>$expenseAmount){
                $profit[$i] = $incomeAmount-$expenseAmount;
            }else{
                $profit[$i] = 0;
            }
        }
        return $profit;
    }   
    
    function getLastOneMonthDates(){
        $data = array();
        for ($j = 30; $j > -1; $j--) {
            $data[30-$j] = date("d-m", strtotime(" -$j day"));
        }
        return $data;
    }     

function numberRound($amount){
    return number_format($amount,2,'.','');
}

function availableItemInOrder($item_id,$order_id){
    $data = DB::table('order_details')->where(['order_id'=>$order_id, 'item_id'=>$item_id])->first();
    return isset($data->available_quantity) ? $data->available_quantity : 0;
}

function getAvailableShipmentItem($item_id,$invoice_id){
    $data = DB::table('invoice_details')->where(['order_id'=>$invoice_id, 'item_id'=>$item_id])->first();
    return ($data->quantity-$data->shipted_qty);
}

function getShiptedItem($item_id,$invoice_id){
  //  d($stock_id);
  //  d($invoice_id,1);
    $data = DB::table('invoice_details')->where(['order_id'=>$invoice_id, 'item_id'=>$item_id])->first();
    return ($data->shipted_qty);
}

function getReferenceById($invoice_id){
    $data = DB::table('invoices')->where(['id'=>$invoice_id])->first();
    return ($data->reference);
}

function getCountry($id){
    $data = DB::table('countries')->where(['id'=>$id])->first();
    return $data->name;
}


function getwarehouse($id){
    $data = DB::table('warehouse')->where(['id'=>$id])->first();
    return $data->name;
}

function availableQuantityInStock($item_id,$warehouse_id){
    $qty = DB::table('inventory_transactions')->where(['warehouse_id'=>$warehouse_id, 'item_id'=>$item_id])->sum('qty');
   
    if(isset($qty) && $qty>0){
        $data = $qty;
    }else{
        $data = 0;
    }
    return $data;
}

function tasks(){
    $data = DB::table('tasks')->whereIn('status',['New','In Progress'])->orderBy('created_at','desc')->get();
   
    return $data;
}

function DbDateFormat($value){
    $value = date('Y-m-d',strtotime($value));
     return $value;
}

function formatDate($value){
      $value = date('d-m-Y',strtotime($value));
     return $value;  
}


function d($var,$a=false)
{
      echo "<pre>";
      print_r($var);
      echo "</pre>";
      if($a)exit;
}
