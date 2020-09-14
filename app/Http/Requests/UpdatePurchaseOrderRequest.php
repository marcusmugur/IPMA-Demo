<?php

namespace App\Http\Requests;

use App\PurchaseOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePurchaseOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('purchase_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'           => [
                'required',
            ],
            'supplier'       => [
                'required',
            ],
            'first_due'      => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'account_number' => [
                'required',
            ],
            'ship_to'        => [
                'required',
            ],
            'line_items.*'   => [
                'integer',
            ],
            'line_items'     => [
                'array',
            ],
        ];
    }
}
