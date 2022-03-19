@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('Logs') }}" method="GET">
        <div class="row top_search_area" >
            <div class="col-7" style="margin:auto !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" name="selected_tile" value="Logs">
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
              
            <div class="row inner_main_con">
            <div class="container tab_outer_con">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="title_con">Admin Records</label>
                    </div>
                </div>
                <div class="row tab_body_row" >
                <div class="container tab_body_con" >
                    <div class="row" >
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="width:100px !important;">#</th>
                                <th scope="col">Admin Logs</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $cnt=0; @endphp
                        @if(count($vars) > 0)
                        @foreach($vars as $var)
                            <tr>
                                <td>@php echo $cnt+=1; @endphp</td>
                                <td>
                                    {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
                                    
                                    @if($var->adminlogDescription == "VERIFIED")
                                    <b style="font-weight:bold;">verified</b>
                                    @elseif($var->adminlogDescription == "BANNED")
                                    <b style="font-weight:bold;">banned</b>
                                    @elseif($var->adminlogDescription == "DELETED")
                                    <b style="font-weight:bold;">deleted</b>
                                    @elseif($var->adminlogDescription == "REPLIED")
                                    <b style="font-weight:bold;">replied</b>
                                    @elseif($var->adminlogDescription == "REVIEWED")
                                    <b style="font-weight:bold;">reviewed</b>
                                    @elseif($var->adminlogDescription == "PROMOTED")
                                    <b style="font-weight:bold;">made as admin</b>
                                    @endif

                                    @if($var->adminlogUserId != NULL)
                                    <b style="font-weight:bold;">USER #: {{$var->adminlogUserId}}</b>
                                    @elseif($var->adminlogPostId != NULL)
                                    <b style="font-weight:bold;">POST #: {{$var->adminlogPostId}}</b>
                                    @elseif($var->adminlogCommentId != NULL)
                                    <b style="font-weight:bold;">COMMENT #: {{$var->adminlogCommentId}}</b>
                                    @endif
                                    
                                    at {{date("Y-m-d", strtotime($var->adminlogCreatedAt))." ".date("h:i A", strtotime($var->adminlogCreatedAt))}}
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="2" style="text-align:center">No Record.</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            </div>

        <!-- /body here -->
    </div>
</div>
<!-- /big container (this is for the content) -->
@endsection