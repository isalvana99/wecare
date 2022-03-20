@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('Reports') }}" method="GET">
        <div class="row top_search_area" >
            <div class="col-7" style="margin:auto !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" name="selected_tile" value="Reports">
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
                        <button class="selected_tab" style="width:100%;" disabled>User</button>
                    </div>
                    <div class="col-2">
                        <form action="{{route('Manage Reports 2')}}" method="GET"><input type="hidden" name="selected_tile" value="Reports"><button class="normal_tab" style="width:100%;">Post</button></form>
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
                                        <th scope="col">Reported Name</th>
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

                                        
                                        <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>
                                        

                                        <td>{{$var2->reportDescription}}</td>
                                        <td>{{$var2->reportStatus}}</td>


                                        <td class="center">
                                            <button class="btn_view" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-{{$var2->reportId}}">Review</button>
                                            <button class="btn_delete" data-toggle="modal" data-target=".bd-example-modal-sm-{{$var2->reportId}}">Delete</button>
                                        </td>
                                        @endif
                                        @endforeach
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endif

                                    @if(count($vars) == 0 && count($thisperson) == 0)
                                    <tr>
                                        <td colspan="6" style="text-align:center;">No record.</td>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Review Report (User)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <img src="/storage/profile_images/{{$var->profileImage}}" alt="" class="report_user_pic">
                                </div>
                                <div class="col-8">
                                    <div class="row row_report_type">
                                        Report type
                                    </div>
                                    <div class="row row_report_id">
                                        {{$var->reportDescription}}
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Date:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{date('F j, Y h:m A', strtotime($var->reportCreatedAt))}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Report #:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->reportId}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Fullname:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
                                        </div>
                                    </div>
                                    @if($var->license != NULL)
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            License:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->license}}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Birthday:
                                        </div>
                                        <div class="col-9 col_report_info">
                                        {{date('F j, Y', strtotime($var->birthday))}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Gender:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->sex}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Address:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->region.", ".$var->province.", ".$var->city.", ".$var->sector}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Phone Number:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->phoneNumber}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Total Amount Donated:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            PHP {{number_format((float) $var->amountGiven, 2)}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Total Amount Received:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            PHP {{number_format((float) $var->amountReceived, 2)}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Email:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->email}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Email Verified:
                                        </div>
                                        @if($var->accountVerified != NULL)
                                        <div class="col-9 col_report_info">
                                            YES
                                        </div>
                                        @else
                                        <div class="col-9 col_report_info">
                                            NO
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Account Created Date:
                                        </div>
                                        <div class="col-9 col_report_info">
                                        {{date('F j, Y h:m a', strtotime($var->accountCreatedAt))}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if($var->accountVerified == "BANNED")
                            <button type="submit" class="btn btn-primary" style="background-color:red !important; color:white;" disabled>Account Banned</button>
                        @else
                        <form action="{{ route('admin_ban') }}" method="GET">
                            <input type="hidden" name="reportid" value="{{$var->reportId}}">
                            <input type="hidden" name="deleteUser" value="{{$var->id}}">
                            <button type="submit" class="btn btn-primary">Ban this Account</button>
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
                        <input type="hidden" name="deleteUser" value="{{$var->id}}">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Review Report (User)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <img src="/storage/profile_images/{{$var->profileImage}}" alt="" class="report_user_pic">
                                </div>
                                <div class="col-8">
                                    <div class="row row_report_type">
                                        Report type
                                    </div>
                                    <div class="row row_report_id">
                                        {{$var->reportDescription}}
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Date:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{date('F j, Y h:m A', strtotime($var->reportCreatedAt))}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Report #:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->reportId}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Fullname:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
                                        </div>
                                    </div>
                                    @if($var->license != NULL)
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            License:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->license}}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Birthday:
                                        </div>
                                        <div class="col-9 col_report_info">
                                        {{date('F j, Y', strtotime($var->birthday))}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Gender:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->sex}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Address:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->region.", ".$var->province.", ".$var->city.", ".$var->sector}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Phone Number:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->phoneNumber}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Total Amount Donated:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            PHP {{number_format((float) $var->amountGiven, 2)}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Total Amount Received:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            PHP {{number_format((float) $var->amountReceived, 2)}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Email:
                                        </div>
                                        <div class="col-9 col_report_info">
                                            {{$var->email}}
                                        </div>
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Email Verified:
                                        </div>
                                        @if($var->accountVerified != NULL)
                                        <div class="col-9 col_report_info">
                                            YES
                                        </div>
                                        @else
                                        <div class="col-9 col_report_info">
                                            NO
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row row_report_details">
                                        <div class="col-3 col_report_head">
                                            Account Created Date:
                                        </div>
                                        <div class="col-9 col_report_info">
                                        {{date('F j, Y h:m a', strtotime($var->accountCreatedAt))}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if($var->accountVerified == "BANNED")
                            <button type="submit" class="btn btn-primary" style="background-color:red !important; color:white;" disabled>Account Banned</button>
                        @else
                        <form action="{{ route('admin_ban') }}" method="GET">
                            <input type="hidden" name="reportid" value="{{$var->reportId}}">
                            <input type="hidden" name="deleteUser" value="{{$var->id}}">
                            <button type="submit" class="btn btn-primary">Ban this Account</button>
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
                        <input type="hidden" name="deleteUser" value="{{$var->id}}">
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