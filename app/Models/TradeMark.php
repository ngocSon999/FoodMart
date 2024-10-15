<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TradeMark extends Model
{
    use HasFactory;

    protected $table = 'trade_marks';

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'description',
        'created_by',
        'image'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(TradeMark::class, 'parent_id', 'id');
    }
}
