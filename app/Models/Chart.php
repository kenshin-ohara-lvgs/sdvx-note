<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chart extends Model
{
    use HasFactory;

    protected $fillable = [
        'song_id',
        'difficulty',
        'level',
    ];

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }

    public function memos(): HasMany
    {
        return $this->hasMany(UserChartMemo::class);
    }

    public function getMainMemosForUser($userId): Collection
    {
        return $this->memos()->fetchMainMemo($userId)->get();
    }
}
