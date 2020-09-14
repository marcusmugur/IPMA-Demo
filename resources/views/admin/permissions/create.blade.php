@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.permission.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.permissions.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">{{ trans('cruds.permission.fields.title') }}*</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->title : '') }}" required>
                            @if($errors->has('title'))
                                <p class="help-block">
                                    {{ $errors->first('title') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.permission.fields.title_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                            <label for="user">{{ trans('cruds.permission.fields.user') }}</label>
                            <input type="text" id="user" name="user" class="form-control" value="{{ old('user', isset($permission) ? $permission->user : '') }}">
                            @if($errors->has('user'))
                                <p class="help-block">
                                    {{ $errors->first('user') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.permission.fields.user_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('administrator') ? 'has-error' : '' }}">
                            <label for="administrator">{{ trans('cruds.permission.fields.administrator') }}</label>
                            <input type="text" id="administrator" name="administrator" class="form-control" value="{{ old('administrator', isset($permission) ? $permission->administrator : '') }}">
                            @if($errors->has('administrator'))
                                <p class="help-block">
                                    {{ $errors->first('administrator') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.permission.fields.administrator_helper') }}
                            </p>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection