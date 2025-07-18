<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = "tbl_contact";
    protected $primaryKey = "id";

    protected $fillable = ['name', 'email', 'phone', 'message', 'serviceid', 'status'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'serviceid');
    }
}
