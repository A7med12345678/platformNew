@extends('layouts.adminApp')
@section('title', 'Chat Admin : ' . $Global_platFormName)
@section('styles')
<link href="{{ asset('admin-css/chat.css') }}" rel="stylesheet">
@endsection
@section('content')

<!-- Content Start -->

<div class="container p-3">
    <h1 class="pt-5">Admin chat</h1>

    <div class="chat border" style="border-radius: 25px;">
        @isset($chat)
        @forelse ($chat as $item)
        <div class="message {{ $item->sender_id === Auth::user()->id ? 'message-right' : 'message-left' }}">
            <div class="message-sender">{{ $item->sender_name }}</div>
            <div class="message-meta">{{ $item->created_at }}</div>
            <div class="message-content font-weight-bold">{{ $item->content }}</div>
        </div>
        @empty
        <div class="text-center p-4">
            No Messages found.
        </div>
        @endforelse
        @endisset
        <div class="">
            <form id="admin-form" method="POST" action="{{ route('Chat.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="msg_content">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection
