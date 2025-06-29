<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $chart->song->name }} - {{ $chart->difficulty }} / Lv{{ $chart->level }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: sans-serif; padding: 2rem; max-width: 720px; margin: auto; background-color: #f9f9f9; }
        .blur-box {
            filter: blur(4px);
            opacity: 0.5;
            pointer-events: none;
        }
        .overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.85);
        }
        .alert {
            padding: 1rem;
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 4px;
            color: #856404;
        }
    </style>
</head>
<body>

    <h1>{{ $chart->song->name }} - {{ $chart->difficulty }} / Lv{{ $chart->level }}</h1>

    <p><strong>BPM:</strong> {{ $chart->bpm ?? '不明' }}</p>
    <p><strong>作者:</strong> {{ $chart->song->artist ?? '不明' }}</p>

    <hr>

    @auth
        <h2>譜面メモ: メイン</h2>
        <!-- ここの取得処理を、bar_numberがnullのものを取得するように変える -->
        @if ($mainMemo->isEmpty())
            <p>この譜面にはまだメモがありません。</p>
        @else
            <!-- getでcollection取得してしまってるので単一取得 -->
            <p>
                {{ $mainMemo[0]->memo }}
            </p>
        @endif

        <!-- TODO: edit機能に変更する -->
        <form action="{{ route('memos.store') }}" method="POST" style="margin-top: 1rem;">
            @csrf
            <textarea name="memo" rows="3" cols="50" placeholder="メモを入力してください..."></textarea><br>
            <input type="hidden" name="chart_id" value="{{ $chart->id }}">
            <button type="submit">メモを投稿</button>
        </form>


        <h2>譜面メモ（小節別）</h2>

        @if ($chart->memos->isEmpty())
            <p>この譜面にはまだメモがありません。</p>
        @else
            <ul>
                @foreach ($chart->memos as $memo)
                    <li>
                        {{ $memo->memo }}（{{ $memo->user->name ?? '匿名ユーザー' }}）
                    </li>
                @endforeach
            </ul>
        @endif
        <div>
            開始小節と終了小節、優先度、の欄がある
            小節別のメモ機能を実装する予定（リリース後だが）
        </div>

    @else
        <div style="position: relative; margin-top: 2rem;">
            <div class="blur-box">
                <h2>譜面メモ</h2>
                <p>ログインするとこの譜面へのメモを確認・投稿できます。</p>
                <ul>
                    <li>・リズム難に注意</li>
                    <li>・後半のトリルが厄介</li>
                </ul>
            </div>
            <div class="overlay">
                <div class="alert">
                    メモ機能を利用するには <a href="{{ route('login') }}">ログイン</a> または <a href="{{ route('register') }}">ユーザー登録</a> が必要です。
                </div>
            </div>
        </div>
    @endauth

</body>
</html>