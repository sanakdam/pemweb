@extends('layouts.app')

@section('title')
    Dashboard
@endsection

<style>
    .panel-primary .panel-footer .image img{
        max-width: 100%;
        max-height: 100%;
        display: block;
        margin: auto auto;
    }
</style>

@section('content')
    <section class="posts" id="posts">
        <header><h3></h3></header>
        @foreach($posts as $post)
            <article class="panel-primary post" data-postid="{{ $post->id }}">
                <div class="panel-heading">
                    @if(file_exists(public_path() . "/uploads/" . $post->user->username . '-' .  $post->user->id . '.jpg') == null)
                        <img style="width: 30px; height: 30px; float: left;" class="img-responsive img-circle" src="/uploads/nobody.jpg" alt="">
                    @else
                        <img style="width: 30px; height: 30px; float: left;" class="img-responsive img-circle" src="/uploads/{{ $post->user->username . '-' .  $post->user->id . '.jpg' }}" alt="">
                    @endif

                    <a style="padding-left: 10px; font-size: 18px; font-style: bold; font-family: sans-serif; color: white" href="{{ route('profile', ['username' => $post->user->username]) }}"> {{ $post->user->username }} </a>
                </div>

                <div class="panel panel-footer">
                    @if($post->image)
                        <div class="image"><img class="img-responsive" src="/posts/{{ $post->image }}" alt=""></div>
                    @else
                        <p></p>
                    @endif
                    <h4 style="float: right; color: #3173AD;">{{ $post->created_at() }}</h4><br>
                    <h4 id="post-body-{{ $post->id }}">{{ $post->body }}</h4>
                    <div class="info">
                        <p class="like_count">{{ $post->likes()->count() }} Like</p>
                    </div>

                    <div class="interaction">
                        <table class="table">
                            <thead>
                            <th>
                                <a href="{{ route('like', ['imageId' => $post->id]) }}">
                                    @if($post->isLiked())
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                        UnLike
                                    @else
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        Like
                                    @endif
                                </a>
                            </th>

                            @if(auth()->user()->id == $post->user_id)
                                <th><a class="edit" href="#" data-id="{{ $post->id }}" data-body="{{ $post->body }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></th>
                                <th><a href="{{ route('post.delete', ['post_id' => $post->id]) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></th>
                            @endif
                            <th><a class="report" data-id="{{ $post->id }}" href="#"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></th>
                            </thead>
                        </table>

                        <form action="{{ route('comment.create') }}" method="post">
                            <div class="form-group">
                                <input type="hidden" name="postId" value="{{ $post->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input class="form-control" type="text" name="comment_body" id="comment_body" placeholder="Post comment">
                            </div>
                        </form>
                    </div>

                    @foreach($post->comments as $comment)
                        <table class="table">
                            <thead>
                                <th>
                                    <div style="float: left">
                                        @if(file_exists(public_path() . "/uploads/" . $post->user->username . '-' .  $post->user->id . '.jpg') == null)
                                            <img style="width: 25px; height: 25px; float: left;" class="img-responsive img-circle" src="/uploads/nobody.jpg" alt="">
                                        @else
                                            <img style="width: 25px; height: 25px; float: left;" class="img-responsive img-circle" src="/uploads/{{ $post->user->username . '-' .  $post->user->id . '.jpg' }}" alt="">
                                        @endif

                                        <p style="padding-left: 30px"><a href="{{ route('profile', ['username' => $comment->user->username]) }}">{{ $comment->user->username  }}</a> {{$comment['comment_body'] }}</p>
                                    </div>

                                    <div style="float: right">
                                        @if(Auth::user() == $comment->user)
                                            <a class="edit" href="#" data-id="{{ $post->id }}" data-body="{{ $post->body }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                            <a href="{{ route('comment.delete', ['comment_id' => $comment->id]) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        @endif
                                    </div>
                                </th>
                            </thead>
                        </table>
                    @endforeach
                </div>
            </article>
        @endforeach
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5" placeholder="Your Post"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="report-modal">
        <div class="modal-dialog">
            <form class="modal-content" method="post" id="report-form" action="{{ url('report') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Report Post</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="post-body">Report the Post</label>
                        <textarea class="form-control" name="reason" rows="5" placeholder="Reason"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Report</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript">
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
    </script>
@endsection