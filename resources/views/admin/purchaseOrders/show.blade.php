@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.purchaseOrder.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.supplier') }}
                                    </th>
                                    <td>
                                        {{ App\PurchaseOrder::SUPPLIER_SELECT[$purchaseOrder->supplier] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.first_due') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->first_due }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.equipment') }}
                                    </th>
                                    <td>
                                        {{ App\PurchaseOrder::EQUIPMENT_SELECT[$purchaseOrder->equipment] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.account_number') }}
                                    </th>
                                    <td>
                                        {{ App\PurchaseOrder::ACCOUNT_NUMBER_SELECT[$purchaseOrder->account_number] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.project_nr') }}
                                    </th>
                                    <td>
                                        {{ App\PurchaseOrder::PROJECT_NR_SELECT[$purchaseOrder->project_nr] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.memo') }}
                                    </th>
                                    <td>
                                        {!! $purchaseOrder->memo !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.ship_to') }}
                                    </th>
                                    <td>
                                        {{ App\PurchaseOrder::SHIP_TO_SELECT[$purchaseOrder->ship_to] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Line Items
                                    </th>
                                    <td>
                                        @foreach($purchaseOrder->line_items as $id => $line_items)
                                            <span class="label label-info label-many">{{ $line_items->inventory_items }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.qty') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.unit_price') }}
                                    </th>
                                    <td>
                                        ${{ $purchaseOrder->unit_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.tax_rate') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->tax_rate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.line_total') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->line_total }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.shipping_cost') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->shipping_cost }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.discount') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.tax') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->tax }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.total') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->total }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection