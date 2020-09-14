@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.task.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.tasks.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.task.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($task) ? $task->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.task.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.task.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($task) ? $task->description : '') }}</textarea>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.task.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                <label for="status">{{ trans('cruds.task.fields.status') }}*</label>
                <select name="status_id" id="status" class="form-control select2" required>
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ (isset($task) && $task->status ? $task->status->id : old('status_id')) == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_id'))
                    <p class="help-block">
                        {{ $errors->first('status_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                <label for="tag">{{ trans('cruds.task.fields.tag') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="tags[]" id="tags" class="form-control select2" multiple="multiple">
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || isset($task) && $task->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <p class="help-block">
                        {{ $errors->first('tags') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.task.fields.tag_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('attachment') ? 'has-error' : '' }}">
                <label for="attachment">{{ trans('cruds.task.fields.attachment') }}</label>
                <div class="needsclick dropzone" id="attachment-dropzone">

                </div>
                @if($errors->has('attachment'))
                    <p class="help-block">
                        {{ $errors->first('attachment') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.task.fields.attachment_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('due_date') ? 'has-error' : '' }}">
                <label for="due_date">{{ trans('cruds.task.fields.due_date') }}</label>
                <input type="text" id="due_date" name="due_date" class="form-control date" value="{{ old('due_date', isset($task) ? $task->due_date : '') }}">
                @if($errors->has('due_date'))
                    <p class="help-block">
                        {{ $errors->first('due_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.task.fields.due_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('assigned_to_id') ? 'has-error' : '' }}">
                <label for="assigned_to">{{ trans('cruds.task.fields.assigned_to') }}</label>
                <select name="assigned_to_id" id="assigned_to" class="form-control select2">
                    @foreach($assigned_tos as $id => $assigned_to)
                        <option value="{{ $id }}" {{ (isset($task) && $task->assigned_to ? $task->assigned_to->id : old('assigned_to_id')) == $id ? 'selected' : '' }}>{{ $assigned_to }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to_id'))
                    <p class="help-block">
                        {{ $errors->first('assigned_to_id') }}
                    </p>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.tasks.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="attachment"]').remove()
      $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="attachment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($task) && $task->attachment)
      var file = {!! json_encode($task->attachment) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="attachment" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@stop