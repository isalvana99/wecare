@extends('layouts.app')

@section('content')
<a href="/users/{{Auth::user()->id}}/edit"><button>Edit Profile</button></a>
<h1>Your profile</h1>
<h1>{{$posts->firstname." ".$posts->mi." ".$posts->lastname}}</h1>
@endsection