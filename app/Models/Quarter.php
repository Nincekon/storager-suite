<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quarter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'town_id',
        'code',
        'title',
    ];

    public function town(): BelongsTo
    {
        return $this->belongsTo(Town::class);
    }

    public function residences(): HasMany
    {
        return $this->hasMany(Residence::class);
    }
}
