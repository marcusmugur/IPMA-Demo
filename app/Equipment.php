<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Equipment extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'equipment';

    protected $appends = [
        'photo',
        'attachment',
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

    const LOCATION_SELECT = [
        'Room 1' => 'Room 1',
        'Room 2' => 'Room 2',
    ];

    protected $fillable = [
        'name',
        'line',
        'location',
        'created_at',
        'updated_at',
        'deleted_at',
        'part_number',
        'manufacture',
        'model_number',
        'serial_number',
        'contact_manufacture',
        'electric_specification',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getAttachmentAttribute()
    {
        return $this->getMedia('attachment');
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }
}
