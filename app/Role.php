<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'title',
        'user_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const USER_TYPE_SELECT = [
        'user'       => 'user',
        'management' => 'management',
        'super_user' => 'super_user',
        'admin'      => 'admin',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
