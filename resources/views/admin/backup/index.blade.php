@extends('layouts.app_admin')
@section('main')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary" data-collapsed="0">
      <!-- panel head -->
      <div class="panel-heading">
        <div class="panel-title">{{ trans('message.menu.database_backup') }}</div>
        <div class="panel-options">
          @if(Helpers::has_permission(Auth::user()->id, 'backup_add'))
          <a href="{{url('backup/add')}}" class="bg" id="backupid">{{ trans('message.list.add_new') }}</a>
          @endif
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
      </div>
    <!-- /.box-header -->
    <div class="panel-body">
      <table id="example1" class="table table-bordered">
        <thead>
          <tr class="bg-success">
            
            <th>{{ trans('message.list.name') }}</th>
            <th>{{ trans('message.list.date') }}</th>
            <th width="5%">{{ trans('message.list.action') }}</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;?>
          @foreach ($backups as $data)
          <tr>
            
            <td>{{ $data->name }}</td>
            <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
            <td>
               <a href="{{url('/storage/backup/'.$data->name)}}"  class="btn btn-sm btn-success">Download</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
    </div>
  </div>

@endsection
@section('js')
<script type="text/javascript">
</script>
@endsection