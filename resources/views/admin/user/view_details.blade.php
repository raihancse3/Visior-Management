@extends('layouts.app')
@section('content')
    <!-- Main content -->
<section class="content">
<div class="box">
<div class="box box-info">
   <div class="box-header with-border">
    <h3 class="box-title">Details Information Of {{$user->name}}</h3>
  </div>
  <div class="box-body">

      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu1">{{ trans('message.list.orders') }}</a></li>
        <li><a data-toggle="tab" href="#menu2">{{ trans('message.list.invoices') }}</a></li>
        <li><a data-toggle="tab" href="#menu3">{{ trans('message.list.payments') }}</a></li>
        <li><a data-toggle="tab" href="#menu4">{{ trans('message.list.purchases') }}</a></li>
        <li><a data-toggle="tab" href="#menu5">{{ trans('message.list.income') }}</a></li>
        <li><a data-toggle="tab" href="#menu6">{{ trans('message.list.expenses') }}</a></li>

      </ul>

      <div class="tab-content">
        <div id="menu1" class="tab-pane fade in active">
          <h4>{{ trans('message.list.orders') }}</h4>
            <div class="table-responsive">
              <table id="orderList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">{{ trans('message.list.reference') }}</th>
                    <th class="text-center">{{ trans('message.list.customer_name') }}</th>
                    <th class="text-center">{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($orderList as $keyOrder=>$data)
                 
                  <tr>
                    <td class="text-center"><a  title="View" href='{{ url("order/view/$data->id") }}'>{{ ORDER.$data->reference }}</a></td>
                    <td class="text-center">{{ $data->customer_name }}</td>
                    
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
                 </table>
            </div>
        </div>

        <div id="menu2" class="tab-pane fade">
          <h4>{{ trans('message.list.invoices') }}</h4>
            <div class="table-responsive">
              <table id="invoiceList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%" class="text-center">{{trans('message.list.reference') }}</th>
                    <th class="text-center">{{ trans('message.list.customer_name') }}</th>
                    
                    <th class="text-center">{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                    <th class="text-center">{{ trans('message.list.date') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($invoiceList as $invoiceKey=>$data)
                   
                  <tr>
                    <td class="text-center"><a  title="View" href='{{ url("invoice/view/$data->id") }}'>{{ INVOICE.$data->reference }}</a></td>
                    <td class="text-center">{{ $data->customer_name }}</td>
                    
                    <td class="text-center">{{ number_format($data->total,2,'.',',') }}</td>
                    
                    <td class="text-center">{{ formatDate($data->date)}}</td>
                  </tr>
                 
                 @endforeach
                  </tbody>
                 </table>
            </div>
        </div>

        <div id="menu3" class="tab-pane fade">
         <h4>{{ trans('message.list.payments') }}</h4>
              <div class="table-responsive">
                <table id="paymentList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>{{ trans('message.list.reference') }}</th>
                    <th>{{ trans('message.list.customer_name') }}</th>
                    <th>{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
                    <th>{{ trans('message.list.date') }}</th>
                    <th width="5%">{{ trans('message.list.action') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($paymentList as $data)
                  <tr id="rowid_{{$data->id}}">
                    <td>PAY-{{$data->reference}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{number_format($data->amount,2,'.',',')}}</td>
                    <td>{{date('d-m-Y',strtotime($data->payment_date))}}</td>
                    <td>                                        
                        <a  title="View" class="btn btn-xs btn-primary" href='{{ url("payment/view/$data->id") }}'><span class="fa fa-eye"></span></a> &nbsp;
                    </td>
                  </tr>
                 @endforeach
                  </tbody>
                </table>
              </div>
        </div>

        <div id="menu4" class="tab-pane fade">
         <h4>{{ trans('message.list.purchases') }}</h4>

            <div class="table-responsive">
              <table id="purchaseList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">{{ trans('message.list.reference') }}</th>
                    <th>{{ trans('message.list.supplier') }}</th>
                    <th>{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                    <th>{{ trans('message.list.date') }}</th>
                    <th width="5%">{{ trans('message.list.action') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($purchData as $data)
                  <tr id="rowid_{{$data->id}}">
                    <td>{{ PURCHASE.$data->reference }}</td>
                    <td>{{ $data->supplier_name }}</td>
                    
                    <td>{{ number_format($data->total,2,'.',',') }}</td>
                    
                    <td>{{ formatDate($data->date)}}</td>
                    <td>
                        
                        <a  title="View" class="btn btn-xs btn-info" href='{{ url("purchase/view/$data->id") }}'><span class="fa fa-eye"></span></a> &nbsp;     
             
                    </td>
                  </tr>
                 @endforeach
                  </tbody>
                 </table>
            </div>
        </div>

          <div id="menu5" class="tab-pane fade">
          <h4>{{ trans('message.list.income') }}</h4>

              <table id="incomeList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">{{ trans('message.list.account_name') }}</th>
                  <th class="text-center">{{ trans('message.list.account_no') }}</th>
                  <th class="text-center">{{ trans('message.list.description') }}</th>
                  <th class="text-center">{{ trans('message.list.amount') }}({{Session::get('currency_symbol')}})</th>
                  <th class="text-center">{{ trans('message.list.date') }}</th>
                  
                </tr>
                </thead>
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
              </table>

          </div>

          <div id="menu6" class="tab-pane fade">
          <h4>{{ trans('message.list.expenses') }}</h4>
              <table id="expenseList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">{{ trans('message.list.account_name') }}</th>
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
              </table>

          </div>

      </div>

  </div>
</div>
</section>
@endsection
@section('js')
<script type="text/javascript">
  $('#orderList').DataTable();
  $('#invoiceList').DataTable();
  $('#paymentList').DataTable();
  $('#purchaseList').DataTable();
  $('#incomeList').DataTable();
  $('#expenseList').DataTable();
</script>
@endsection