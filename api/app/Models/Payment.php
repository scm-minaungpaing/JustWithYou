<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'type', 'ph_no'];

    protected $appends = [ 'adminName' ];

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function getAdminNameAttribute()
    {
        return Admin::find($this->admin_id)->name;
    }
}
