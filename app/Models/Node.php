<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Node extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'system_uptime',
        'total_ram',
        'allocated_ram',
        'total_disk',
        'allocated_disk',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'total_ram' => 'integer',
        'total_disk' => 'integer',
        'allocated_ram' => 'integer',
        'allocated_disk' => 'integer',
        'system_uptime' => 'datetime',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];

}
