@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('Users Leaderboards') }}" method="GET">
        <div class="row top_search_area" >
            <div class="col-7" style="margin:auto !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" name="selected_tile" value="Users Leaderboards">
                    <input type="hidden" name="selectbarangay" value="{{$selectbarangay}}">
                    <input type="hidden" name="selectcity" value="{{$selectcity}}">
                    <input type="hidden" name="selectprovince" value="{{$selectprovince}}">
                    <input class="form-control" type="search" style="display: none;" placeholder="Search" name="search" onclick="submit_form()" aria-label="Search" value="{{ $search }}" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" style="display: none;" type="submit">Search</button>
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
        <div class="row">
            <div class="container lead_main_con">
                <div class="row">
                    <label for="" class="con_title">Learderboards</label>
                </div>
                <form action="{{route('Users Leaderboards')}}" method="GET">
                <input type="hidden" name="selected_tile" value="Users Leaderboards">
                <input type="hidden" name="search" value="{{$search}}">
                <div class="row select_area">
                    <div class="col-4">
                        <select class="form-select select_con" aria-label="Default select example" style="padding-bottom:2%;" onchange="this.form.submit()" name="selectbarangay">
                            <option value="{{$selectbarangay == '' ? 'All' : $selectbarangay}}" selected hidden>{{$selectbarangay == '' ? 'All' : $selectbarangay}}</option>
                            @if($selectcity == "All")
                              <option value="All">--- Please select city first to view list ---</option>
                            @elseif($selectcity == "Mandaue")
                              <option value="All">--- Select All ---</option>
                              @foreach($b1 as $b)
                              <option value="{{$b}}">{{$b}}</option>
                              @endforeach
                            @elseif($selectcity == "Lapu-lapu")
                              <option value="All">--- Select All ---</option>
                              @foreach($b2 as $b)
                              <option value="{{$b}}">{{$b}}</option>
                              @endforeach
                            @else
                            @endif
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select select_con" aria-label="Default select example" style="padding-bottom:2%;" onchange="this.form.submit()" name="selectcity">
                            <option value="{{$selectcity == '' ? 'All' : $selectcity}}" selected hidden>{{$selectcity == '' ? 'All' : $selectcity}}</option>
                            <option value="All">--- Select All ---</option>
                            <option value="Mandaue">Mandaue</option>
                            <option value="Lapu-lapu">Lapu-lapu</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select select_con" aria-label="Default select example" style="padding-bottom:2%;" onchange="this.form.submit()" name="selectprovince"> 
                            <option value="{{$selectprovince}}" selected hidden>{{$selectprovince == '' ? 'Cebu' : $selectprovince}}</option>
                            <option value="Cebu">Cebu</option>
                        </select>
                    </div>
                </div>
                </form>
                <div class="row header_con">
                    <div class="col-2">Rank</div>
                    <div class="col-7">Name</div>
                    <div class="col-3">Amount</div>
                </div>
                <div class="row">
                    <div class="container lead_inner_con">
                      @php
                        $a = 1;
                      @endphp
                      @if(count($vars) > 0)
                      @foreach($vars as $var)
                      @if($var->accountType != "RECEPIENT")
                      <div class="row row_user_lead"> <!-- leaderboards row -->
                          <div class="col-2 user_place">
                            @if($a == 1)
                              {{$a}}st
                            @elseif($a == 2)
                              {{$a}}nd
                            @elseif($a == 3)
                              {{$a}}rd
                            @else
                              {{$a}}th
                            @endif
                            @php
                              $a++
                            @endphp
                          </div>
                          <div class="col-7 user_name_lead">
                            {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
                          </div>
                          <div class="col-3 user_donate">
                            Php {{number_format((float)$var->amountGiven, 2, '.', '')}}
                          </div>
                      </div> <!-- leaderboards end -->
                      @endif
                      @endforeach
                      @else
                      <div class="row row_user_lead"> <!-- leaderboards row -->
                          <div class="col-12 user_name_lead">
                            No Available Record as of this moment.
                          </div>
                      </div> <!-- leaderboards end -->
                      @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /body here -->
    </div>
</div>
<!-- /big container (this is for the content) -->
@endsection