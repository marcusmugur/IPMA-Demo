<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Asset extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'assets';

    protected $appends = [
        'photos',
        'manuals',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const LINE_SELECT = [
        'Line 1' => 'Line 1',
        'Line 2' => 'Line 2',
    ];

    const SUPPLIERS_SELECT = [
        'Supplier 1' => 'Supplier 1',
        'Supplier 2' => 'Supplier 2',
    ];

    protected $fillable = [
        'line',
        'name',
        'notes',
        'suppliers',
        'unit_price',
        'created_at',
        'updated_at',
        'deleted_at',
        'location_id',
        'manufacturer',
        'model_number',
        'serial_number',
        'inventory_items',
        'current_quantity',
    ];

    public static function boot()
    {
        parent::boot();
        Asset::observe(new \App\Observers\AssetsHistoryObserver);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function assetsHistories()
    {
        return $this->hasMany(AssetsHistory::class, 'asset_id', 'id');
    }

    public function purchaseOrders()
    {
        return $this->belongsToMany(PurchaseOrder::class);
    }

    public function location()
    {
        return $this->belongsTo(AssetLocation::class, 'location_id');
    }

    public function getManualsAttribute()
    {
        return $this->getMedia('manuals');
    }

    public function getPhotosAttribute()
    {
        return $this->getMedia('photos');
    }
}
