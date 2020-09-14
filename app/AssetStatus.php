<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetStatus extends Model
{
    use SoftDeletes;

    public $table = 'asset_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        'open'    => 'open',
        'pending' => 'pending',
        'close'   => 'close',
    ];

    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function assetsHistories()
    {
        return $this->hasMany(AssetsHistory::class, 'status_id', 'id');
    }
}
