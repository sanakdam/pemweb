@extends('layouts.app')

@section('title')
    New Message
@endsection

@section('content')
    <div class="panel">
        <h3>Admin Message</h3>
        @foreach($messages as $message)
            <table class="table">
                <thead>
                <th>
                    <h4>{{ $message->message }}</h4>
                </th>
                </thead>
            </table>
        @endforeach
    </div>
@endsection