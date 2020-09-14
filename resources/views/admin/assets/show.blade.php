@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.asset.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $asset->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.inventory_items') }}
                                    </th>
                                    <td>
                                        {{ $asset->inventory_items }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $asset->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.serial_number') }}
                                    </th>
                                    <td>
                                        {{ $asset->serial_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.manufacturer') }}
                                    </th>
                                    <td>
                                        {{ $asset->manufacturer }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.model_number') }}
                                    </th>
                                    <td>
                                        {{ $asset->model_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $asset->location->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.line') }}
                                    </th>
                                    <td>
                                        {{ App\Asset::LINE_SELECT[$asset->line] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.current_quantity') }}
                                    </th>
                                    <td>
                                        {{ $asset->current_quantity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.unit_price') }}
                                    </th>
                                    <td>
                                        ${{ $asset->unit_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.suppliers') }}
                                    </th>
                                    <td>
                                        {{ App\Asset::SUPPLIERS_SELECT[$asset->suppliers] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.manuals') }}
                                    </th>
                                    <td>
                                        {{ $asset->manuals }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.photos') }}
                                    </th>
                                    <td>
                                        {{ $asset->photos }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.notes') }}
                                    </th>
                                    <td>
                                        {!! $asset->notes !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>

                    <ul class="nav nav-tabs">

                    </ul>
                    <div class="tab-content">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection