<?php

namespace App\Http\Requests;

use App\ProductionSchedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreProductionScheduleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('production_schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'       => [
                'max:55',
                'required',
            ],
            'room'       => [
                'required',
            ],
            'line'       => [
                'required',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
