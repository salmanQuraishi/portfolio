<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = "tbl_portfolio";
    protected $primary_key = "id";
    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'categoryid');
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'portfolioid', 'id');
    }
}
