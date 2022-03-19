@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('Manage Reports 3') }}" method="GET">
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
                        <form action="{{route('Manage Reports')}}" method="GET"><input type="hidden" name="selected_tile" value="Manage Reports"><button class="normal_tab">User</button></form>
                    </div>
                    <div class="col-2">
                        <form action="{{route('Manage Reports 2')}}" method="GET"><input type="hidden" name="selected_tile" value="Manage Reports"><button class="normal_tab">Post</button></form>
                    </div>
                    <div class="col-2">
                        <button class="selected_tab" disabled>Comment</button>
                    </div>
                </div>
                <div class="row tab_body_row" >
                    <div class="container tab_body_con" >
                        <div class="row" >
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Commented By</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Posted By</th>
                                        <th scope="col">Reported By</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $a = 1; @endphp

                                    @if(count($comment) > 0)
                                    @foreach($comment as $var)
                                    <tr>
                                        <th scope="row">{{$a}}</th>
                                        @php $a++ @endphp

                                        <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>

                                        <td>{{$var->commentDescription}}</td>

                                        

                                        @if(count($post) > 0)
                                        @foreach($post as $var2)

                                        @if($var2->reportId == $var->reportId)

                                            @if($post->contains($var->commentPostId))
                                            <td>deleted</td>
                                            
                                            @else
                                            
                                            <td>{{$var2->firstName." ".$var2->middleName." ".$var2->lastName." ".$var2->orgName}}</td>
                                            @endif
                                        
                                        @endif

                                        @endforeach
                                        @endif

                                        

                                        @if(count($person) > 0)
                                        @foreach($person as $var3)
                                        @if($var3->reportId == $var->reportId)
                                        <td>{{$var3->firstName." ".$var3->middleName." ".$var3->lastName." ".$var3->orgName}}</td>
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
                                    



                                    @if(count($thispost) > 0)
                                    @foreach($thispost as $var2)
                                    <tr>
                                        @if(count($comment2) > 0)
                                        @foreach($comment2 as $var)
                                        @if($var2->reportId == $var->reportId)
                                        <th scope="row">{{$a}}</th>
                                        @php $a++ @endphp

                                        <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>

                                        <td>{{$var->commentDescription}}</td>

                                        @endif
                                        @endforeach
                                        @endif
                                        
                                        <td>{{$var2->firstName." ".$var2->middleName." ".$var2->lastName." ".$var2->orgName}}</td>
                                        
                                        @if(count($person2) > 0)
                                        @foreach($person2 as $var3)
                                        @if($var3->reportId == $var2->reportId)
                                        <td>{{$var3->firstName." ".$var3->middleName." ".$var3->lastName." ".$var3->orgName}}</td>
                                        @endif
                                        @endforeach
                                        @endif

                                        @if(count($comment2) > 0)
                                        @foreach($comment2 as $var)
                                        @if($var2->reportId == $var->reportId)
                                        <td>{{$var->reportDescription}}</td>
                                        <td>{{$var->reportStatus}}</td>
                                        @endif
                                        @endforeach
                                        @endif
                                        <td class="center">
                                            <button class="btn_view" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-{{$var->reportId}}">Review</button>
                                            <button class="btn_delete" data-toggle="modal" data-target=".bd-example-modal-sm-{{$var->reportId}}">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                    



                                    @if(count($thisperson) > 0)
                                    @foreach($thisperson as $var3)

                                    <tr>



                                        @if(count($comment3) > 0)
                                        @foreach($comment3 as $var)
                                        @if($var3->reportId == $var->reportId)
                                        <th scope="row">{{$a}}</th>
                                        @php $a++ @endphp

                                        <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>

                                        <td>{{$var->commentDescription}}</td>

                                        @endif
                                        @endforeach
                                        @endif

                                        @if(count($post3) > 0)
                                        @foreach($post3 as $var2)
                                        @if($var3->reportId == $var2->reportId)
                                        <td>{{$var2->firstName." ".$var2->middleName." ".$var2->lastName." ".$var2->orgName}}</td>
                                        @endif
                                        @endforeach
                                        @endif
                                        
                                        <td>{{$var3->firstName." ".$var3->middleName." ".$var3->lastName." ".$var3->orgName}}</td>
                                        
                                        @if(count($comment3) > 0)
                                        @foreach($comment3 as $var)
                                        @if($var3->reportId == $var->reportId)
                                        <td>{{$var->reportDescription}}</td>
                                        <td>{{$var->reportStatus}}</td>
                                        @endif
                                        @endforeach
                                        @endif
                                        <td class="center">
                                            <button class="btn_view" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-{{$var->reportId}}">Review</button>
                                            <button class="btn_delete" data-toggle="modal" data-target=".bd-example-modal-sm-{{$var->reportId}}">Delete</button>
                                        </td>
                                    </tr>

                                    @endforeach
                                    @endif
                                   
                                    @if(count($person3) == 0 && count($post2) == 0 && count($comment) == 0)
                                    <tr>
                                        <td colspan="8" style="text-align:center;">No record.</td>
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
        @if(count($comment) > 0)
        @foreach($comment as $var)
        <!-- review modal -->
        <div class="modal fade bd-example-modal-lg-{{$var->reportId}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Review Report (Comment)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row row_com_report_type">
                                Report Type
                            </div>
                            <div class="row row_com_report_id">
                                {{$var->reportDescription}}
                            </div>
                            <div class="row row_report_comment">
                                <div class="col col_report_head">
                                    Reported Comment:
                                </div>
                            </div>
                            <div class="row row_reported_comment">
                                <div class="col col_report_info">
                                    {{$var->commentDescription}}
                                </div>
                            </div>
                            <div class="row row_report_comment">
                                <div class="col-4 col_report_head">
                                    Comment Owner ID:
                                </div>
                                <div class="col-8 col_report_info">
                                    {{$var->id}}
                                </div>
                            </div>
                            <div class="row row_report_comment">
                                <div class="col-4 col_report_head">
                                    Comment Owner Name:
                                </div>
                                <div class="col-8 col_report_info">
                                    {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if($var->reportStatus == "REVIEWED")
                            <button type="submit" class="btn btn-primary" style="background-color:red !important; color:white;" disabled><i class="fa fa-check" aria-hidden="true"></i> REVIEWED</button>
                        @else
                        <form action="{{ route('comment_review') }}" method="GET">
                            <input type="hidden" name="reportid" value="{{$var->reportId}}">
                            <input type="hidden" name="deleteComment" value="{{$var->commentId}}">
                            <button type="submit" class="btn btn-primary">Nothing is Wrong</button>
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
                    Are you sure you want to delete your comment? Please note that you cannot undo this after.
                    </div>

                    <div class="modal-footer">
                        <form action="{{route('admin_delete')}}" method="GET">
                        <input type="hidden" name="reportid" value="{{$var->reportId}}">
                        <input type="hidden" name="deleteComment" value="{{$var->commentId}}">
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