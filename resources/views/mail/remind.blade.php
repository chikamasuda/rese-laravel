@extends('layouts.app')

@section('content')

<p>{{ $reservation->users->name }}様</p>

<p>以下の内容のご予約が当日となりましたのでお知らせします。<br>
  ご来店をお待ちしております。</p>

---------------------------------------------

<p>【店名】{{ $reservation->shops->name }}</p>

<p>【日時】{{ $reservation->date->format('Y年m月d日 H:i') }}</p>

<p>【人数】{{ $reservation->number }}人</p>

---------------------------------------------

@endsection