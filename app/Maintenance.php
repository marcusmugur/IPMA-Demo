<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Maintenance extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'maintenances';

    protected $appends = [
        'attachment',
        'file_attachment',
    ];

    const LINE_SELECT = [
        'Line 1' => 'Line 1',
        'Line 2' => 'Line 2',
    ];

    const ASSIGNED_TO_SELECT = [
        'user 1' => 'user 1',
        'user 2' => 'user 2',
    ];

    const LOCATION_SELECT = [
        'location 1' => 'location 1',
        'location 2' => 'location 2',
    ];

    protected $dates = [
        'first_due',
        'created_at',
        'updated_at',
        'deleted_at',
        'next_due_date',
    ];

    const EQUIPMENT_SELECT = [
        'equipment 1' => 'equipment 1',
        'equipment 2' => 'equipment 2',
    ];

    const TYPE_SELECT = [
        'Maintenance' => 'Maintenance',
        'Project'     => 'Project',
        'QC'          => 'QC',
    ];

    const REPEATS_SELECT = [
        'Never'   => 'Never',
        'Daily'   => 'Daily',
        'Weekly'  => 'Weekly',
        'Monthly' => 'Monthly',
        'Yearly'  => 'Yearly',
    ];

    protected $fillable = [
        'type',
        'name',
        'line',
        'repeats',
        'location',
        'equipment',
        'first_due',
        'created_at',
        'updated_at',
        'deleted_at',
        'assigned_to',
        'description',
        'next_due_date',
        'is_outsourced',
        'qc_verification',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getFirstDueAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFirstDueAttribute($value)
    {
        $this->attributes['first_due'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getNextDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setNextDueDateAttribute($value)
    {
        $this->attributes['next_due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFileAttachmentAttribute()
    {
        return $this->getMedia('file_attachment');
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
}
