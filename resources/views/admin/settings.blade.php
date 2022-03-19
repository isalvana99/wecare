@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('People') }}" method="GET">
        <div class="row top_search_area" >
            <div class="col-7" style="margin:auto !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" name="selected_tile" value="People">
                    <input class="form-control" type="search" placeholder="Search" name="search" onclick="submit_form()" aria-label="Search" value="{{ $search }}" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <img src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="" class="profile_img_top">
            </div>
        </div>
        </form>
        <!-- /topbar here -->

        <!-- body here -->
        
        <!-- /body here -->
    </div>
</div>
<!-- /big container (this is for the content) -->
@endsection