<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxCategory extends Model
{
    /** @use HasFactory<\Database\Factories\TaxCategoryFactory> */
    use HasFactory;
    use SoftDeletes;
        
    protected $fillable = ['name', 'is_taxable'];

    protected $casts = ['is_taxable' => 'boolean'];
}
