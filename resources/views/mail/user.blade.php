@extends('layouts.app')

@section('content')

<p>{!! nl2br(e($content)) !!}</p>

@endsection