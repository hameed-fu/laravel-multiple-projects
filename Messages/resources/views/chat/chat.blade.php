
@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <chat-component :user="{{ auth()->user() }}"></chat-component>
</div>
@endsection 