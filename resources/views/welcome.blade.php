@extends('layouts.app')

@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>

            <form action="">
                <div class="form-group">
                    <textarea class="form-control" name="new-post" id="new-post" rows="5" placeholder="Type something here!"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </section>

    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3> What other people are saying... </h3></header>
            <article class="post">
                <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt perferendis perspiciatis incidunt, similique suscipit nostrum quis.
                     Aliquam labore, vitae doloremque qui ab dicta accusamus explicabo corporis quaerat, alias, magni tempore.</p>
                <div class="info">
                    Posted by ... on .. ... ....
                </div>
                <div class="interaction">
                    <a href="#">Like</a>
                    <a href="#">Dislike</a>

                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                </div>
            </article>
            <article class="post">
                    <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt perferendis perspiciatis incidunt, similique suscipit nostrum quis.
                         Aliquam labore, vitae doloremque qui ab dicta accusamus explicabo corporis quaerat, alias, magni tempore.</p>
                    <div class="info">
                        Posted by ... on .. ... ....
                    </div>
                    <div class="interaction">
                        <a href="#">Like</a>
                        <a href="#">Dislike</a>
                        
                        <a href="#">Edit</a>
                        <a href="#">Delete</a>
                    </div>
                </article>
        </div>
    </section>
@endsection