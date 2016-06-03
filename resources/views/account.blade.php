@extends('layouts.app')

@section('title')
    Account
@endsection

@section('content')
    <section class="new-post">
        <header><h3>Your Account</h3></header>
        <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ $user->username }}">
            </div>
            <div class="form-group">
                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full name" value="{{ $user->full_name }}">
            </div>
            <div class="form-group">
                <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Date of Birth" value="{{ $user->birth_date }}">
            </div>
            <div class="form-group">
                <input type="text" name="site" class="form-control" id="site" placeholder="Sites" value="{{ $user->site }}">
            </div>
            <div class="form-group">
                <input type="text" name="bio" class="form-control" id="bio" placeholder="Your bio" value="{{ $user->bio }}">
            </div>
            <div class="form-group">
                <label for="image">Image (only.jpg)</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Account</button>
            </div>
            <input type="hidden" value="{{ Session::token() }}" name="_token">
        </form>
    </section>
@endsection