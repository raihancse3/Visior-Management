<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Income Report</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body onload="window.print();">
<div class="wrapper">
  
  <div class="cotainer" style="min-height: 1px; width: 100%">
      <div style="width: 60%; float: left;">
        <address>
          <strong style="font-weight: bold;font-size: 25px;">{{ Session::get('company_name') }}</strong><br>
          {{ Session::get('company_street') }}, {{ Session::get('company_city') }}<br>
         {{ Session::get('company_state') }}, {{ Session::get('company_country_id') }}, {{ Session::get('company_zipCode') }}<br>
          Phone: {{ Session::get('company_phone') }}<br>
          Email: {{ Session::get('company_email') }}
        </address>

      </div>
      <div style="width: 40%; float: left;">
        <strong style="font-weight: bold;font-size: 32px;">Income Report</strong><br>
        <table>
          <tr><td>Date</td><td>:</td><td><?= date('d-m-Y',strtotime($from)) ?> To <?= date('d-m-Y',strtotime($to)) ?></td></tr>
        </table>
      </div>
  </div>

  <div class="clearfix" style="clear: both;"></div>
  <div class="cotainer" style="width: 100%; margin-top: 15px;">
        <table width="100%" style="text-align: center;">
          <thead>
          <tr style="background: gray; color: white;">
             <th>Date</th>
             <th>A/C Name</th>
             <th>A/C No</th>
             <th>Reference</th>
             <th>Description</th>
             <th>Category</th>
             <th>Method</th>
             <th>Amount</th>
          </tr>
          </thead>
           <tbody>
             
                  <?php
                    $total = 0;
                  ?>
                @foreach ($incomeReportData as $item)
                  <?php
                  $total += $item->amount;
                  ?>

                <tr> 
                <td>{{ date('d-m-Y',strtotime($item->trans_date)) }}</td> 
                <td>{{ $item->account_name }}</td>
                <td>{{ $item->account_no }}</td>
                <td>{{ INVOICE.$item->reference }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->method }}</td>
                <td>{{ numberRound($item->amount) }}</td>
                </tr>
                @endforeach  

           </tbody>
            <tfoot>
            <tr>
            <td colspan="6"></td>
            <td colspan="2" style="border-bottom: 2px solid gray">&nbsp;</td>
            </tr>

            <tr>
              <td colspan="6" align="right"><strong>Total : </stong></td>
              <td align="right" colspan="2"><strong>{{numberRound($total) }}</stong></td>            
            </tr>

            </tfoot>
        </table>
  </div>
  <div class="clearfix" style="clear: both;"></div>
  <p><strong>Note : </strong> All amount stated as {{Session::get('currency_symbol')}}.</p>
</div>
</body>
</html>