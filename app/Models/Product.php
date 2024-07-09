<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'active',
    ];

    // Relationships

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategories(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'product_sub_category', 'product_id', 'sub_category_id');
    }

    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class, 'product_treatment', 'product_id', 'treatment_id');
    }

}
