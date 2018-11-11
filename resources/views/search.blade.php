@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container">
            @if(isset($details))
            <p> The search results for your query <b> {{ $query  }} </b> are : </p>
            <h3>Sample post details</h3>
            @foreach ($details as $p)
            <article class="post" data-postid="{{ $p->id  }}">
                    <p class="postTitle">{{  $p->title  }}</p>
                    {{-- <img src="{{  route('post.get', ['image' => $post->filename])}}" --}}
                        <div class="info">
                            Posted by {{  $p->user->name  }} on {{  $p->created_at  }}
                        </div>
                        <div class="interaction">
                            @if(Auth::user())
                                <a href="#" class="like">{{  Auth::user()->likes()->where('post_id', $p->id)->first() ? Auth::user()->likes()->where('post_id', $p->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                                <a href="#" class="like">{{  Auth::user()->likes()->where('post_id', $p->id)->first() ? Auth::user()->likes()->where('post_id', $p->id)->first()->like == 0 ? 'You dislike this post' : 'Dislike' : 'Dislike'  }}</a>
                                @if(Auth::user() == $p->user || Auth::user()->role == '2')
                                    <a id="edit" data-toggle="modal" data-target="#edit-modal" href="#">Edit</a>
                                    <a href="{{  route('post.delete', ['post_id' => $p->id])  }}">Delete</a>
                                @endif
                            @endif
                            @if(!Auth::user())
                                <a href="#" class="like">Like</a>
                                <a href="#" class="like">Dislike</a>
                            @endif
                        </div>
                    </article>
            @endforeach
            @endif
    </section>
@endsection