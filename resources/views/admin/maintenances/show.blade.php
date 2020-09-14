@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.maintenance.title') }} 
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $maintenance->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Maintenance::TYPE_SELECT[$maintenance->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $maintenance->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.location') }}
                                    </th>
                                    <td>
                                        {{ App\Maintenance::LOCATION_SELECT[$maintenance->location] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.line') }}
                                    </th>
                                    <td>
                                        {{ App\Maintenance::LINE_SELECT[$maintenance->line] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.equipment') }}
                                    </th>
                                    <td>
                                        {{ App\Maintenance::EQUIPMENT_SELECT[$maintenance->equipment] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.first_due') }}
                                    </th>
                                    <td>
                                        {{ $maintenance->first_due }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.repeats') }}
                                    </th>
                                    <td>
                                        {{ App\Maintenance::REPEATS_SELECT[$maintenance->repeats] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.next_due_date') }}
                                    </th>
                                    <td>
                                        {{ $maintenance->next_due_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.assigned_to') }}
                                    </th>
                                    <td>
                                        {{ App\Maintenance::ASSIGNED_TO_SELECT[$maintenance->assigned_to] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.is_outsourced') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled {{ $maintenance->is_outsourced ? "checked" : "" }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $maintenance->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.file_attachment') }}
                                    </th>
                                    <td>
                                        {{ $maintenance->file_attachment }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.attachment') }}
                                    </th>
                                    <td>
                                        @foreach($maintenance->attachment as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenance.fields.qc_verification') }}
                                    </th>
                                    <td>
                                        {!! $maintenance->qc_verification !!}
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