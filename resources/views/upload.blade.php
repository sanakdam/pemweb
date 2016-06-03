@extends('layouts.app')

@section('title')
    Uploads
@endsection

@section('content')
    <section class="uploads" id="uploads">
        <div class="new-post">
            <div class="panel-body">
                <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="sr-only" for="image">Image (only.jpg)</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <div class="form-group">
                        <img src="" id="image-preview" class="img-thumbnail" style="display: none;">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="body" placeholder="Caption"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Create Post</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        $(document).ready(function(){
            function readImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image-preview').show();
                        $('#image-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").on('change', function(){
                readImage(this);
            });
        });
    </script>
@endsection