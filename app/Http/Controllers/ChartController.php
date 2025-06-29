<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chart;

class ChartController extends Controller
{
    public function index()
    {
        $charts = Chart::with('song')->get();
        return view('charts.index', compact('charts'));
    }

    public function show(Chart $chart)
    {
        $chart->load(['song', 'memos.user']); //TODO: ここのメモの整理
        $userId = auth()->id();
        $mainMemo = $chart->getMainMemosForUser($userId);

        return view('charts.show', compact('chart', "mainMemo"));
    }
}
