<?php

namespace App\Http\Requests;

use App\Maintenance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreMaintenanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('maintenance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'type'          => [
                'required',
            ],
            'name'          => [
                'required',
            ],
            'location'      => [
                'required',
            ],
            'first_due'     => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'next_due_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
