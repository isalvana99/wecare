@extends('layouts.admin_layout')

@section('content')
<style>
input[type=checkbox] {
  display: none;
}

.container2 img {
  transition: transform 0.25s ease;
  cursor: zoom-in;
  width: 100px;
  height: 70px;
}

input[type=checkbox]:checked ~ label > img {
  transform: scale(4);
  margin-top: -140px;
  margin-left: 75%;
  cursor: zoom-out;
  position: relative;
  width: 300px;
  height: 200px;
  z-index:99999;
}
</style>
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('Requests') }}" method="GET">
        <div class="row top_search_area" >
            <div class="col-7" style="margin:auto !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" name="selected_tile" value="Requests">
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
                    <label for="" class="title_con">Requests</label>
                </div>
                <div class="row tab_head_row">
                    <div class="col-3 " >
                        <button class="selected_tab" style="width:100%;" disabled>Request Verification</button>
                    </div>
                    <div class="col-3" style="width:100%">
                        <form action="{{route('Requests 2')}}" method="GET"><input type="hidden" name="selected_tile" value="Requests"><button class="normal_tab" style="width:100%;">Request Deletion</button></form>
                    </div>
                </div>
                <div class="row tab_body_row" >
                    <div class="container tab_body_con" >
                        <div class="row" >
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Date</th>
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

                                        

                                        <td>{{$var->reviewType}}</td>
                                        <td>{{date('F j, Y h:i A', strtotime($var->reviewCreatedAt))}}</td>
                                        <td class="center">
                                            <button class="btn_view" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-{{$var->reviewId}}">Review</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    

                                    @if(count($vars) == 0)
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
        
        @if(count($vars) > 0)
        @foreach($vars as $var)
        <!-- review modal -->
        <div class="modal fade bd-example-modal-lg-{{$var->reviewId}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">User Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="row modal_left_first" style="">
                                    <img src="/storage/profile_images/{{$var->profileImage}}" alt="" class="modal_user_image_blur">
                                </div>
                                <div class="row modal_left_second">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" >
                                        <button class="nav-link active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home-{{$var->reviewUserId}}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Information</button>
                                        <button class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile-{{$var->reviewUserId}}" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Donated History</button>
                                        <button class="nav-link" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages-{{$var->reviewUserId}}" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Received History</button>

                                        <div class="nav-link">
                                                Attached ID:
                                                <div class="container2">
                                                    <input type="checkbox" id="zoomCheck">
                                                    <label for="zoomCheck">
                                                        <img src="/storage/request_verification/{{$var->reviewImage}}">
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <!-- personal info tab -->
                                    <div class="tab-pane fade show active" id="v-pills-home-{{$var->reviewUserId}}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="container modal_info_con">
                                            <div class="row tab_row_header">
                                                Personal Information
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Firstname:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                    {{$var->firstName}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Middlename:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                    {{$var->middleName}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Lastname:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                    {{$var->lastName}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Birthday:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                {{date('F j, Y', strtotime($var->birthday))}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Gender:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                {{$var->sex}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Email:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                {{$var->email}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Phone #:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                {{$var->phoneNumber}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Street:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                    {{$var->sector}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Barangay:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                    {{$var->barangay}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    City:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                    {{$var->city}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Province:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                    {{$var->province}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Total Amount Received:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                PHP {{number_format($var->amountReceived, 2)}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Total Amount Donated:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                PHP {{number_format($var->amountGiven, 2)}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- presonal info end -->
                                    

                                    <!-- donated history tab -->
                                    <div class="tab-pane fade" id="v-pills-profile-{{$var->reviewUserId}}" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="container modal_info_con">
                                            <div class="row tab_row_header">
                                                Donated History
                                            </div>
                    
                                            <div class="container tab_body_con2" >
                                                <div class="row" >
                                                    <label for="" class="table_total_items">Total items: @php $c=0; @endphp
                                                        @if(count($donated) > 0)
                                                        @foreach ($donated as $var2)
                                                        @if($var2->transactionUserId == $var->reviewUserId)
                                                        @php $c++; @endphp
                                                        @endif
                                                        @endforeach
                                                        @endif

                                                        {{$c}}
                                                    </label>
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Date Donated</th>
                                                                <th scope="col">Recepient</th>
                                                                <th scope="col">GCash Number</th>
                                                                <th scope="col">Date of Post</th>
                                                                <th scope="col">Amount Donated</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($donated) > 0)
                                                        @foreach ($donated as $var2)
                                                        @if($var2->transactionUserId == $var->reviewUserId)
                                                            <tr>
                                                                <td>{{date('F j, Y', strtotime($var2->transactionCreatedAt))}}</td>
                                                                <td>{{$var2->firstName." ".$var2->middleName." ".$var2->lastName." ".$var2->orgName}}</td>
                                                                <td>{{$var2->phoneNumber}}</td>
                                                                <td>{{date('F j, Y', strtotime($var2->postCreatedAt))}}</td>
                                                                <td>PHP {{number_format($var2->transactionAmount, 2)}}</td>
                                                            </tr>
                                                        @endif
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="10" style="text-align:center">No Record.</td>
                                                        </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                                <div class="row modal_total_bottom">
                                                    Total Amount: PHP {{number_format($var->amountGiven, 2)}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- donated history end -->
                                    
                                    <!-- received tab -->
                                    <div class="tab-pane fade" id="v-pills-messages-{{$var->reviewUserId}}" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <div class="container modal_info_con">
                                            <div class="row tab_row_header">
                                                Received History
                                            </div>
                    
                                            <div class="container tab_body_con2" >
                                                <div class="row" >
                                                    <label for="" class="table_total_items">Total items: @php $c2=0; @endphp
                                                        @if(count($received) > 0)
                                                        @foreach ($received as $var3)
                                                        @if($var3->postUserId == $var->reviewUserId)
                                                        @php $c2++; @endphp
                                                        @endif
                                                        @endforeach
                                                        @endif

                                                        {{$c2}}</label>
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Date Donated</th>
                                                                <th scope="col">Donator</th>
                                                                <th scope="col">GCash Number</th>
                                                                <th scope="col">Date of Post</th>
                                                                <th scope="col">Amount Received</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($received) > 0)
                                                        @foreach ($received as $var3)
                                                        @if($var3->postUserId == $var->reviewUserId)
                                                            <tr>
                                                            <td>{{date('F j, Y', strtotime($var3->transactionCreatedAt))}}</td>
                                                            <td>{{$var3->firstName." ".$var3->middleName." ".$var3->lastName." ".$var3->orgName}}</td>
                                                            <td>{{$var3->phoneNumber}}</td>
                                                            <td>{{date('F j, Y', strtotime($var3->postCreatedAt))}}</td>
                                                            <td>PHP {{number_format($var3->transactionAmount, 2)}}</td>
                                                            </tr>
                                                        @endif
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="10" style="text-align:center">No Record.</td>
                                                        </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                                <div class="row modal_total_bottom">
                                                    Total Amount: PHP {{number_format($var->amountReceived, 2)}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- received tab end -->

                                    

                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">..j.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="modal-footer">

                    @if($var->accountVerified == "VERIFIED")
                        <button type="submit" class="btn btn-primary" style="background-color:green; color:black;" disabled><i class="fa fa-check" aria-hidden="true"></i> Account Verified</button>
                    @else
                    <form action="{{ route('admin_verify_user') }}" method="GET">
                        <input type="hidden" name="userid" value="{{$var->reviewUserId}}">
                        <button type="submit" class="btn btn-primary">Verify this Account</button>
                    </form>
                    @endif
                    <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of review modal -->

        <!-- delete modal -->
        <div class="modal fade bd-example-modal-sm-{{$var->reviewId}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="reviewid" value="{{$var->reviewId}}">
                        <input type="hidden" name="deleteUser" value="{{$var->reviewUserId}}">
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