@extends('layouts.admin')
@section('content')
<div class="content">
    @can('asset_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.assets.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.asset.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.asset.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.inventory_items') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.serial_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.manufacturer') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.model_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.line') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.current_quantity') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.unit_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.suppliers') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.manuals') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.photos') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.notes') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $key => $asset)
                                    <tr data-entry-id="{{ $asset->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $asset->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->inventory_items ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->serial_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->manufacturer ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->model_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->location->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Asset::LINE_SELECT[$asset->line] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->current_quantity ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->unit_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Asset::SUPPLIERS_SELECT[$asset->suppliers] ?? '' }}
                                        </td>
                                        <td>
                                            @if($asset->manuals)
                                                @foreach($asset->manuals as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($asset->photos)
                                                @foreach($asset->photos as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            {{ $asset->notes ?? '' }}
                                        </td>
                                        <td>
                                            @can('asset_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.assets.show', $asset->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('asset_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.assets.edit', $asset->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('asset_delete')
                                                <form action="{{ route('admin.assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('asset_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assets.massDestroy') }}",
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
  $('.datatable-Asset:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection