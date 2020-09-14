@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.equipment.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.equipment.update", [$equipment->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.equipment.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($equipment) ? $equipment->name : '') }}" required>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label for="location">{{ trans('cruds.equipment.fields.location') }}*</label>
                            <select id="location" name="location" class="form-control" required>
                                <option value="" disabled {{ old('location', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Equipment::LOCATION_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('location', $equipment->location) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <p class="help-block">
                                    {{ $errors->first('location') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('line') ? 'has-error' : '' }}">
                            <label for="line">{{ trans('cruds.equipment.fields.line') }}</label>
                            <select id="line" name="line" class="form-control">
                                <option value="" disabled {{ old('line', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Equipment::LINE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('line', $equipment->line) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('line'))
                                <p class="help-block">
                                    {{ $errors->first('line') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('model_number') ? 'has-error' : '' }}">
                            <label for="model_number">{{ trans('cruds.equipment.fields.model_number') }}</label>
                            <input type="text" id="model_number" name="model_number" class="form-control" value="{{ old('model_number', isset($equipment) ? $equipment->model_number : '') }}">
                            @if($errors->has('model_number'))
                                <p class="help-block">
                                    {{ $errors->first('model_number') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.model_number_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('part_number') ? 'has-error' : '' }}">
                            <label for="part_number">{{ trans('cruds.equipment.fields.part_number') }}*</label>
                            <input type="text" id="part_number" name="part_number" class="form-control" value="{{ old('part_number', isset($equipment) ? $equipment->part_number : '') }}" required>
                            @if($errors->has('part_number'))
                                <p class="help-block">
                                    {{ $errors->first('part_number') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.part_number_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('serial_number') ? 'has-error' : '' }}">
                            <label for="serial_number">{{ trans('cruds.equipment.fields.serial_number') }}*</label>
                            <input type="text" id="serial_number" name="serial_number" class="form-control" value="{{ old('serial_number', isset($equipment) ? $equipment->serial_number : '') }}" required>
                            @if($errors->has('serial_number'))
                                <p class="help-block">
                                    {{ $errors->first('serial_number') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.serial_number_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('manufacture') ? 'has-error' : '' }}">
                            <label for="manufacture">{{ trans('cruds.equipment.fields.manufacture') }}</label>
                            <input type="text" id="manufacture" name="manufacture" class="form-control" value="{{ old('manufacture', isset($equipment) ? $equipment->manufacture : '') }}">
                            @if($errors->has('manufacture'))
                                <p class="help-block">
                                    {{ $errors->first('manufacture') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.manufacture_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('contact_manufacture') ? 'has-error' : '' }}">
                            <label for="contact_manufacture">{{ trans('cruds.equipment.fields.contact_manufacture') }}</label>
                            <textarea id="contact_manufacture" name="contact_manufacture" class="form-control ">{{ old('contact_manufacture', isset($equipment) ? $equipment->contact_manufacture : '') }}</textarea>
                            @if($errors->has('contact_manufacture'))
                                <p class="help-block">
                                    {{ $errors->first('contact_manufacture') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.contact_manufacture_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('electric_specification') ? 'has-error' : '' }}">
                            <label for="electric_specification">{{ trans('cruds.equipment.fields.electric_specification') }}</label>
                            <textarea id="electric_specification" name="electric_specification" class="form-control ">{{ old('electric_specification', isset($equipment) ? $equipment->electric_specification : '') }}</textarea>
                            @if($errors->has('electric_specification'))
                                <p class="help-block">
                                    {{ $errors->first('electric_specification') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.electric_specification_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('attachment') ? 'has-error' : '' }}">
                            <label for="attachment">{{ trans('cruds.equipment.fields.attachment') }}</label>
                            <div class="needsclick dropzone" id="attachment-dropzone">

                            </div>
                            @if($errors->has('attachment'))
                                <p class="help-block">
                                    {{ $errors->first('attachment') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.attachment_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                            <label for="photo">{{ trans('cruds.equipment.fields.photo') }}</label>
                            <div class="needsclick dropzone" id="photo-dropzone">

                            </div>
                            @if($errors->has('photo'))
                                <p class="help-block">
                                    {{ $errors->first('photo') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipment.fields.photo_helper') }}
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
    url: '{{ route('admin.equipment.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachment[]" value="' + response.name + '">')
      uploadedAttachmentMap[file.name] = response.name
    },
    removedfile: function (file) {
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
@if(isset($equipment) && $equipment->attachment)
          var files =
            {!! json_encode($equipment->attachment) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
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
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.equipment.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($equipment) && $equipment->photo)
      var files =
        {!! json_encode($equipment->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
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
@stop