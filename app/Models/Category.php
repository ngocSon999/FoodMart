<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trademark';
    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function child(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
