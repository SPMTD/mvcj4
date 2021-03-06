@extends('layouts.app')

@section('title')
    Account settings
@endsection

@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your account settings</h3></header>
            <form action="{{  route('settings.save')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{  $user->name  }}" id="name">
                </div>
                <div class="form-group"> 
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value="{{  Session::token()  }}" name="_token">
            </form>
        </div>
    </section>
    @if(Storage::disk('local')->hasFile($user->id . '_' . 'me.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{  route('settings.image', ['filename' => $user->id . '_' . 'me.jpg'])  }}">
            </div>
        </section>
    @endif
@endsection