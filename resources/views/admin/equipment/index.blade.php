@extends('layouts.admin')
@section('content')
<div class="content">
    @can('equipment_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.equipment.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.equipment.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.equipment.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Equipment">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.line') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.model_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.part_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.serial_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.manufacture') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.contact_manufacture') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.electric_specification') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.attachment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.equipment.fields.photo') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($equipment as $key => $equipment)
                                    <tr data-entry-id="{{ $equipment->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $equipment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $equipment->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Equipment::LOCATION_SELECT[$equipment->location] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Equipment::LINE_SELECT[$equipment->line] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $equipment->model_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $equipment->part_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $equipment->serial_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $equipment->manufacture ?? '' }}
                                        </td>
                                        <td>
                                            {{ $equipment->contact_manufacture ?? '' }}
                                        </td>
                                        <td>
                                            {{ $equipment->electric_specification ?? '' }}
                                        </td>
                                        <td>
                                            @if($equipment->attachment)
                                                @foreach($equipment->attachment as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($equipment->photo)
                                                @foreach($equipment->photo as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @can('equipment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.equipment.show', $equipment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('equipment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.equipment.edit', $equipment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('equipment_delete')
                                                <form action="{{ route('admin.equipment.destroy', $equipment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('equipment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.equipment.massDestroy') }}",
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
  $('.datatable-Equipment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection