@extends('layouts.topbar_users')

@section('content')
<div class="postcontent">
      <div class="userarea">
          <div>
            <img  class="profilepic2" src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="">
            <div class="postpart" style="width:430px;">
              {{ Auth::user()->firstName." ".Auth::user()->middleName." ".Auth::user()->lastName }}  
              <label class="datecreated">Posted on {{date('F j, Y', strtotime($posts->postCreatedAt))}}</label> 
            </div>  
          </div>
          
              {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $posts->postId], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                
                <div class="form-group">
                  <label for="edit_post">Edit Your Post</label>
                  {{Form::textarea('caption', $posts->postCaption, ['class' => 'form-control', 'placeholder' => 'Post something..'])}}
                </div>
                <div class="form-group">
                  <img style="width:100%" src="/storage/cover_images/{{$posts->postCoverImage}}" alt="">
                </div>
              {{Form::hidden('_method', 'PUT')}}
              {{Form::submit('Done', ['class' => 'btn btn-primary'])}}
              {!! Form::close() !!}
      </div>
</div>
@endsection
