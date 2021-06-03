<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ToDo
 * @package App\Models
 */
class Providers extends Model
{
    protected $table = 'providers';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'url'
    ];
    public $incrementing = false;
}
