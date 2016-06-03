@extends('layouts.app')

@section('title')
    All report
@endsection

@section('content')
    <div class="panel">
        <h2></h2>
        @foreach($reports as $report)
            <table class="table">
                <thead>
                <th>
                    <div style="float: left">
                        @if(file_exists(public_path() . "/uploads/" . $report->user->username . '-' .  $report->user->id . '.jpg') == null)
                            <img style="width: 25px; height: 25px; float: left;" class="img-responsive img-circle" src="/uploads/nobody.jpg" alt="">
                        @else
                            <img style="width: 25px; height: 25px; float: left;" class="img-responsive img-circle" src="/uploads/{{ $report->user->username . '-' .  $report->user->id . '.jpg' }}" alt="">
                        @endif

                        <p style="padding-left: 30px"><a href="{{ route('profile', ['username' => $report->user->username]) }}">{{ $report->user->username  }}</a> {{ $report->reason  }}</p>
                    </div>

                    <div style="float: right">
                        <a href="{{ route('report.delete', ['report_id' => $report->id]) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                    </div>
                </th>
                </thead>
            </table>
        @endforeach
    </div>
@endsection