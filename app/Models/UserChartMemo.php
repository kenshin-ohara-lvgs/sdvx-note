<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserChartMemo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chart_id',
        'memo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // カスタムスコープの定義
    // TODO: カスタムスコープのメリットが実感的理解できてないので、同様の実装を別の形で行ってメリットを考えてみる
    public function scopeFetchMainMemo($query, $userId)
    {
        return $query->where("user_id", $userId)->whereNull("bar_number");
    }
}
