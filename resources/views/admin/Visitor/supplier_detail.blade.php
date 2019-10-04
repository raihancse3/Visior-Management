@extends('layouts.app_admin')
@section('content')
    <!-- Main content -->
    <section class="content">
    <h3>{{$supplierInfo->name}}</h3>
        <div class="box">
          <div class="box-body">
            <div class="table-responsive">
              <table id="purchaseList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">{{ trans('message.list.reference') }}</th>
                    <th>{{ trans('message.list.date') }}</th>
                    <th>{{ trans('message.list.total') }}({{Session::get('currency_symbol')}})</th>
                    <th width="15%">{{ trans('message.list.action') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($orderList as $item)
                  <tr id="rowid_{{$item->id}}">
                    <td>{{ PURCHASE.$item->reference }}</td>
                    <td>{{ date('d-m-Y',strtotime($item->date))}}</td>
                    <td>{{ number_format($item->total,2,'.',',') }}</td>
                    <td>
                        <a  title="View" class="btn btn-xs btn-info" href='{{ url("purchase/view/$item->id") }}'><span class="fa fa-eye"></span></a> &nbsp; 

                        <a  title="edit" class="btn btn-xs btn-primary" href='{{ url("purchase/edit/$item->id") }}'><span class="fa fa-edit"></span></a> &nbsp;
                    <a class="btn btn-xs btn-danger deleteRow" id='{{$item->id}}'><span class="fa fa-remove"></span></a> 

                    </td>
                  </tr>
                 @endforeach
                  </tfoot>
                 </table>
            </div>
          </div>
        </div>

    </section>
@endsection
@section('js')
    <script type="text/javascript">
      $(function () {
        $("#purchaseList").DataTable({
          "order": [],
          "columnDefs": [ {
            "targets": 3,
            "orderable": false
            } ],

            "language": '{{Session::get('dflt_lang')}}'
        });
      });
$(document).ready(function () {
      var table = $('#purchaseList').DataTable();
      $('#purchaseList').on('click', 'a.deleteRow', function () {
          var btn = this;
          var rowid = $(this).attr('id');
          swal({
            title: "Are you sure?",
            text: "You will not be able to recover this information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          },
          function(isConfirm){
             if (!isConfirm) return;
            $.ajax({
                url: SITE_URL+"/purchase/delete",
                type: "POST",
                data: {
                    id: rowid
                },
                dataType: "html",
                success: function () {
                    $("#rowid_"+rowid).remove();
                    swal("Done!", "It was succesfully deleted!", "success");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", "error");
                }
            });
          });

      });
});
// Delete End

    </script>
@endsection