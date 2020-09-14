@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.productionSchedule.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productionSchedule->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $productionSchedule->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.production_description') }}
                                    </th>
                                    <td>
                                        {!! $productionSchedule->production_description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.room') }}
                                    </th>
                                    <td>
                                        {{ App\ProductionSchedule::ROOM_SELECT[$productionSchedule->room] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.line') }}
                                    </th>
                                    <td>
                                        {{ App\ProductionSchedule::LINE_SELECT[$productionSchedule->line] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.start_time') }}
                                    </th>
                                    <td>
                                        {{ $productionSchedule->start_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.attachment') }}
                                    </th>
                                    <td>
                                        @foreach($productionSchedule->attachment as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productionSchedule.fields.add_file') }}
                                    </th>
                                    <td>
                                        {{ $productionSchedule->add_file }}
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