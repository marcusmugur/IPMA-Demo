@extends('layouts.admin')
@section('content')
<div class="content">
    @can('production_schedule_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.production-schedules.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.productionSchedule.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.productionSchedule.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ProductionSchedule">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.production_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.room') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.line') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.start_time') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productionSchedules as $key => $productionSchedule)
                                    <tr data-entry-id="{{ $productionSchedule->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $productionSchedule->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productionSchedule->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productionSchedule->production_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\ProductionSchedule::ROOM_SELECT[$productionSchedule->room] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\ProductionSchedule::LINE_SELECT[$productionSchedule->line] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productionSchedule->start_time ?? '' }}
                                        </td>
                                        <td>
                                            @can('production_schedule_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.production-schedules.show', $productionSchedule->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('production_schedule_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.production-schedules.edit', $productionSchedule->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('production_schedule_delete')
                                                <form action="{{ route('admin.production-schedules.destroy', $productionSchedule->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('production_schedule_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.production-schedules.massDestroy') }}",
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
    pageLength: 25,
  });
  $('.datatable-ProductionSchedule:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection