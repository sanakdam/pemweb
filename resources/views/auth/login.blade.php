@extends('layouts.app')

@section('title')
    SignIn
@endsection

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h3>Sign In</h3>
            <form role="form" action="{{ url('/login') }}" method="post">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="sr-only" for="email">Email</label>

                    <div>
                        <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="sr-only" for="password">Password</label>

                    <input class="form-control" type="password" name="password" id="password" placeholder="Password">

                    <div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">
                        <i class="fa fa-btn fa-sign-in"></i> SignIn
                    </button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
            </form>
        </div>
    </div>
@endsection