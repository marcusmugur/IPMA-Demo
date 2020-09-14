@extends('layouts.admin')
@section('content')
<div class="content">
    @can('maintenance_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.maintenances.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.maintenance.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.maintenance.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Maintenance">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.location') }}
                                    </th>                                    
                                    <th>
                                        {{ trans('cruds.maintenance.fields.first_due') }}
                                    </th> 
                                    <th>
                                        {{ trans('cruds.maintenance.fields.file_attachment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.attachment') }}
                                    </th>                                    
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($maintenances as $key => $maintenance)
                                    <tr data-entry-id="{{ $maintenance->id }}">
                                        <td>
                                        </td>
                                        <td>
                                            {{ $maintenance->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Maintenance::TYPE_SELECT[$maintenance->type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenance->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Maintenance::LOCATION_SELECT[$maintenance->location] ?? '' }}
                                        </td>
                                        
                                        <td>
                                            {{ $maintenance->first_due ?? '' }}
                                        </td>                                        
                                        <td>
                                            @if($maintenance->file_attachment)
                                                @foreach($maintenance->file_attachment as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($maintenance->attachment)
                                                @foreach($maintenance->attachment as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @can('maintenance_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.maintenances.show', $maintenance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('maintenance_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.maintenances.edit', $maintenance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('maintenance_delete')
                                                <form action="{{ route('admin.maintenances.destroy', $maintenance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('maintenance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.maintenances.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-Maintenance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection