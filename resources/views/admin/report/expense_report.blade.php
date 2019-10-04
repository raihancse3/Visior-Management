@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <form class="form-horizontal" action="{{ url('report/expense-report') }}" method="GET">
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

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">{{ trans('message.menu.expense_report') }}</div>
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
                <th class="text-center">{{ trans('message.list.account_name') }}</th>
                <th class="text-center">{{ trans('message.list.account_no') }}</th>
                <th class="text-center">{{ trans('message.list.reference') }}</th>
                <th class="text-center">{{ trans('message.list.description') }}</th>
                <th class="text-center">{{ trans('message.list.category') }}</th>
                <th class="text-center">{{ trans('message.list.payment_method') }}</th>
                <th width="10%" class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              ?>
              @foreach($expenseReportData as $data)
              <?php
              $total +=$data->amount;
              ?>
              <tr>
                <td class="text-center">{{ date('d-m-Y',strtotime($data->date)) }}</td>
                <td class="text-center">{{ $data->account_name }}</td>
                <td class="text-center">{{ $data->account_no }}</td>
                <td class="text-center">{{ $data->reference }}</td>
                <td class="text-center">{{ $data->description }}</td>
                <td class="text-center">{{ $data->category }}</td>
                <td class="text-center">{{ $data->method }}</td>
                <td class="text-center">{{ number_format(abs($data->amount),2,'.',',') }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr class="bg-success">
              <th class="text-right" colspan="7">{{ trans('message.list.total') }}</th>
              <th class="text-center">{{number_format(abs($total),2,'.',',')}} </th>
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
$(function () {
'use strict';
var areaChartData = {
labels: jQuery.parseJSON('{!! $dateArray !!}'),
datasets: [
{
label: "Sales",
fillColor: "rgba(66,155,206, 1)",
strokeColor: "rgba(66,155,206, 1)",
pointColor: "rgba(66,155,206, 1)",
pointStrokeColor: "#429BCE",
pointHighlightFill: "#fff",
pointHighlightStroke: "rgba(66,155,206, 1)",
data: {{$expenseArray}}
}
]
};
var areaChartOptions = {
//Boolean - If we should show the scale at all
showScale: true,
//Boolean - Whether grid lines are shown across the chart
scaleShowGridLines: false,
//String - Colour of the grid lines
scaleGridLineColor: "rgba(0,0,0,.05)",
//Number - Width of the grid lines
scaleGridLineWidth: 1,
//Boolean - Whether to show horizontal lines (except X axis)
scaleShowHorizontalLines: true,
//Boolean - Whether to show vertical lines (except Y axis)
scaleShowVerticalLines: true,
//Boolean - Whether the line is curved between points
bezierCurve: true,
//Number - Tension of the bezier curve between points
bezierCurveTension: 0.3,
//Boolean - Whether to show a dot for each point
pointDot: false,
//Number - Radius of each point dot in pixels
pointDotRadius: 4,
//Number - Pixel width of point dot stroke
pointDotStrokeWidth: 1,
//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
pointHitDetectionRadius: 20,
//Boolean - Whether to show a stroke for datasets
datasetStroke: true,
//Number - Pixel width of dataset stroke
datasetStrokeWidth: 2,
//Boolean - Whether to fill the dataset with a color
datasetFill: true,
//String - A legend template
legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
maintainAspectRatio: true,
//Boolean - whether to make the chart responsive to window resizing
responsive: true
};
//-------------
//- LINE CHART -
//--------------
var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
var lineChart = new Chart(lineChartCanvas);
var lineChartOptions = areaChartOptions;
lineChartOptions.datasetFill = false;
lineChart.Line(areaChartData, lineChartOptions);
});
// Create pdf
$('#pdf').on('click', function(event){
event.preventDefault();
var from = $('#from').val();
var to = $('#to').val();
window.location = SITE_URL+"/report/expense-report-pdf?from="+from+"&to="+to;
});
$('#csv').on('click', function(event){
event.preventDefault();
var from = $('#from').val();
var to = $('#to').val();
window.location = SITE_URL+"/report/expense-report-csv?from="+from+"&to="+to;
});
</script>
@endsection