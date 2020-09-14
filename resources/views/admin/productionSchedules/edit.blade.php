@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.productionSchedule.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.production-schedules.update", [$productionSchedule->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">                      
                            <div class="row" style="float:right; padding-right:20px">
                                <div class="col-lg-12">                                    
                                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">                                
                                </div>   
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.productionSchedule.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($productionSchedule) ? $productionSchedule->name : '') }}" required>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.productionSchedule.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('production_description') ? 'has-error' : '' }}">
                            <label for="production_description">{{ trans('cruds.productionSchedule.fields.production_description') }}</label>
                            <textarea id="production_description" name="production_description" class="form-control ">{{ old('production_description', isset($productionSchedule) ? $productionSchedule->production_description : '') }}</textarea>
                            @if($errors->has('production_description'))
                                <p class="help-block">
                                    {{ $errors->first('production_description') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.productionSchedule.fields.production_description_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('room') ? 'has-error' : '' }}">
                            <label for="room">{{ trans('cruds.productionSchedule.fields.room') }}*</label>
                            <select id="room" name="room" class="form-control" required>
                                <option value="" disabled {{ old('room', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\ProductionSchedule::ROOM_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('room', $productionSchedule->room) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('room'))
                                <p class="help-block">
                                    {{ $errors->first('room') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('line') ? 'has-error' : '' }}">
                            <label for="line">{{ trans('cruds.productionSchedule.fields.line') }}*</label>
                            <select id="line" name="line" class="form-control" required>
                                <option value="" disabled {{ old('line', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\ProductionSchedule::LINE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('line', $productionSchedule->line) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('line'))
                                <p class="help-block">
                                    {{ $errors->first('line') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                            <label for="start_time">{{ trans('cruds.productionSchedule.fields.start_time') }}*</label>
                            <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($productionSchedule) ? $productionSchedule->start_time : '') }}" required>
                            @if($errors->has('start_time'))
                                <p class="help-block">
                                    {{ $errors->first('start_time') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.productionSchedule.fields.start_time_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('attachment') ? 'has-error' : '' }}">
                            <label for="attachment">{{ trans('cruds.productionSchedule.fields.attachment') }}</label>
                            <div class="needsclick dropzone" id="attachment-dropzone">

                            </div>
                            @if($errors->has('attachment'))
                                <p class="help-block">
                                    {{ $errors->first('attachment') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.productionSchedule.fields.attachment_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('add_file') ? 'has-error' : '' }}">
                            <label for="add_file">{{ trans('cruds.productionSchedule.fields.add_file') }}</label>
                            <div class="needsclick dropzone" id="add_file-dropzone">

                            </div>
                            @if($errors->has('add_file'))
                                <p class="help-block">
                                    {{ $errors->first('add_file') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.productionSchedule.fields.add_file_helper') }}
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

@section('scripts')
<script>
    var uploadedAttachmentMap = {}
Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.production-schedules.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachment[]" value="' + response.name + '">')
      uploadedAttachmentMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachmentMap[file.name]
      }
      $('form').find('input[name="attachment[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($productionSchedule) && $productionSchedule->attachment)
      var files =
        {!! json_encode($productionSchedule->attachment) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="attachment[]" value="' + file.file_name + '">')
        }
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
<script>
    Dropzone.options.addFileDropzone = {
    url: '{{ route('admin.production-schedules.storeMedia') }}',
    maxFilesize: 4, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').find('input[name="add_file"]').remove()
      $('form').append('<input type="hidden" name="add_file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="add_file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($productionSchedule) && $productionSchedule->add_file)
      var file = {!! json_encode($productionSchedule->add_file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="add_file" value="' + file.file_name + '">')
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