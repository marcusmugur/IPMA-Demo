@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.maintenance.title_singular') }}                                         
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.maintenances.update", [$maintenance->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">                      
                            <div class="row" style="float:right; padding-right:20px">
                                <div class="col-lg-12">                                    
                                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">                                
                                </div>   
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4"> 
                                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                            <label for="type">{{ trans('cruds.maintenance.fields.type') }}*</label>
                                            <select id="type" name="type" class="form-control" required>
                                                <option value="" disabled>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Maintenance::TYPE_SELECT as $key => $label)
                                                    <option value="{{ $key }}" {{ old('type', 'Maintenance') === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('type'))
                                                <p class="help-block">
                                                    {{ $errors->first('type') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8"> 
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name">{{ trans('cruds.maintenance.fields.name') }}*</label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($maintenance) ? $maintenance->name : '') }}" required>
                                            @if($errors->has('name'))
                                                <p class="help-block">
                                                    {{ $errors->first('name') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.maintenance.fields.name_helper') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="row">   
                                    <div class="col-md-4"> 
                                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                            <label for="location">{{ trans('cruds.maintenance.fields.location') }}*</label>
                                            <select id="location" name="location" class="form-control" required>
                                                <option value="" disabled>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Maintenance::LOCATION_SELECT as $key => $label)
                                                    <option value="{{ $key }}" {{ old('location', 'location 1') === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('location'))
                                                <p class="help-block">
                                                    {{ $errors->first('location') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('line') ? 'has-error' : '' }}">
                                            <label for="line">{{ trans('cruds.maintenance.fields.line') }}</label>
                                            <select id="line" name="line" class="form-control">
                                                <option value="" disabled>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Maintenance::LINE_SELECT as $key => $label)
                                                    <option value="{{ $key }}" {{ old('line', 'Line 1') === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('line'))
                                                <p class="help-block">
                                                    {{ $errors->first('line') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('equipment') ? 'has-error' : '' }}">
                                            <label for="equipment">{{ trans('cruds.maintenance.fields.equipment') }}</label>
                                            <select id="equipment" name="equipment" class="form-control">
                                                <option value="" disabled {{ old('equipment', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Maintenance::EQUIPMENT_SELECT as $key => $label)
                                                    <option value="{{ $key }}" {{ old('equipment', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('equipment'))
                                                <p class="help-block">
                                                    {{ $errors->first('equipment') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                            
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('first_due') ? 'has-error' : '' }}">
                                            <label for="first_due">{{ trans('cruds.maintenance.fields.first_due') }}*</label>
                                            <input type="text" id="first_due" name="first_due" class="form-control date" value="{{ old('first_due', isset($maintenance) ? $maintenance->first_due : '') }}" required>
                                            @if($errors->has('first_due'))
                                                <p class="help-block">
                                                    {{ $errors->first('first_due') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.maintenance.fields.first_due_helper') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('repeats') ? 'has-error' : '' }}">
                                            <label for="repeats">{{ trans('cruds.maintenance.fields.repeats') }}</label>
                                            <select id="repeats" name="repeats" class="form-control">
                                                <option value="" disabled>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Maintenance::REPEATS_SELECT as $key => $label)
                                                    <option value="{{ $key }}" {{ old('repeats', 'Never') === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('repeats'))
                                                <p class="help-block">
                                                    {{ $errors->first('repeats') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('next_due_date') ? 'has-error' : '' }}">
                                            <label for="next_due_date">{{ trans('cruds.maintenance.fields.next_due_date') }}</label>
                                            <input type="text" id="next_due_date" name="next_due_date" class="form-control date" value="{{ old('next_due_date', isset($maintenance) ? $maintenance->next_due_date : '') }}">
                                            @if($errors->has('next_due_date'))
                                                <p class="help-block">
                                                    {{ $errors->first('next_due_date') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.maintenance.fields.next_due_date_helper') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                            
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : '' }}">
                                            <label for="assigned_to">{{ trans('cruds.maintenance.fields.assigned_to') }}</label>
                                            <select id="assigned_to" name="assigned_to" class="form-control">
                                                <option value="" disabled {{ old('assigned_to', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Maintenance::ASSIGNED_TO_SELECT as $key => $label)
                                                    <option value="{{ $key }}" {{ old('assigned_to', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('assigned_to'))
                                                <p class="help-block">
                                                    {{ $errors->first('assigned_to') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('is_outsourced') ? 'has-error' : '' }}">
                                            <label for="is_outsourced">{{ trans('cruds.maintenance.fields.is_outsourced') }}</label>
                                            <input name="is_outsourced" type="hidden" value="0">
                                            <input value="1" type="checkbox" id="is_outsourced" name="is_outsourced" {{ old('is_outsourced', 0) == 1 ? 'checked' : '' }}>
                                            @if($errors->has('is_outsourced'))
                                                <p class="help-block">
                                                    {{ $errors->first('is_outsourced') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.maintenance.fields.is_outsourced_helper') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">                           
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                            <label for="description">{{ trans('cruds.maintenance.fields.description') }}</label>
                                            <textarea id="description" name="description" class="form-control ">{{ old('description', isset($maintenance) ? $maintenance->description : '') }}</textarea>
                                            @if($errors->has('description'))
                                                <p class="help-block">
                                                    {{ $errors->first('description') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.maintenance.fields.description_helper') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('qc_verification') ? 'has-error' : '' }}">
                                            <label for="qc_verification">{{ trans('cruds.maintenance.fields.qc_verification') }}</label>
                                            <textarea id="qc_verification" name="qc_verification" class="form-control ">{{ old('qc_verification', isset($maintenance) ? $maintenance->qc_verification : '') }}</textarea>
                                            @if($errors->has('qc_verification'))
                                                <p class="help-block">
                                                    {{ $errors->first('qc_verification') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.maintenance.fields.qc_verification_helper') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('attachment') ? 'has-error' : '' }}">
                                            <label for="attachment">{{ trans('cruds.maintenance.fields.attachment') }}</label>
                                            <div class="needsclick dropzone" id="attachment-dropzone">    
                                            </div>
                                            @if($errors->has('attachment'))
                                                <p class="help-block">
                                                    {{ $errors->first('attachment') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.maintenance.fields.attachment_helper') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('file_attachment') ? 'has-error' : '' }}">
                                            <label for="file_attachment">{{ trans('cruds.maintenance.fields.file_attachment') }}</label>
                                            <div class="needsclick dropzone" id="file_attachment-dropzone">    
                                            </div>
                                            @if($errors->has('file_attachment'))
                                                <p class="help-block">
                                                    {{ $errors->first('file_attachment') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.maintenance.fields.file_attachment_helper') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                                    <input class="btn btn-success" type="submit" value="{{ trans('global.submit') }}">
                                </div>
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
    var uploadedFileAttachmentMap = {}
Dropzone.options.fileAttachmentDropzone = {
    url: '{{ route('admin.maintenances.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file_attachment[]" value="' + response.name + '">')
      uploadedFileAttachmentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileAttachmentMap[file.name]
      }
      $('form').find('input[name="file_attachment[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($maintenance) && $maintenance->file_attachment)
          var files =
            {!! json_encode($maintenance->file_attachment) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file_attachment[]" value="' + file.file_name + '">')
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
    var uploadedAttachmentMap = {}
Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.maintenances.storeMedia') }}',
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
@if(isset($maintenance) && $maintenance->attachment)
      var files =
        {!! json_encode($maintenance->attachment) !!}
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
@stop