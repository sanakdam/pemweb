@extends('layouts.app')

@section('title')
    Mgram
@endsection

<style>
    .uploads .new-post .panel-body a {
        font-family: "Ubuntu Condensed";
        font-size: 50px;
        padding-left: 18px;
    }

    .uploads .new-post .panel-body a i {
        font-size: 150px
    }
</style>

@section('content')
    <section class="uploads" id="uploads">
        <div class="new-post">
            <div class="panel-body">
                <a href="{{ route('home') }}"><i class="fa fa-tripadvisor"></i> gram</a>
            </div>
        </div>
    </section>
@endsection