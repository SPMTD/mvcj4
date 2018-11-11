@extends('layouts.app')

@section('content')
    <section class="adminPage">
        <div class="adminHeader">
            <h3>Dit is de admin pagina</h3>
        </div>




        <section class="row posts">
            <div class="col-md-6 col-md-offset-3">
                <header><h3> What other people are saying... </h3></header>
                @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id  }}">
                    <p class="postTitle">{{  $post->title  }}</p>
                    {{-- <img src="{{  route('post.get', ['image' => $post->filename])}}" --}}
                        <div class="info">
                            Posted by {{  $post->user->name  }} on {{  $post->created_at  }}
                        </div>
                        <div class="interaction">
                            @if(Auth::user())
                                <a href="#" class="like">{{  Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                                <a href="#" class="like">{{  Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You dislike this post' : 'Dislike' : 'Dislike'  }}</a>
                                @if(Auth::user() == $post->user || Auth::user()->role == '2')
                                    <a id="edit" data-toggle="modal" data-target="#edit-modal" href="#">Edit</a>
                                    <a href="{{  route('post.delete', ['post_id' => $post->id])  }}">Delete</a>
                                @endif
                            @endif
                            @if(!Auth::user())
                                <a href="#" class="like">Like</a>
                                <a href="#" class="like">Dislike</a>
                            @endif
                        </div>

                        @if(Auth::user()->role == '2')

                        @endif
                    </article>
                @endforeach
            </div>
        </section>

    </section>


    <script>
        var token = "{{ Session::token()  }}";
        var urlEdit = "{{  route('edit')  }}";      
        var urlLike = "{{  route('like')  }}";   
        var urlOnOff = "{{  route('onOff')  }}";   
    </script>
@endsection