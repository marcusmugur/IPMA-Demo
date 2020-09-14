@extends('layouts.admin')
@section('content')
<div class="content">
    @can('purchase_order_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.purchase-orders.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.purchaseOrder.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.purchaseOrder.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PurchaseOrder">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.supplier') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.first_due') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.equipment') }}
                                    </th>                                    
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.total') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseOrders as $key => $purchaseOrder)
                                    <tr data-entry-id="{{ $purchaseOrder->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $purchaseOrder->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\PurchaseOrder::SUPPLIER_SELECT[$purchaseOrder->supplier] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->first_due ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\PurchaseOrder::EQUIPMENT_SELECT[$purchaseOrder->equipment] ?? '' }}
                                        </td>                                        
                                        <td>
                                            {{ $purchaseOrder->total ?? '' }}
                                        </td>
                                        <td>
                                            @can('purchase_order_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.purchase-orders.show', $purchaseOrder->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('purchase_order_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.purchase-orders.edit', $purchaseOrder->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('purchase_order_delete')
                                                <form action="{{ route('admin.purchase-orders.destroy', $purchaseOrder->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('purchase_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.purchase-orders.massDestroy') }}",
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
  $('.datatable-PurchaseOrder:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection