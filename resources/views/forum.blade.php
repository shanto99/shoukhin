@extends('master')
@section('title')
    Seller's Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('src/css/forum.css') }}">
@endsection

@section('maincontent')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Ask A Question</h3></header>
            <form action="{{ route('forum_save_post') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Otheers Post....</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{ $post->body }}</p>

                    <div class="info">
                        Posted by {{ $post->user->name }} on {{ $post->created_at }}
                    </div>


                    <textarea rows="2" cols="30" class="form-control comment_field" name="body" id="new-post" rows="5" placeholder="Add a Comment"></textarea>
                    <button style="margin-top: 10px;" type="button" class="btn btn-success comment">Comment</button>
                    <div class="interaction">
                        <a href="" class="like"></a> |
                        <a href="#" class="like"></a>
                        @if(Auth::user() == $post->user)
                            |
                            <a href="#" class="edit">Edit</a> |
                            <a href="">Delete</a>
                        @endif
                    </div>



                    <details>
                        <summary>Show Comments....</summary>
                        @foreach($post->comment as $comment)
                            <p style="margin-left: 100px;">{{ $comment->body }}</p>
                        <div class="info">
                            <p style="margin-left: 150px;">Comment by: {{ $comment->user->name }} On {{ $comment->created_at }}</p>
                        </div>
                        <p>{{ sizeof($comment->likes) }} | Likes | {{sizeof($comment->dislikes)}} | Dislikes</p>
                        @if(!in_array($comment->id, $liked_c))
                            <a href="{{ route('do_like',['comment_id'=>$comment->id]) }}">Like</a>
                        @endif
                        @if(!in_array($comment->id, $disliked_c))
                            <a href="{{ route('do_dislike',['comment_id'=>$comment->id]) }}">Dislike</a>
                        @endif
                        
                        {{-- @foreach($comment->likes as $like)
                           <p>{{ sizeof($comment->likes) }} | Likee</p>
                        @endforeach --}}

                        @endforeach
                    </details>





                </article>
            @endforeach
        </div>
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
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        var commentUrl = "{{ route('comment') }}";
        var token = '{{ Session::token() }}';
    </script>

@endsection


@section('script')


    <script src="{{ url('src/js/forum.js') }}">



@endsection
