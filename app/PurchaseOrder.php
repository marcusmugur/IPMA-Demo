<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    public $table = 'purchase_orders';

    const SHIP_TO_SELECT = [
        'My Address' => 'My Address',
    ];

    protected $dates = [
        'first_due',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PROJECT_NR_SELECT = [
        'Project 1' => 'Project 1',
        'Project 2' => 'Project 2',
    ];

    const SUPPLIER_SELECT = [
        'Supplier 1' => 'Supplier 1',
        'Supplier 2' => 'Supplier 2',
    ];

    const EQUIPMENT_SELECT = [
        'equipment 1' => 'equipment 1',
        'equipment 2' => 'equipment 2',
    ];

    const ACCOUNT_NUMBER_SELECT = [
        'Maintenance' => 'Maintenance',
        'QC'          => 'QC',
        'Project'     => 'Project',
    ];

    protected $fillable = [
        'tax',
        'qty',
        'memo',
        'name',
        'total',
        'ship_to',
        'discount',
        'supplier',
        'tax_rate',
        'first_due',
        'equipment',
        'updated_at',
        'created_at',
        'unit_price',
        'project_nr',
        'line_total',
        'deleted_at',
        'shipping_cost',
        'account_number',
    ];

    public function getFirstDueAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFirstDueAttribute($value)
    {
        $this->attributes['first_due'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function line_items()
    {
        return $this->belongsToMany(Asset::class);
    }
}
