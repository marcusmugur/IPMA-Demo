<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ProductionSchedule extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'production_schedules';

    protected $appends = [
        'add_file',
        'attachment',
    ];

    protected $dates = [
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ROOM_SELECT = [
        'room 1' => 'room 1',
        'room 2' => 'room 2',
        'room 3' => 'room 3',
    ];

    const LINE_SELECT = [
        'line 1' => 'line 1',
        'line 2' => 'line 2',
        'line 3' => 'line 3',
    ];

    protected $fillable = [
        'name',
        'room',
        'line',
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
        'production_description',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getAttachmentAttribute()
    {
        $files = $this->getMedia('attachment');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }

    public function getAddFileAttribute()
    {
        return $this->getMedia('add_file')->last();
    }
}
