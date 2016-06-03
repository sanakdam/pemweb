@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content')
        <section class="text-center">
            @foreach($users as $user)
            <div class="panel panel-footer">
                <h2><a href="{{ route('profile', ['username' => $user->username]) }}">{{ $user->username }}</a></h2>
                <p>
                    @if(file_exists(public_path() . "/uploads/" . $user->username . '-' .  $user->id . '.jpg') == null)
                        <img style="width: 300px; height: 300px;" class="img-responsive img-thumbnail img-circle" src="/uploads/nobody.jpg" alt="">
                    @else
                        <img style="width: 300px; height: 300px;" class="img-responsive img-thumbnail img-circle" src="/uploads/{{ $user->username . '-' .  $user->id . '.jpg' }}" alt="">
                    @endif
                </p>

                @if(Auth::user()->username != $user->username )
                    <a href="{{ url('/follow/' . $user->id) }}" class="btn btn-primary">
                        {{ $user->isFollowed() ? 'Unfollow' : 'Follow' }}
                    </a>
                @endif
                <h1>{{ $user->full_name }}</h1>

                @if($user->birth_date != '0000-00-00')
                    <h4>{{ $user->birth_date }}</h4>
                @else
                    <h4></h4>
                @endif

                <h4><a href="{{ $user->site }}"> {{ $user->site }} </a></h4>
                <h4>{{ $user->bio }}</h4>
            </div>
            @endforeach
        </section>
@endsection