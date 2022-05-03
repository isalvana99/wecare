@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('Manage Reports 2') }}" method="GET">
        <div class="row top_search_area" >
            <div class="col-7" style="margin:auto !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" name="selected_tile" value="Manage Reports">
                    <input class="form-control" type="search" placeholder="Search" name="search" onclick="submit_form()" aria-label="Search" value="{{ $search }}" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" style="height:39px;margin-top:-1px;">Search</button>
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
                    <label for="" class="title_con">Reports</label>
                </div>
                <div class="row tab_head_row">
                    <div class="col-2 ">
                        <form action="{{route('Reports')}}" method="GET"><input type="hidden" name="selected_tile" value="Reports"><button class="normal_tab" style="width:100%;">User</button></form>
                    </div>
                    <div class="col-2">
                        <button class="selected_tab" style="width:100%;" disabled>Post</button>
                    </div>
                    <div class="col-2">
                        <form action="{{route('Manage Reports 3')}}" method="GET"><input type="hidden" name="selected_tile" value="Reports"><button class="normal_tab" style="width:100%;">Comment</button></form>
                    </div>
                </div>
                <div class="row tab_body_row" >
                    <div class="container tab_body_con" >
                        <div class="row" >
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Posted By</th>
                                        <th scope="col">Caption</th>
                                        <th scope="col">Reported By</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $a = 1; @endphp
                                    @if(count($vars) > 0)
                                    @foreach($vars as $var)
                                    <tr>
                                        <th scope="row">{{$a}}</th>
                                        @php $a++ @endphp

                                        <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>

                                        <td>{{$var->postCaption}}</td>

                                        @if(count($person) > 0)
                                        @foreach($person as $var2)
                                        @if($var2->reportId == $var->reportId)
                                        <td>{{$var2->firstName." ".$var2->middleName." ".$var2->lastName." ".$var2->orgName}}</td>
                                        @endif
                                        @endforeach
                                        @endif

                                        <td>{{$var->reportDescription}}</td>
                                        <td>{{$var->reportStatus}}</td>
                                        <td class="center">
                                            <button class="btn_view" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-{{$var->reportId}}">Review</button>
                                            <button class="btn_delete" data-toggle="modal" data-target=".bd-example-modal-sm-{{$var->reportId}}">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    
                                    @if(count($thisperson) > 0)
                                    @foreach($thisperson as $var)
                                    <tr>
                                        @if(count($varse) > 0)
                                        @foreach($varse as $var2)
                                        @if($var2->reportId == $var->reportId)
                                        <th scope="row">{{$a}}</th>
                                        @php $a++ @endphp

                                        <td>{{$var2->firstName." ".$var2->middleName." ".$var2->lastName." ".$var2->orgName}}</td>

                                        <td>{{$var2->postCaption}}</td>
                                        
                                        <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>
                                        

                                        <td>{{$var2->reportDescription}}</td>
                                        <td>{{$var2->reportStatus}}</td>
                                        <td class="center">
                                            <button class="btn_view" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-{{$var->reportId}}">Review</button>
                                            <button class="btn_delete" data-toggle="modal" data-target=".bd-example-modal-sm-{{$var->reportId}}">Delete</button>
                                        </td>
                                        @endif
                                        @endforeach
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endif

                                    @if(count($vars) == 0 && count($thisperson) == 0)
                                    <tr>
                                        <td colspan="7" style="text-align:center;">No record.</td>
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
        <!-- review modal -->
        @if(count($vars) > 0)
        @foreach($vars as $var)
        <div class="modal fade bd-example-modal-lg-{{$var->reportId}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Review Report (Post)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row row_post_report_type">
                                Report Type
                            </div>
                            <div class="row row_post_report_id">
                                {{$var->reportDescription}}
                            </div>
                            <div class="row row_post_report_type">
                                Post Caption:
                            </div>
                            <div class="row row_post_report_id">
                                {{$var->postCaption}}
                            </div>
                            <div class="row row_report_post">
                                <div class="col-12 col_post_head">
                                    Reported Images:
                                </div>
                            </div>
                            <div class="row col_report_info">
                                <img src="/storage/cover_images/{{$var->postImageName}}" alt="" class="report_post_pics">
                            </div>
                            <div class="row row_report_post">
                                <div class="col-3 col_post_head">
                                    Post ID:
                                </div>
                                <div class="col-9 col_report_info">
                                    {{$var->postId}}
                                </div>
                            </div>

                            <div class="row row_report_post">
                                <div class="col-3 col_post_head">
                                    Owner ID:
                                </div>
                                <div class="col-9 col_report_info">
                                    {{$var->id}}
                                </div>
                            </div>
                            <div class="row row_report_post">
                                <div class="col-3 col_post_head">
                                    Owner Name:
                                </div>
                                <div class="col-9 col_report_info">
                                {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
                                </div>
                            </div>
                            <div class="row row_report_post">
                                <div class="col-3 col_post_head">
                                    Photo happened:
                                </div>
                                <div class="col-9 col_report_info">
                                {{$var->postRegion.", ".$var->postProvince.", ".$var->postCity.", ".$var->postSector}}
                                </div>
                            </div>
                            <div class="row row_report_post">
                                <div class="col-3 col_report_head">
                                    Amount:
                                </div>
                                <div class="col-9 col_report_info">
                                    PHP {{number_format((float) $var->postTargetAmount, 2)}} / PHP {{number_format((float) $var->postReceivedAmount, 2)}}
                                </div>
                            </div>
                            
                            <div class="row row_report_post">
                                <div class="col-3 col_report_head">
                                    Post Created Date:
                                </div>
                                <div class="col-9 col_report_info">
                                {{date('F j, Y h:m a', strtotime($var->postCreatedAt))}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if($var->postStatus == "BANNED")
                            <button type="submit" class="btn btn-primary" style="background-color:red !important; color:white;" disabled>Post Banned</button>
                        @else
                        <form action="{{ route('admin_ban') }}" method="GET">
                            <input type="hidden" name="reportid" value="{{$var->reportId}}">
                            <input type="hidden" name="deletePost" value="{{$var->postId}}">
                            <button type="submit" class="btn btn-primary">Ban this Post</button>
                        </form>
                        @endif
                        <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of review modal -->

        <!-- delete modal -->
        <div class="modal fade bd-example-modal-sm-{{$var->reportId}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this user? Please note that you cannot undo this after.
                    </div>

                    <div class="modal-footer">
                    <form action="{{route('admin_delete')}}" method="GET">
                        <input type="hidden" name="reportid" value="{{$var->reportId}}">
                        <input type="hidden" name="deletePost" value="{{$var->postId}}">
                        <button type="submit" class="btn btn-primary primary_btn">Yes</button>
                        </form>
                        <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of delete modal -->
    @endforeach
    @endif

    @if(count($varse) > 0)
    @foreach($varse as $var)
    <div class="modal fade bd-example-modal-lg-{{$var->reportId}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Review Report (Post)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <div class="row row_post_report_type">
                            Report Type
                        </div>
                        <div class="row row_post_report_id">
                            {{$var->reportDescription}}
                        </div>
                        <div class="row row_report_post">
                            <div class="col-12 col_post_head">
                                Reported Images:
                            </div>
                        </div>
                        <div class="row col_report_info">
                            <img src="/storage/cover_images/{{$var->postCoverImage}}" alt="" class="report_post_pics">
                        </div>
                        <div class="row row_report_post">
                            <div class="col-3 col_post_head">
                                Post ID:
                            </div>
                            <div class="col-9 col_report_info">
                                {{$var->postId}}
                            </div>
                        </div>

                        <div class="row row_report_post">
                            <div class="col-3 col_post_head">
                                Owner ID:
                            </div>
                            <div class="col-9 col_report_info">
                                {{$var->id}}
                            </div>
                        </div>
                        <div class="row row_report_post">
                            <div class="col-3 col_post_head">
                                Owner Name:
                            </div>
                            <div class="col-9 col_report_info">
                            {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
                            </div>
                        </div>
                        <div class="row row_report_post">
                            <div class="col-3 col_post_head">
                                Photo happened:
                            </div>
                            <div class="col-9 col_report_info">
                            {{$var->postRegion.", ".$var->postProvince.", ".$var->postCity.", ".$var->postSector}}
                            </div>
                        </div>
                        <div class="row row_report_post">
                            <div class="col-3 col_report_head">
                                Amount:
                            </div>
                            <div class="col-9 col_report_info">
                                PHP {{number_format((float) $var->postTargetAmount, 2)}} / PHP {{number_format((float) $var->postReceivedAmount, 2)}}
                            </div>
                        </div>
                        
                        <div class="row row_report_post">
                            <div class="col-3 col_report_head">
                                Post Created Date:
                            </div>
                            <div class="col-9 col_report_info">
                            {{date('F j, Y h:m a', strtotime($var->postCreatedAt))}}
                            </div>
                        </div>
                        <div class="row row_report_post">
                            <div class="col-12 col_post_head">
                                Post Caption:
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col_report_info">
                            {{$var->postCaption}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    @if($var->postStatus == "BANNED")
                        <button type="submit" class="btn btn-primary" style="background-color:red !important; color:white;" disabled>Post Banned</button>
                    @else
                    <form action="{{ route('admin_ban') }}" method="GET">
                        <input type="hidden" name="reportid" value="{{$var->reportId}}">
                        <input type="hidden" name="deletePost" value="{{$var->postId}}">
                        <button type="submit" class="btn btn-primary">Ban this Post</button>
                    </form>
                    @endif
                    <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of review modal -->

    <!-- delete modal -->
    <div class="modal fade bd-example-modal-sm-{{$var->reportId}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this user? Please note that you cannot undo this aftera.
                </div>

                <div class="modal-footer">
                    <form action="{{route('admin_delete')}}" method="GET">
                    <input type="hidden" name="reportid" value="{{$var->reportId}}">
                    <input type="hidden" name="deletePost" value="{{$var->postId}}">
                    <button type="submit" class="btn btn-primary primary_btn">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of delete modal -->
    @endforeach
    @endif
    </div>
</div>
<!-- /big container (this is for the content) -->
@endsection