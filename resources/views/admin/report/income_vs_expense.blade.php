@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">{{ trans('message.menu.income_vs_expense') }}</div>
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
            <th class="text-center">{{ trans('message.list.duration') }}</th>
            <th class="text-center">{{ trans('message.list.income') }}({{Session::get('currency_symbol')}})</th>
            <th class="text-center">{{ trans('message.list.expense') }}({{Session::get('currency_symbol')}})</th>
            <th class="text-center">{{ trans('message.list.profit') }}({{Session::get('currency_symbol')}})</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">{{ trans('message.list.current_week') }}</td>
            <td class="text-center">{{$totalIncomeExpense['totalIncomeWeek']}}</td>
            <td class="text-center">{{$totalIncomeExpense['totalExpenseWeek']}}</td>
            <td class="text-center">{{ $totalIncomeExpense['totalIncomeWeek'] -  $totalIncomeExpense['totalExpenseWeek'] }}</td>
          </tr>
          <tr>
            <td class="text-center">{{ trans('message.list.current_month') }}</td>
            <td class="text-center">{{$totalIncomeExpense['totalIncomeMonth']}}</td>
            <td class="text-center">{{$totalIncomeExpense['totalExpenseMonth']}}</td>
            <td class="text-center">{{ $totalIncomeExpense['totalIncomeMonth'] -  $totalIncomeExpense['totalExpenseMonth'] }}</td>
          </tr>
          <tr>
            <td class="text-center">{{ trans('message.list.current_year') }}</td>
            <td class="text-center">{{$totalIncomeExpense['totalIncomeYear']}}</td>
            <td class="text-center">{{$totalIncomeExpense['totalExpenseYear']}}</td>
            <td class="text-center">{{ $totalIncomeExpense['totalIncomeYear'] -  $totalIncomeExpense['totalExpenseYear'] }}</td>
          </tr>
          <tr>
          </tbody>
          <tfoot>
          <tr class="bg-success">
            <th class="text-center">{{ trans('message.list.total') }}</th>
            <th class="text-center">{{number_format($totalIncomeExpense['totalIncome'],2,'.',',')}}</th>
            <th class="text-center">{{number_format($totalIncomeExpense['totalExpense'],2,'.',',')}}</th>
            <th class="text-center">{{number_format(($totalIncomeExpense['totalIncome'] -  $totalIncomeExpense['totalExpense']),2,'.',',') }}</th>
          </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  @endsection
  @section('js')
  <script type="text/javascript">
  
  </script>
  @endsection