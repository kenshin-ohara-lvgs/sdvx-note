<?php

namespace App\Http\Controllers;

use App\Models\UserChartMemo;
use Illuminate\Http\Request;

class UserChartMemoController extends Controller
{
    public function store(Request $request)
    {
        // UserChartMemoテーブル保存時のバリデーション
        // Laravelのバリデーションルールは細かいので要注意
        $validated = $request->validate([
            "chart_id" => ["required", "exists:charts,id"],
            "memo" => ["required", "string", "max:10000"],
            "bar_number" => ["nullable", "integer", "min:1"],
        ]);

        $validated["user_id"] = auth()->id();

        UserChartMemo::create($validated);

        return back()->with("status", "メモを投稿しました");
    }

    public function update(Request $request, UserChartMemo $memo)
    {
        // TODO: 編集権限を設定できるように
        // $this->authorize("update", $memo); //オプショナル。調べたい、、

        $request->validate([
            "memo" => ["required", "string", "max:10000"],
        ]);

        $memo->memo = $request->input("memo");
        $memo->save();

        return redirect()->back()->with("success", "メモを更新しました");
    }
}
