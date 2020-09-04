@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                        @if(Session::has('success'))
                            <div class="col-12 alert alert-success justify-content-center d-flex">
                                <p class="text-center" > {{Session::get('success')}}</p>
                            </div>
                        @endif

                        @if(isset($posts) && $posts -> count() > 0)
                            @foreach($posts as $post)
                                <div class="card-body card" style="margin: 10px 0px">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <h3 class="card-title card-header"> {{$post -> title}} - @if(Auth::id() == $post->user->id)   <strong class="text-info">المالك</strong>  @endif</h3>
                                    <br>
                                    {{$post -> body}}

                                    <br>
                                    <br>
                                        <div class="card">
                                            <h5 class="card-header"> التعليقات <strong class="text-info" @if($post->comments()->count()==0) hidden @endif>{{$post->comments()->count()}}</strong> </h5>
                                            @if($post->comments()->count()>0)
                                                @foreach($post-> comments  as $_comment)
                                                    <p class="text-center"> {{$_comment->id}} - {{$_comment -> comment}}</p>
                                                @endforeach
                                            @endif
                                        </div>

                                    <br><br>
                                    <form method="POST" action="{{route('comment.save')}}"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="post_id" value="{{$post -> id}}">
                                         @if(Auth::id() != $post -> user -> id)
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="post_content">
                                                @error('name_ar')
                                                <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                                <br>
                                            <button type="submit" class="btn btn-primary">أضافه ردك</button>
                                            </div>
                                        @endif
                                    </form>


                                </div>
                            @endforeach
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
