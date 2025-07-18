<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "tbl_service";
    protected $primaryKey = "id";

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'serviceid');
    }
}
