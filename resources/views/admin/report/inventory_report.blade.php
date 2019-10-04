@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <?php
      $qty = 0;
      $sales = 0;
      $purchase = 0;
      foreach($inventoryReportData as $info)
      {
      $qty += $info->qty;
      $sales += ($info->qty*$info->retail_price);
      $purchase += ($info->qty*$info->purchase_price);
      }
      ?>
      <div class="panel-body">
        <div class="col-md-3 col-xs-6 border-right text-center">
          <h3 class="bold">{{$qty}}</h3>
          <span class="text-info">{{ trans('message.list.total_inventory_on_hand') }}</span>
        </div>
        <div class="col-md-3 col-xs-6 border-right text-center">
          <h3 class="bold">{{Session::get('currency_symbol')}} {{number_format($purchase, 2, '.', '')}}</h3>
          <span class="text-info">{{ trans('message.list.cost_value_of_inventory_on_hand') }}</span>
        </div>
        <div class="col-md-3 col-xs-6 border-right text-center">
          <h3 class="bold">{{Session::get('currency_symbol')}} {{number_format($sales, 2, '.', '')}}</h3>
          <span class="text-info">{{ trans('message.list.sales_value_of_inventory_on_hand') }} </span>
        </div>
        <div class="col-md-3 col-xs-6 text-center">
          <h3 class="bold">
          {{Session::get('currency_symbol')}} {{number_format($sales-$purchase, 2, '.', '')}}  </h3>
          <span class="text-info">{{ trans('message.list.profit_value_of_inventory_on_hand') }}</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">{{ trans('message.menu.inventory_report') }}</div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
      </div>

      <div class="panel-body">
        <div class="table-responsive">
          <table id="purchaseList" class="table table-bordered table-striped">
            <thead>
              <tr class="bg-success">
                <th class="text-center">{{ trans('message.list.name') }}</th>
                <th class="text-center">{{ trans('message.list.invntory_on_hand') }}</th>
                <th class="text-center">{{ trans('message.list.cost_value') }}({{Session::get('currency_symbol')}})</th>
                <th class="text-center">{{ trans('message.list.sales_value') }}({{Session::get('currency_symbol')}})</th>
                <th class="text-center">{{ trans('message.list.profit_value') }}({{Session::get('currency_symbol')}})</th>
              </tr>
            </thead>
            <tbody>
              @foreach($inventoryReportData as $data)
              <tr>
                <td class="text-center">{{ $data->name }}</td>
                <td class="text-center">{{ $data->qty }}</td>
                <td class="text-center">{{ $data->qty*$data->purchase_price }}</td>
                <td class="text-center">{{ $data->qty*$data->retail_price }}</td>
                <td class="text-center">{{ number_format((($data->qty*$data->retail_price)-($data->qty*$data->purchase_price)),2,'.',',') }}</td>
              </tr>
              @endforeach
            </tbody>

            <tfoot>
              <tr class="bg-success">
                <th class="text-center">{{ trans('message.list.name') }}</th>
                <th class="text-center">{{ trans('message.list.invntory_on_hand') }}</th>
                <th class="text-center">{{ trans('message.list.cost_value') }}({{Session::get('currency_symbol')}})</th>
                <th class="text-center">{{ trans('message.list.sales_value') }}({{Session::get('currency_symbol')}})</th>
                <th class="text-center">{{ trans('message.list.profit_value') }}({{Session::get('currency_symbol')}})</th>
              </tr>
            </tfoot>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
var $purchaseList = jQuery( "#purchaseList" );
$purchaseList.DataTable( {
dom: 'Bfrtip',
buttons: [
'copyHtml5',
'excelHtml5',
'csvHtml5',
'pdfHtml5'
]
} );
} );

</script>
@endsection