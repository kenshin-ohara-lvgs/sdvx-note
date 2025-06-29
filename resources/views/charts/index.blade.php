{{-- resources/views/charts/index.blade.php --}}
<h1>譜面一覧</h1>

@foreach ($charts as $chart)
    <div style="margin-bottom: 1rem;">
        <strong>{{ $chart->song->name }}</strong>
        <ul>
                <li>
                    {{ $chart->difficulty }} / レベル {{ $chart->level }}
                    <a href="/charts/{{ $chart->id }}">→ 譜面メモページへ</a>
                </li>
        </ul>
    </div>
@endforeach