<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = "tbl_portfolio_gallery";
    protected $primaryKey = "id";

    // Define the inverse of the relationship to Portfolio
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'portfolioid', 'id'); // Assumes portfolioid is a foreign key in the gallery table
    }
}