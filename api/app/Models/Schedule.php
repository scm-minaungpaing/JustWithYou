<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public $primaryKey = 'id';

    protected $fillable = [
        'date_id',
        'start_time',
        'end_time',
    ];
}
