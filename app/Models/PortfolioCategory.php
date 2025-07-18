<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    use HasFactory;
    protected $table = "tbl_portfolio_category";
    protected $primary_key = "id";
    public function portfolio()
    {
        return $this->hasMany(Portfolio::class);
    }
}
