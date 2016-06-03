@extends('layouts.app')

@section('title')
    All user
@endsection

@section('content')
    <div class="panel">
        <h2></h2>
        <a href="{{ route('user-add') }}" type="submit" class="btn btn-primary form-control"><i class="fa fa-user-plus" aria-hidden="true"></i> Add User</a>

        @foreach($users as $user)
            <table class="table">
                <thead>
                <th>
                    <div style="float: left">
                        @if(file_exists(public_path() . "/uploads/" . $user->username . '-' .  $user->id . '.jpg') == null)
                            <img style="width: 25px; height: 25px; float: left;" class="img-responsive img-circle" src="/uploads/nobody.jpg" alt="">
                        @else
                            <img style="width: 25px; height: 25px; float: left;" class="img-responsive img-circle" src="/uploads/{{ $user->username . '-' .  $user->id . '.jpg' }}" alt="">
                        @endif

                        <p style="padding-left: 30px"><a href="{{ route('profile', ['username' => $user->username]) }}">{{ $user->username  }}</a></p>
                    </div>

                    <div style="float: right">
                        <a href="{{ route('profile', ['username' => $user->username]) }}"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                        <a href="{{ route('user-edit', ['id' => $user->id, 'username' => $user->username]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                        <a href="{{ route('user.delete', ['user_id' => $user->id]) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                    </div>
                </th>
                </thead>
            </table>
        @endforeach
    </div>
@endsection