@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('Organization') }}" method="GET">
        <div class="row top_search_area" >
            <div class="col-7" style="margin-top:10px !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" name="selected_tile" value="Organization">
                    <input class="form-control" type="search" placeholder="Search" name="search" onclick="submit_form()" aria-label="Search" value="{{ $search }}" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" style="height:40px;margin-top:-1px;">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-4" style="margin-top:8px; margin-left:80px;">
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
                        <label for="" class="title_con">Organization Records</label>
                    </div>
                </div>
                <div class="row">
                @if(count($vars) > 0)
                <div class="col-9">
                    <label for="" class="title_con">
                    Items:
                    @foreach($vars as $count=>$var)
                    @endforeach
                    {{$count+=1}}
                    </label>
                </div>
                @else
                <div class="col-9">
                    <label for="" class="title_con">
                    Items: 0
                    </label>
                </div>
                @endif
                <div class="col-3">
                    <form action="{{ route('admin_orgs_pdf') }}" method="GET">
                        <input type="hidden" name="search1" value="{{$search}}">
                        <button type="submit" style="border:none;background:none;color:white;"><i class="fa fa-download" aria-hidden="true"></i> Export to PDF</button>
                    </form>
                </div>
                </div>
                <div class="row tab_body_row" >
                <div class="container tab_body_con" >
                    <div class="row" >
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Account ID</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Received</th>
                                <th scope="col">Donated</th>
                                <th scope="col">Verified</th>
                                <th scope="col" class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $cnt=0; @endphp
                        @if(count($vars) > 0)
                        @foreach($vars as $var)
                            <tr>
                                <td>@php echo $cnt+=1; @endphp</td>
                                <td>{{$var->id}}</td>
                                <td>{{$var->orgName}}</td>
                                <td>Php{{number_format((float)$var->amountReceived, 2, '.', '')}}</td>
                                <td>Php{{number_format((float)$var->amountGiven, 2, '.', '')}}</td>
                                <td>{{$var->accountVerified}}</td>
                                <td class="center">
                                    <button class="btn_view" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-{{$var->id}}">Review</button>
                                    <button class="btn_delete" data-toggle="modal" data-target=".bd-example-modal-sm-{{$var->id}}">Delete</button>
                                </td>
                                </td>
                                
                            </tr>

                            <!-- view modal -->
                            <div class="modal fade bd-example-modal-lg2-{{$var->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">User Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                                <div class="col">
                                                    <img style="width: 150px; height: 150px;" src="/storage/profile_images/{{$var->profileImage}}" alt="" class="imagecon">
                                                </div>
                                                <div class="col" style="width:290px;">
                                                <label for="">Full Name: <h5>{{$var->orgName}}</h5></label><br>
                                                <label for="">License: <h6>{{$var->license}}</h6></label><br>
                                                <label for="">Email: <h6>{{$var->email}}</h6></label><br>
                                                <label for="">Address: <h6>{{$var->sector.", ".$var->barangay.", ".$var->city.", ".$var->province.", ".$var->region}}</h6></label><br>
                                                <label for="">Phone Number: <h6>{{$var->phoneNumber}}</h6></label><br>
                                                <label for="">Total Amount Received: <h6>Php {{number_format((float)$var->amountReceived, 2, '.', '')}}</h6></label><br>
                                                <label for="">Total Amount Donated: <h6>Php {{number_format((float)$var->amountGiven, 2, '.', '')}}</h6></label><br>
                                                </div>
                                                
                                                <input type="hidden" name="recepient" value="{{$var->id}}">
                                        </div>
                                        
                                        <div class="modal-footer">
                                            
                                            @if($var->accountVerified == "VERIFIED")
                                                <button type="submit" class="btn btn-primary" style="background-color:green; color:white;" disabled><i class="fa fa-check" aria-hidden="true"></i> Account Verified</button>
                                            @else
                                            <form action="{{ route('admin_verify_user') }}" method="GET">
                                                <input type="hidden" name="userid" value="{{$var->id}}">
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
                            <div class="modal fade bd-example-modal-sm-{{$var->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Account Deletion</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure you want to delete this user? Please note that you cannot undo this after.
                                        </div>

                                        <div class="modal-footer">
                                            <form action="{{route('admin_delete')}}" method="GET">
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
                
                        @else
                        <tr>
                            <td colspan="11" style="text-align:center">No Record.</td>
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

@if(count($vars) > 0)
        @foreach($vars as $var)
        <!-- review modal -->
        <div class="modal fade bd-example-modal-lg-{{$var->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                        <button class="nav-link active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home-{{$var->id}}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Information</button>
                                        <button class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile-{{$var->id}}" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Donated History</button>
                                        <button class="nav-link" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages-{{$var->id}}" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Received History</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <!-- personal info tab -->
                                    <div class="tab-pane fade show active" id="v-pills-home-{{$var->id}}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="container modal_info_con">
                                            <div class="row tab_row_header">
                                                Personal Information
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    Organization Name:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                    {{$var->orgName}}
                                                </div>
                                            </div>

                                            <div class="row modal_row_info">
                                                <div class="col-3 modal_info_bold">
                                                    License:
                                                </div>
                                                <div class="col-9 modal_info_names">
                                                {{$var->license}}
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
                                    <div class="tab-pane fade" id="v-pills-profile-{{$var->id}}" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="container modal_info_con">
                                            <div class="row tab_row_header">
                                                Donated History
                                            </div>
                    
                                            <div class="container tab_body_con2" >
                                                <div class="row" >
                                                    <label for="" class="table_total_items">Total items: @php $c=0; @endphp
                                                        @if(count($donated) > 0)
                                                        @foreach ($donated as $var2)
                                                        @if($var2->transactionUserId == $var->id)
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
                                                        @if($var2->transactionUserId == $var->id)
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
                                    <div class="tab-pane fade" id="v-pills-messages-{{$var->id}}" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <div class="container modal_info_con">
                                            <div class="row tab_row_header">
                                                Received History
                                            </div>
                    
                                            <div class="container tab_body_con2" >
                                                <div class="row" >
                                                    <label for="" class="table_total_items">Total items: @php $c2=0; @endphp
                                                        @if(count($received) > 0)
                                                        @foreach ($received as $var3)
                                                        @if($var3->postUserId == $var->id)
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
                                                        @if($var3->postUserId == $var->id)
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
                        <button type="submit" class="btn btn-primary" style="background-color:green; color:white;" disabled><i class="fa fa-check" aria-hidden="true"></i> Account Verified</button>
                    @else
                    <form action="{{ route('admin_verify_user') }}" method="GET">
                        <input type="hidden" name="userid" value="{{$var->id}}">
                        <button type="submit" class="btn btn-primary">Verify this Account</button>
                    </form>
                    @endif
                    <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of review modal -->
        @endforeach
        @endif


@endsection