<p>{!!nl2br(htmlspecialchars($users))!!}様<br>
  以下の内容のご予約が近づきましたのでお知らせします。</p>

<dl>
  <dt>店名</dt>
  <dd>{!!nl2br(htmlspecialchars($shops))!!}</dd>

  <dt>日時</dt>
  <dd>{!!nl2br(htmlspecialchars(Str::substr($date, 8, 1)))!!}月{!!nl2br(htmlspecialchars(Str::substr($date, 10, 2)))!!}日{!!nl2br(htmlspecialchars(Str::substr($date, 13, 2)))!!}時
  </dd>

  <dt>人数</dt>
  <dd>{!!nl2br(htmlspecialchars($number))!!}人</dd>
</dl>