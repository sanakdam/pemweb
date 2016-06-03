@extends('layouts.app')

@section('title')
    Message
@endsection

@section('content')
    <section class="message">
        <div class="new-post">
            <div class="panel-body">
                <form action="{{ route('message.send') }}" method="post">
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <textarea class="form-control" name="message" id="message" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Message</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </section>
@endsection