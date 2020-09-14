@extends('layouts.admin')
@section('content')
<div class="content">        
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.purchaseOrder.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.purchase-orders.update", [$purchaseOrder->id]) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="name">{{ trans('cruds.purchaseOrder.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($purchaseOrder) ? $purchaseOrder->name : '') }}" required>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('supplier') ? 'has-error' : '' }}">
                            <label for="supplier">{{ trans('cruds.purchaseOrder.fields.supplier') }}*</label>
                            <select id="supplier" name="supplier" class="form-control" required>
                                <option value="" disabled {{ old('supplier', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\PurchaseOrder::SUPPLIER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('supplier', $purchaseOrder->supplier) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('supplier'))
                                <p class="help-block">
                                    {{ $errors->first('supplier') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('first_due') ? 'has-error' : '' }}">
                            <label for="first_due">{{ trans('cruds.purchaseOrder.fields.first_due') }}*</label>
                            <input type="text" id="first_due" name="first_due" class="form-control date" value="{{ old('first_due', isset($purchaseOrder) ? $purchaseOrder->first_due : '') }}" required>
                            @if($errors->has('first_due'))
                                <p class="help-block">
                                    {{ $errors->first('first_due') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.first_due_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('equipment') ? 'has-error' : '' }}">
                            <label for="equipment">{{ trans('cruds.purchaseOrder.fields.equipment') }}</label>
                            <select id="equipment" name="equipment" class="form-control">
                                <option value="" disabled {{ old('equipment', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\PurchaseOrder::EQUIPMENT_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('equipment', $purchaseOrder->equipment) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('equipment'))
                                <p class="help-block">
                                    {{ $errors->first('equipment') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('account_number') ? 'has-error' : '' }}">
                            <label for="account_number">{{ trans('cruds.purchaseOrder.fields.account_number') }}*</label>
                            <select id="account_number" name="account_number" class="form-control" required>
                                <option value="" disabled {{ old('account_number', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\PurchaseOrder::ACCOUNT_NUMBER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('account_number', $purchaseOrder->account_number) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('account_number'))
                                <p class="help-block">
                                    {{ $errors->first('account_number') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('project_nr') ? 'has-error' : '' }}">
                            <label for="project_nr">{{ trans('cruds.purchaseOrder.fields.project_nr') }}</label>
                            <select id="project_nr" name="project_nr" class="form-control">
                                <option value="" disabled {{ old('project_nr', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\PurchaseOrder::PROJECT_NR_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('project_nr', $purchaseOrder->project_nr) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project_nr'))
                                <p class="help-block">
                                    {{ $errors->first('project_nr') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('memo') ? 'has-error' : '' }}">
                            <label for="memo">{{ trans('cruds.purchaseOrder.fields.memo') }}</label>
                            <textarea id="memo" name="memo" class="form-control ">{{ old('memo', isset($purchaseOrder) ? $purchaseOrder->memo : '') }}</textarea>
                            @if($errors->has('memo'))
                                <p class="help-block">
                                    {{ $errors->first('memo') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.memo_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('ship_to') ? 'has-error' : '' }}">
                            <label for="ship_to">{{ trans('cruds.purchaseOrder.fields.ship_to') }}*</label>
                            <select id="ship_to" name="ship_to" class="form-control" required>
                                <option value="" disabled {{ old('ship_to', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\PurchaseOrder::SHIP_TO_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('ship_to', $purchaseOrder->ship_to) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ship_to'))
                                <p class="help-block">
                                    {{ $errors->first('ship_to') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('line_items') ? 'has-error' : '' }}">
                            <label for="line_items">{{ trans('cruds.purchaseOrder.fields.line_items') }}
                                <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                            <select name="line_items[]" id="line_items" class="form-control select2" multiple="multiple">
                                @foreach($line_items as $id => $line_items)
                                    <option value="{{ $id }}" {{ (in_array($id, old('line_items', [])) || isset($purchaseOrder) && $purchaseOrder->line_items->contains($id)) ? 'selected' : '' }}>{{ $line_items }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('line_items'))
                                <p class="help-block">
                                    {{ $errors->first('line_items') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.line_items_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('qty') ? 'has-error' : '' }}">
                            <label for="qty">{{ trans('cruds.purchaseOrder.fields.qty') }}</label>
                            <input type="number" id="qty" name="qty" class="form-control" value="{{ old('qty', isset($purchaseOrder) ? $purchaseOrder->qty : '') }}" step="0.01">
                            @if($errors->has('qty'))
                                <p class="help-block">
                                    {{ $errors->first('qty') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.qty_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('unit_price') ? 'has-error' : '' }}">
                            <label for="unit_price">{{ trans('cruds.purchaseOrder.fields.unit_price') }}</label>
                            <input type="number" id="unit_price" name="unit_price" class="form-control" value="{{ old('unit_price', isset($purchaseOrder) ? $purchaseOrder->unit_price : '') }}" step="0.01">
                            @if($errors->has('unit_price'))
                                <p class="help-block">
                                    {{ $errors->first('unit_price') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.unit_price_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('tax_rate') ? 'has-error' : '' }}">
                            <label for="tax_rate">{{ trans('cruds.purchaseOrder.fields.tax_rate') }}</label>
                            <input type="number" id="tax_rate" name="tax_rate" class="form-control" value="{{ old('tax_rate', isset($purchaseOrder) ? $purchaseOrder->tax_rate : '') }}" step="0.01">
                            @if($errors->has('tax_rate'))
                                <p class="help-block">
                                    {{ $errors->first('tax_rate') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.tax_rate_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('line_total') ? 'has-error' : '' }}">
                            <label for="line_total">{{ trans('cruds.purchaseOrder.fields.line_total') }}</label>
                            <input type="number" id="line_total" name="line_total" class="form-control" value="{{ old('line_total', isset($purchaseOrder) ? $purchaseOrder->line_total : '') }}" step="0.01">
                            @if($errors->has('line_total'))
                                <p class="help-block">
                                    {{ $errors->first('line_total') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.line_total_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('shipping_cost') ? 'has-error' : '' }}">
                            <label for="shipping_cost">{{ trans('cruds.purchaseOrder.fields.shipping_cost') }}</label>
                            <input type="number" id="shipping_cost" name="shipping_cost" class="form-control" value="{{ old('shipping_cost', isset($purchaseOrder) ? $purchaseOrder->shipping_cost : '') }}" step="0.01">
                            @if($errors->has('shipping_cost'))
                                <p class="help-block">
                                    {{ $errors->first('shipping_cost') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.shipping_cost_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                            <label for="discount">{{ trans('cruds.purchaseOrder.fields.discount') }}</label>
                            <input type="number" id="discount" name="discount" class="form-control" value="{{ old('discount', isset($purchaseOrder) ? $purchaseOrder->discount : '') }}" step="0.01">
                            @if($errors->has('discount'))
                                <p class="help-block">
                                    {{ $errors->first('discount') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.discount_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('tax') ? 'has-error' : '' }}">
                            <label for="tax">{{ trans('cruds.purchaseOrder.fields.tax') }}</label>
                            <input type="number" id="tax" name="tax" class="form-control" value="{{ old('tax', isset($purchaseOrder) ? $purchaseOrder->tax : '') }}" step="0.01">
                            @if($errors->has('tax'))
                                <p class="help-block">
                                    {{ $errors->first('tax') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.tax_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('total') ? 'has-error' : '' }}">
                            <label for="total">{{ trans('cruds.purchaseOrder.fields.total') }}</label>
                            <input type="number" id="total" name="total" class="form-control" value="{{ old('total', isset($purchaseOrder) ? $purchaseOrder->total : '') }}" step="0.01">
                            @if($errors->has('total'))
                                <p class="help-block">
                                    {{ $errors->first('total') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.purchaseOrder.fields.total_helper') }}
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