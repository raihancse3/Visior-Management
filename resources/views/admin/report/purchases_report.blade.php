@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <form class="form-horizontal" action="{{ url('report/purchases-report') }}" method="GET">
        <div class="panel-body">
          <div class="col-md-3">
            <div class="form-group" style="margin-right: 5px;">
              <label for="exampleInputEmail1">{{ trans('message.form.from') }}</label>
              <input class="form-control" id="from" name="from" value="{{$from}}" type="text" required>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group" style="margin-right: 5px;">
              <label for="exampleInputEmail1">{{ trans('message.form.to') }}</label>
              <input class="form-control" id="to" name="to" value="{{$to}}" type="text" required>
            </div>
          </div>
          <div class="col-md-2">
            <!-- /.form-group -->
            <div class="form-group" style="margin-right: 5px;">
              <label class="control-label">{{ trans('message.list.supplier') }}</label>
              <select class="form-control select2" style="width: 100%;" name="supplier_id" id="supplier_id">
                <option value="">Select</option>
                @foreach($suppliers as $data)
                <option value="{{$data->id}}" <?= ($data->id==$supplier_id) ? 'selected' : '' ?>>{{$data->name}}</option>
                @endforeach
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          <div class="col-md-2">
            <!-- /.form-group -->
            <div class="form-group" style="margin-right: 5px;">
              <label class="control-label">{{ trans('message.menu.warehouse') }}</label>
              <select class="form-control select2" style="width: 100%;" name="warehouse_id" id="warehouse_id">
                <option value="">Select</option>
                @foreach($warehouses as $result)
                <option value="{{$result->id}}" <?= ($result->id==$warehouse_id) ? 'selected' : '' ?>>{{$result->name}}</option>
                @endforeach
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          
          <div class="col-md-1">
            <div class="form-group">
              <label for="exampleInputEmail1">&nbsp;</label>
              <div class="input-group">
                <button type="submit" name="btn" class="btn btn-info btn-sm">{{ trans('message.form.submit') }}</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Default box -->
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
          <table id="purchaseList" class="table table-bordered">
            <thead>
              <tr class="bg-success">
                <th width="10%" class="text-center">{{ trans('message.list.date') }}</th>
                <th class="text-center">{{ trans('message.list.reference') }}</th>
                <th class="text-center">{{ trans('message.menu.warehouse') }}</th>
                <th class="text-center">{{ trans('message.list.supplier') }}</th>
                <th class="text-center">{{ trans('message.list.quantity') }}</th>
                <th class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $qtyAmount = 0;
              $amount = 0;
              ?>
              @foreach($purchaseReportData as $data)
              <?php
              $amount +=$data->total;
              $qtyAmount +=$data->quantity;
              ?>
              <tr>
                <td class="text-center">{{ date('d-m-Y',strtotime($data->date)) }}</td>
                <td class="text-center">{{ PURCHASE.$data->reference }}</td>
                <td class="text-center">{{ $data->location }}</td>
                <td class="text-center">{{ $data->supplier }}</td>
                <td class="text-center">{{ $data->quantity }}</td>
                <td class="text-center">{{ number_format($data->total,2,'.',',') }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr class="bg-success">
              <th colspan="4" class="text-right">TOTAL</th>
              <th class="text-center">{{$qtyAmount}}</th>
              <th class="text-center">{{number_format($amount,2,'.',',')}}</th>
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

$('#from').datepicker({
autoclose: true,
todayHighlight: true,
format: 'dd-mm-yyyy'
});
$('#to').datepicker({
autoclose: true,
todayHighlight: true,
format: 'dd-mm-yyyy'
});
// Create pdf
$('#pdf').on('click', function(event){
event.preventDefault();
var from = $('#from').val();
var to = $('#to').val();
var supplier_id = $('#supplier_id').val();
var warehouse_id = $('#warehouse_id').val();
window.location = SITE_URL+"/report/purchases-report-pdf?from="+from+"&to="+to+"&supplier_id="+supplier_id+"&warehouse_id="+warehouse_id;
});
$('#csv').on('click', function(event){
event.preventDefault();
var from = $('#from').val();
var to = $('#to').val();
var supplier_id = $('#supplier_id').val();
var warehouse_id = $('#warehouse_id').val();
window.location = SITE_URL+"/report/purchases-report-csv?from="+from+"&to="+to+"&supplier_id="+supplier_id+"&warehouse_id="+warehouse_id;
});
</script>
@endsection