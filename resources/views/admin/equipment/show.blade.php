@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.equipment.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $equipment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $equipment->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.location') }}
                                    </th>
                                    <td>
                                        {{ App\Equipment::LOCATION_SELECT[$equipment->location] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.line') }}
                                    </th>
                                    <td>
                                        {{ App\Equipment::LINE_SELECT[$equipment->line] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.model_number') }}
                                    </th>
                                    <td>
                                        {{ $equipment->model_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.part_number') }}
                                    </th>
                                    <td>
                                        {{ $equipment->part_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.serial_number') }}
                                    </th>
                                    <td>
                                        {{ $equipment->serial_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.manufacture') }}
                                    </th>
                                    <td>
                                        {{ $equipment->manufacture }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.contact_manufacture') }}
                                    </th>
                                    <td>
                                        {!! $equipment->contact_manufacture !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.electric_specification') }}
                                    </th>
                                    <td>
                                        {!! $equipment->electric_specification !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.attachment') }}
                                    </th>
                                    <td>
                                        {{ $equipment->attachment }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipment.fields.photo') }}
                                    </th>
                                    <td>
                                        @foreach($equipment->photo as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endforeach
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