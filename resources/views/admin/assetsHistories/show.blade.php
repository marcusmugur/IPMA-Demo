@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.assetsHistory.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $assetsHistory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.asset') }}
                                    </th>
                                    <td>
                                        {{ $assetsHistory->asset->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $assetsHistory->status->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $assetsHistory->location->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.assigned_user') }}
                                    </th>
                                    <td>
                                        {{ $assetsHistory->assigned_user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $assetsHistory->created_at }}
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