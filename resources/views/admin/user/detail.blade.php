@extends('layouts.app_admin')
@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">Details Information Of {{$user->name}}</div>
                <div class="panel-options">                           
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>
            <div class="panel-body">   

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    
    <li role="presentation" class="active"><a href="#Orders" aria-controls="Orders" role="tab" data-toggle="tab">{{ trans('message.list.orders') }}</a></li>
    <li role="presentation"><a href="#Invoices" aria-controls="Invoices" role="tab" data-toggle="tab">{{ trans('message.list.invoices') }}</a></li>
    <li role="presentation"><a href="#Payments" aria-controls="Payments" role="tab" data-toggle="tab">{{ trans('message.list.payments') }}</a></li>
    <li role="presentation"><a href="#Purchases" aria-controls="Purchases" role="tab" data-toggle="tab">{{ trans('message.list.purchases') }}</a></li>
    <li role="presentation"><a href="#Income" aria-controls="Income" role="tab" data-toggle="tab">{{ trans('message.list.income') }}</a></li>
    <li role="presentation"><a href="#Expenses" aria-controls="Expenses" role="tab" data-toggle="tab">{{ trans('message.list.expenses') }}</a></li>    

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="Orders">
      <h3>{{ trans('message.list.orders') }}</h3>
              <div class="table-responsive">
              <table id="orderList" class="table table-bordered text-center">
                  <thead>
                  <tr>
                    <th class="text-center">{{ trans('message.list.reference') }}</th>
                    <th class="text-center">{{ trans('message.list.customer_name') }}</th>
                    <th class="text-center">{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($user->orders as $data)
                  <tr>
                    <td class="text-center"><a  title="View" href='{{ url("order/view/$data->id") }}'>{{ ORDER.$data->reference }}</a></td>
                    <td class="text-center">{{ $data->customer->name }}</td>
                    <td class="text-center">{{ number_format($data->total,2,'.',',') }}</td>
                    <td class="text-center">{{ formatDate($data->date)}}</td>
                  </tr>
                 @endforeach
                <tfoot>
                    <tr>
                      <th class="text-center">{{ trans('message.list.reference') }}</th>
                      <th class="text-center">{{ trans('message.list.customer_name') }}</th>
                      <th class="text-center">{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                      <th class="text-center">{{ trans('message.list.date') }}</th>
                    </tr>  
                </tfoot>

                  </tbody>
              </table>
          </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="Invoices">
            <h3>{{ trans('message.list.invoices') }}</h3>
                <div class="table-responsive">
              <table id="invoiceList" class="table table-bordered text-center">
                  <thead>
                  <tr>
                    <th class="text-center" width="25%">{{trans('message.list.reference') }}</th>
                    <th class="text-center">{{ trans('message.list.customer_name') }}</th>
                    <th class="text-center">{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($user->invoices as $data)
                                    <tr>
                    <td class="text-center"><a  title="View" href='{{ url("invoice/view/$data->id") }}'>{{ INVOICE.$data->reference }}</a></td>
                    <td class="text-center">{{ $data->customer->name }}</td>
                    
                    <td class="text-center">{{ number_format($data->total,2,'.',',') }}</td>
                    
                    <td class="text-center">{{ formatDate($data->date)}}</td>
                  </tr>
                @endforeach

                <tfoot>
                  <tr>
                    <th class="text-center">{{trans('message.list.reference') }}</th>
                    <th class="text-center">{{ trans('message.list.customer_name') }}</th>
                    <th class="text-center">{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                  </tr>                  
                </tfoot>

                </tbody>
              </table>
    </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="Payments">
            <h3>{{ trans('message.list.payments') }}</h3>
                <div class="table-responsive">
              <table id="paymentList" class="table table-bordered text-center">
                  <thead>
                  <tr>
                    <th class="text-center" width="25%">{{ trans('message.list.reference') }}</th>
                    <th class="text-center">{{ trans('message.list.customer_name') }}</th>
                    <th class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($user->payment_history as $data)
                  <tr>
                    <td>PAY-{{$data->reference}}</td>
                    <td>{{$data->customer->name}}</td>
                    <td>{{number_format($data->amount,2,'.',',')}}</td>
                    <td>{{date('d-m-Y',strtotime($data->payment_date))}}</td>
                  </tr>
                 @endforeach
              <tfoot>
                  <tr>
                    <th class="text-center">{{ trans('message.list.reference') }}</th>
                    <th class="text-center">{{ trans('message.list.customer_name') }}</th>
                    <th class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                    
                  </tr>  
              </tfoot>
                </tbody>
              </table>
    </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="Purchases">
            <h3>{{ trans('message.list.purchases') }}</h3>
                <div class="table-responsive">
              <table id="purchaseList" class="table table-bordered text-center">
                  <thead>
                  <tr>
                    <th width="25%" class="text-center">{{ trans('message.list.reference') }}</th>
                    <th class="text-center">{{ trans('message.list.supplier') }}</th>
                    <th class="text-center">{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($user->purchase_orders as $data)
                  <tr>
                    <td>{{ PURCHASE.$data->reference }}</td>
                    <td>{{ $data->supplier->name }}</td>
                    <td>{{ number_format($data->total,2,'.',',') }}</td>
                    <td>{{ formatDate($data->date)}}</td>
                  </tr>
                 @endforeach
                </tbody>
<tfoot>
<tr>
  <th width="25%" class="text-center">{{ trans('message.list.reference') }}</th>
  <th class="text-center">{{ trans('message.list.supplier') }}</th>
  <th class="text-center">{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
  <th class="text-center">{{ trans('message.list.date') }}</th>

</tr>
</tfoot>
    </table>
    </div>
    </div>

<?php
/*
?>
    <div role="tabpanel" class="tab-pane" id="Income">
            <h3>{{ trans('message.list.income') }}</h3>
                <div class="table-responsive">
              <table id="incomeList" class="table table-bordered text-center">
                  <thead>
                <tr>
                  <th class="text-center" width="20%">{{ trans('message.list.account_name') }}</th>
                  <th class="text-center">{{ trans('message.list.account_no') }}</th>
                  <th class="text-center">{{ trans('message.list.description') }}</th>
                  <th class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
                  <th class="text-center">{{ trans('message.list.date') }}</th>
                </tr>
                  <tbody>
                @foreach($incomeList as $data)
                <tr id="rowid_{{$data->id}}">
                  <td class="text-center">{{ $data->account_name }}</td>
                  <td class="text-center">{{ $data->account_no }}</td>
                  <td class="text-center">{{ $data->description }}</td>
                  <td class="text-center">{{ number_format(abs($data->amount),2,'.',',') }}</td>
                  <td class="text-center">{{ formatDate($data->trans_date) }}</td>
                </tr>
                @endforeach
                </tbody>
              <tfoot>
                  <tr>
                    <th class="text-center">{{ trans('message.list.account_name') }}</th>
                    <th class="text-center">{{ trans('message.list.account_no') }}</th>
                    <th class="text-center">{{ trans('message.list.description') }}</th>
                    <th class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                  </tr>
              </tfoot>
    </table>
    </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="Expenses">
            <h3>{{ trans('message.list.expenses') }}</h3>
                <div class="table-responsive">
              <table id="expensesList" class="table table-bordered text-center">
                  <thead>
                  <tr>
                  <th class="text-center" width="20%">{{ trans('message.list.account_name') }}</th>
                  <th class="text-center">{{ trans('message.list.account_no') }}</th>
                  <th class="text-center">{{ trans('message.list.description') }}</th>
                  <th class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
                  <th class="text-center">{{ trans('message.list.date') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($expenseList as $data)
                <tr id="rowid_{{$data->id}}">
                  <td class="text-center">{{ $data->account_name }}</td>
                  <td class="text-center">{{ $data->account_no }}</td>
                  <td class="text-center">{{ $data->description }}</td>
                  <td class="text-center">{{ number_format(abs($data->amount),2,'.',',') }}</td>
                  <td class="text-center">{{ formatDate($data->trans_date) }}</td>
                </tr>
               @endforeach
                </tbody>
          <tfoot>
            <tr>
              <th class="text-center">{{ trans('message.list.account_name') }}</th>
              <th class="text-center">{{ trans('message.list.account_no') }}</th>
              <th class="text-center">{{ trans('message.list.description') }}</th>
              <th class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
              <th class="text-center">{{ trans('message.list.date') }}</th>
            </tr>
          </tfoot>
    </table>
    </div>
    </div>
<?php
  */
?>

  </div>

            </div>
        </div>
    </div>
</div>    

@endsection
@section('js')
<script type="text/javascript">

  jQuery( document ).ready( function( $ ) {

      var $orderList = jQuery( "#orderList" );
      $orderList.DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5'
          ]
      } );


      var $invoiceList = jQuery( "#invoiceList" );
      $invoiceList.DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5'
          ]
      } );


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

      var $paymentList = jQuery( "#paymentList" );
      $paymentList.DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5'
          ]
      } );


      var $incomeList = jQuery( "#incomeList" );
      $incomeList.DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5'
          ]
      } );

      var $expensesList = jQuery( "#expensesList" );
      $expensesList.DataTable( {
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