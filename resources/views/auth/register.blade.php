@extends('layouts.app')

@section('title')
    SignUp
@endsection

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h3>Sign Up</h3>
            <form role="form" action="{{ url('/register') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label class="sr-only" for="username">Username</label>

                    <div>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username" value="{{ old('username') }}">

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

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

                    <div>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="sr-only">Confirm Password</label>

                    <div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">
                        <i class="fa fa-btn fa-user"></i> Register
                    </button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
            </form>
        </div>
    </div>
@endsection
