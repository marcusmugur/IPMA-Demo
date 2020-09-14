<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\\App\\Maintenance',
            'date_field' => 'first_due',
            'prefix'     => 'name',
            'field'      => 'line',    
            'line'       => 'equipment',
            'route'      => 'admin.maintenances.edit',
        ],
        [
            'model'      => '\\App\\PurchaseOrder',
            'date_field' => 'first_due',
            'prefix'     => 'supplier',
            'field'      => 'name',            
            'line'       => 'equipment',
            'route'      => 'admin.purchase-orders.edit',
        ],
        [
            'model'      => '\\App\\ProductionSchedule',
            'date_field' => 'start_time',
            'prefix'     => 'name',
            'field'      => 'room',            
            'line'       => 'line',
            'route'      => 'admin.production-schedules.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($model->{$source['prefix']} . " - " . $model->{$source['field']} . " - " . $model->{$source['line']}),                    
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];                
            }
           
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
