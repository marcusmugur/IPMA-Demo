@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.asset.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.assets.update", [$asset->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('inventory_items') ? 'has-error' : '' }}">
                            <label for="inventory_items">{{ trans('cruds.asset.fields.inventory_items') }}*</label>
                            <input type="text" id="inventory_items" name="inventory_items" class="form-control" value="{{ old('inventory_items', isset($asset) ? $asset->inventory_items : '') }}" required>
                            @if($errors->has('inventory_items'))
                                <p class="help-block">
                                    {{ $errors->first('inventory_items') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.inventory_items_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.asset.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($asset) ? $asset->name : '') }}" required>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('serial_number') ? 'has-error' : '' }}">
                            <label for="serial_number">{{ trans('cruds.asset.fields.serial_number') }}</label>
                            <input type="text" id="serial_number" name="serial_number" class="form-control" value="{{ old('serial_number', isset($asset) ? $asset->serial_number : '') }}">
                            @if($errors->has('serial_number'))
                                <p class="help-block">
                                    {{ $errors->first('serial_number') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.serial_number_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('manufacturer') ? 'has-error' : '' }}">
                            <label for="manufacturer">{{ trans('cruds.asset.fields.manufacturer') }}</label>
                            <input type="text" id="manufacturer" name="manufacturer" class="form-control" value="{{ old('manufacturer', isset($asset) ? $asset->manufacturer : '') }}">
                            @if($errors->has('manufacturer'))
                                <p class="help-block">
                                    {{ $errors->first('manufacturer') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.manufacturer_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('model_number') ? 'has-error' : '' }}">
                            <label for="model_number">{{ trans('cruds.asset.fields.model_number') }}</label>
                            <input type="text" id="model_number" name="model_number" class="form-control" value="{{ old('model_number', isset($asset) ? $asset->model_number : '') }}">
                            @if($errors->has('model_number'))
                                <p class="help-block">
                                    {{ $errors->first('model_number') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.model_number_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('location_id') ? 'has-error' : '' }}">
                            <label for="location">{{ trans('cruds.asset.fields.location') }}*</label>
                            <select name="location_id" id="location" class="form-control select2" required>
                                @foreach($locations as $id => $location)
                                    <option value="{{ $id }}" {{ (isset($asset) && $asset->location ? $asset->location->id : old('location_id')) == $id ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location_id'))
                                <p class="help-block">
                                    {{ $errors->first('location_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('line') ? 'has-error' : '' }}">
                            <label for="line">{{ trans('cruds.asset.fields.line') }}</label>
                            <select id="line" name="line" class="form-control">
                                <option value="" disabled {{ old('line', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Asset::LINE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('line', $asset->line) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('line'))
                                <p class="help-block">
                                    {{ $errors->first('line') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('current_quantity') ? 'has-error' : '' }}">
                            <label for="current_quantity">{{ trans('cruds.asset.fields.current_quantity') }}</label>
                            <input type="number" id="current_quantity" name="current_quantity" class="form-control" value="{{ old('current_quantity', isset($asset) ? $asset->current_quantity : '') }}" step="0.01">
                            @if($errors->has('current_quantity'))
                                <p class="help-block">
                                    {{ $errors->first('current_quantity') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.current_quantity_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('unit_price') ? 'has-error' : '' }}">
                            <label for="unit_price">{{ trans('cruds.asset.fields.unit_price') }}</label>
                            <input type="number" id="unit_price" name="unit_price" class="form-control" value="{{ old('unit_price', isset($asset) ? $asset->unit_price : '') }}" step="0.01">
                            @if($errors->has('unit_price'))
                                <p class="help-block">
                                    {{ $errors->first('unit_price') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.unit_price_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('suppliers') ? 'has-error' : '' }}">
                            <label for="suppliers">{{ trans('cruds.asset.fields.suppliers') }}</label>
                            <select id="suppliers" name="suppliers" class="form-control">
                                <option value="" disabled {{ old('suppliers', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Asset::SUPPLIERS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('suppliers', $asset->suppliers) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('suppliers'))
                                <p class="help-block">
                                    {{ $errors->first('suppliers') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('manuals') ? 'has-error' : '' }}">
                            <label for="manuals">{{ trans('cruds.asset.fields.manuals') }}</label>
                            <div class="needsclick dropzone" id="manuals-dropzone">

                            </div>
                            @if($errors->has('manuals'))
                                <p class="help-block">
                                    {{ $errors->first('manuals') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.manuals_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('photos') ? 'has-error' : '' }}">
                            <label for="photos">{{ trans('cruds.asset.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">

                            </div>
                            @if($errors->has('photos'))
                                <p class="help-block">
                                    {{ $errors->first('photos') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.photos_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                            <label for="notes">{{ trans('cruds.asset.fields.notes') }}</label>
                            <textarea id="notes" name="notes" class="form-control ">{{ old('notes', isset($asset) ? $asset->notes : '') }}</textarea>
                            @if($errors->has('notes'))
                                <p class="help-block">
                                    {{ $errors->first('notes') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.notes_helper') }}
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
    var uploadedManualsMap = {}
Dropzone.options.manualsDropzone = {
    url: '{{ route('admin.assets.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="manuals[]" value="' + response.name + '">')
      uploadedManualsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedManualsMap[file.name]
      }
      $('form').find('input[name="manuals[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($asset) && $asset->manuals)
          var files =
            {!! json_encode($asset->manuals) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="manuals[]" value="' + file.file_name + '">')
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
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('admin.assets.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($asset) && $asset->photos)
          var files =
            {!! json_encode($asset->photos) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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