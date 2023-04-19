<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Town extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'code',
        'title',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function quarters(): HasMany
    {
        return $this->hasMany(Quarter::class);
    }
}
