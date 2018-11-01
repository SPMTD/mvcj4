@extends('layouts.app')

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>

        <form action="{{  route('post.create')  }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" name="title" id="new-post" placeholder="Title">
                    <label for="image">Upload an image here!</label> 
                    <input class="form-control" type="file" name="filename" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <input type="hidden" value="{{ Session::token() }} " name="_token">
            </form>
        </div>
    </section>

    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3> What other people are saying... </h3></header>
            @foreach($posts as $post)
                <article class="post">
                <p class="postTitle">{{  $post->title  }}</p>
                    <div class="info">
                        Posted by {{  $post->user->name  }} on {{  $post->created_at  }}
                    </div>
                    <div class="interaction">
                        <a href="#">Like</a>
                        <a href="#">Dislike</a>
                        @if(Auth::user() == $post->user)
                            <a id="edit" data-toggle="modal" data-target="#edit-modal" href="#">Edit</a>
                            <a href="{{  route('post.delete', ['post_id' => $post->id])  }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <div class="modal" tabindex="-1" role="dialog" id="edit-modal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Post</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                      <label for="post-title">Edit the post</label>
                      <input class="form-control" name="title" id="post-title">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

@endsection