<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * The products that belong to the Category
     *
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
