@extends('distribution.sidepanel')

@section('content')

@if($postid != "")
<div style="width:100%;display:flex;margin-bottom:10px;">

    <button onclick="document.getElementById('left-content').style.display == 'none' ? document.getElementById('left-content').style.display = 'inline' : document.getElementById('left-content').style.display = 'none'" class="content-collapse-btn"><i class="fa fa-bars" aria-hidden="true"></i></button>

    <!-- left panel content -->
    <div class="left-content" id="left-content" style="border-right: 2px solid grey;display:inline;">
        <div class="col-12" style="">
            <form action="{{route('distributioncontent')}}">
            <input type="hidden" name="referenceno" value="{{$postid}}">
            <label for="searchname2">Search name here to assign:</label>
            <input class="form-control" type="search" name="searchname" value="{{$searchname}}" placeholder="Search Name" onclick="submit_form()" autocomplete="off" id="searchname2" style="width:200px;">
            </form>
            <br>
            <!-- names list in search -->
            @if($searchname != "")
            <label for="">Choose name below to get started:</label>
            @if(count($users) > 0)
            @foreach($users as $user)
            @if($user->accountType == "DONOR" && $user->role != "ADMIN")
            <form action="{{route('distributioncontent')}}">
                <input type="hidden" name="referenceno" value="{{$postid}}">
                <input type="hidden" name="userid" value="{{$user->id}}">
                <button class="name-1-btn" style="width: 200px;">
                <div class="content-name-1">
                    <img src="/storage/profile_images/{{$user->profileImage}}" alt="" class="img-content-name-1">
                    {{$user->firstName." ".$user->middleName." ".$user->lastName." ".$user->orgName}}
                </div>
                </button>
            </form>
            @endif
            @endforeach
            @endif
            @endif
            <!-- names list in search end -->
        </div>
    </div>
    <!-- left panel content end -->
    <!-- right panel content -->
    <div class="right-content" style="margin-left:30px;">
    @include('inc.messages')

        @php $remains = 0; @endphp
        @if(count($distribution) > 0)
        @foreach($distribution as $dist)
            @php $remains += $dist->distributionAmount @endphp
        @endforeach
        @endif
        <!-- <h5 style="width: auto;">Total donation received in this section: PHP {{number_format($post->postReceivedAmount,2)}} | Remaining for distribution: @if(($post->postReceivedAmount - $remains) < 0) <label style="color:red;"> PHP {{number_format($post->postReceivedAmount - $remains,2)}}</label> @else PHP {{number_format($post->postReceivedAmount - $remains,2)}} @endif</h5> -->

        <!-- view add files history -->
        <div class="col-12" data-toggle="modal" data-target="#addfilepostModal2">
            <div style="font-size:16px; text-decoration:underline; color:blue;text-align:left;">View Attached Files</div>
        </div>
        <!-- Modal OF view donation history BUTTON-->
        <div class="modal fade" id="addfilepostModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width:805px;">
                    <div class="modal-header">
                        If necessary, you can upload your related files here:
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="width:800px;">
                        <div class="container">
                            <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="postid" value="{{$post->postId}}">
                                @csrf
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <label for="formFileMultiple" class="form-label">Upload File Here</label>
                                <input class="form-control" type="file" id="formFileMultiple" name="file"/>
                                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                    Upload Files
                                </button>

                            </form>
                        </div>
                    </div>

                    
                        <table id="customers" style="width:800px;">
                            <tr>
                                <th>Date | Time</th>
                                <th>Click the file to download</th>
                                <th>Uploaded by: </th>
                                <th></th>
                            </tr>
                            @if(count($files) > 0)
                            @foreach($files as $file)
                            <tr>
                                <td style="width:200px;">{{date('F j, Y | h:i A', strtotime($file->fileCreatedAt))}}
                                </td>
                                <td>
                                    <form action="{{route('fileDownload')}}" method="GET">
                                        <input type="hidden" name="filename" id="" value="{{$file->filePath}}">
                                        <button type="submit" style="background:none;border:none;width:300px;">{{$file->fileName}}</button>
                                    </form>
                                </td>
                                <td style="width:200px;">
                                    {{$file->firstName." ".$file->middleName." ".$file->lastName." ".$file->orgName}}
                                </td>
                                @if($file->fileUserId == Auth::user()->id)
                                <td style="color:red !important;">
                                    <form action="{{route('fileDelete')}}">
                                        <input type="hidden" name="fileid" id="" value="{{$file->fileId}}">
                                        <button type="submit" style="color:red !important;border:none;background:none;font-size:12px;width:50px;">
                                        remove
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">No File</td>
                            </tr>
                            @endif
                        </table>
                    

                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
        <!-- view add files history -->

        @php $total1 = 0; $total2 = 0; @endphp
        @if(count($transparency) > 0)
        @foreach($transparency as $i=>$tran)
        @if($tran->transparencyPostId == $post->postId)
            @php $total1 += $tran->transparencyAmount; @endphp
            @php $total2 += $tran->transparencyAmount; @endphp
        @endif
        @endforeach
        @endif
        <div style="text-align:left;font-weight:bold;background:yellow;">
        <hr>DISTRIBUTIONS <br><hr>
        <div class="row">
            <div class="col-6" style="border-right: 2px solid gray;">
                Total Donations Collected: <u>PHP {{number_format($post->postReceivedAmount,2)}}</u><br> 
                Total Distributed to Assignments: <u>PHP {{number_format($remains,2)}}</u><br>
                Remaining for Distribution: @if(($post->postReceivedAmount - $remains) < 0) 
                    <label style="color:red;"> <u>PHP {{number_format($post->postReceivedAmount - $remains,2)}}</u></label> @else <u>PHP {{number_format($post->postReceivedAmount - $remains,2)}}</u> @endif<br>
            </div>
            <div class="col-6">
                Distributions to Recepients: <u>PHP {{number_format($total1,2)}}</u><br>
                Remaining for Distributions: PHP @php $remains = $post->postReceivedAmount - $total1; @endphp @if($remains < 0) 
                    <div style="color:red;">&nbsp;<u>{{number_format($remains,2)}}</u></div> @else <u>{{number_format($remains,2)}}</u> @endif</div><br>
            </div>
            <hr>
        </div>
        

        <div class="row" style="padding: 10px;">
            
            <div class="col-12" style="">

                <!-- adding of location -->
                @if($selecteduser != "")

                    <div class="row">
                        <label for="" style="width:auto;font-weight: bold;margin-top:5px;">You have chosen: </label>
                        <div class="content-name-1" style="width:auto;">
                            @if($selecteduser != "")
                            <img src="/storage/profile_images/{{$selecteduser->profileImage}}" alt="" class="img-content-name-1">
                            {{$selecteduser->firstName." ".$selecteduser->middleName." ".$selecteduser->lastName." ".$selecteduser->orgName}}
                            @endif
                        </div>

                        <div data-toggle="modal" data-target="#mpostModal2-{{$selecteduser->id}}" style="width:200px;">
                            <input type="hidden" name="postid" value="{{$post->postId}}">
                            <button class="post_donate_button" style="width:200px;">Assign Amount</button>
                        </div>
                        <!-- Modal OF DONATE BUTTON-->
                        <div class="modal fade" id="mpostModal2-{{$selecteduser->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height:300px;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Distribution</h5>
                                        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                                        <i class="fal fa-times" aria-hidden="true" class="close-btn"></i>
                                        </button>
                                    </div>

                                    <div class="modal-body" style="height:100px;">
                                        <form action="/distpayment/" method="GET">
                                        <div class="form-group">
                                        <label for="amount" style="font-weight:bold;font-size:18px;">Enter Amount:</label><br>
                                        PHP <input style="border-radius: 10px;padding:5px;" type="text" name="hamount">
                                        </div>
                                        <input type="hidden" name="userid" value="{{$userid}}">
                                        <input type="hidden" name="postid" value="{{$postid}}">
                                        <input type="hidden" name="donation" id="" value="{{$remains}}">
                                        <input type="hidden" name="donor" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="previous_url" value="/distribution?referenceno={{$postid}}&userid={{$userid}}">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" style="width:100%;">Proceed to Payment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /END Modal -->
                    </div>
                    <br>

                    <div class="row" style="display:none;">
                        <label for="" style="width:auto;padding-top:10px;">Please select location this user will be assigned:</label>
                        <form action="{{route('distributioncontent')}}" style="width:auto;">
                        <input type="hidden" name="referenceno" value="{{$postid}}">
                        <input type="hidden" name="userid" value="{{$userid}}">
                            <select class="form-select" style="padding-bottom:2%;width:200px; margin-bottom:10px;border:1px solid gray; border-radius:5px; height:50px;" onchange="this.form.submit()" name="l"> 
                                <option value="{{$l}}" hidden>{{$l}}</option>
                                @php $loc = ""; @endphp
                                @if($post->postCity == "Mandaue")
                                    @foreach($b1 as $b)

                                    @if(count($distribution) > 0)
                                    @foreach($distribution as $i=>$tran)
                                    @if($post->postId == $tran->distributionPostId && $tran->distributionLocation == $b)

                                    @php $loc = $b; @endphp

                                    @endif
                                    @endforeach
                                    @endif

                                    @if($loc != $b)
                                    <option value="{{$b}}">{{$b}}</option>
                                    @endif

                                    @endforeach

                                @elseif($post->postCity == "Lapu-Lapu")
                                    @foreach($b2 as $b)
                                    
                                    @if(count($distribution) > 0)
                                    @foreach($distribution as $i=>$tran)
                                    @if($post->postId == $tran->distributionPostId && $tran->distributionLocation == $b)

                                    @php $loc = $b; @endphp

                                    @endif
                                    @endforeach
                                    @endif

                                    @if($loc != $b)
                                    <option value="{{$b}}">{{$b}}</option>
                                    @endif

                                    @endforeach
                                @endif
                            </select>
                        </form>
                    </div>
                    


                    <!-- @if($l != "") -->
                    <!-- add record -->
                    <table id="addtable1" style="display:none;">
                        <tr>
                            <th style="background:white;border:none;">Amount</th>
                            <th></th>
                        </tr>

                        <form action="{{route('distribution')}}" method="GET">
                            <input type="hidden" name="postid" value="{{$post->postId}}">
                            <input type="hidden" name="assigneduserid" value="{{$userid}}">
                            <input type="hidden" name="l" id="" value=""> 
                            <input type="hidden" name="referenceno" value="{{$postid}}">
                            <input type="hidden" name="userid" value="{{$userid}}">
                            <input type="hidden" name="donation" id="" value="{{$post->postReceivedAmount - $remains}}">
                            
                            <tr>
                                <td style="background:white;border:none;"><input type="text" name="hamount" id="" placeholder="PHP" required><br></td>
                                <td style="background:white;border:none;" colspan="4"><button class="btn-delete-yes" type="submit" style="position:relative;float:right;width:100px;">OK</button></td>
                            </tr>
                        </form>
                    <!-- @endif -->
                    </table>
                    <!-- add record end -->

                @endif
                <!-- adding of location -->
                
                @if(count($distribution) > 0)
                <label for="" style="background:#64c7fe;width:100%;padding-left:10px; font-weight: bold;">Recorded:</label>

                <!-- record table -->
                <table id="myTable">
                    <tr>
                        <th>Assigned to:</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($distribution as $key=>$dist)
                    <tr style="background:none;">
                        <td style="vertical-align:top;">
                            <div class="content-name-1">
                                <img src="../storage/profile_images/{{$dist->profileImage}}" alt="" class="img-content-name-1">
                                {{$dist->firstName." ".$dist->middleName." ".$dist->lastName." ".$dist->orgName}}
                            </div>
                        </td>
                        <td style="background:none;">{{date('F j, Y', strtotime($dist->distributionCreatedAt))}}</td>
                        <td style="background:none;">PHP {{number_format($dist->distributionAmount,2)}}</td>
                        <td>
                            <div data-toggle="modal" data-target="#tpostModal2-{{$dist->distributionId}}">
                            <div style="font-size:12px; text-decoration:underline; color:blue;text-align:left;">View Record</div>
                            </div>
                            <!-- Modal OF view transparency BUTTON-->
                            <div class="modal fade" id="tpostModal2-{{$dist->distributionId}}"" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="left: -110px;width:800px;">
                                        <div class="modal-header">
                                            Location: <div style="text-align:right;font-weight:bold;">&nbsp;City of {{$post->postCity}}</div>

                                            
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body" style="">
                                            @if($dist->distributionId == $userid)
                                            <form action="/show-distribution/my">
                                            <input type="hidden" name="postid" value="{{$post->postId}}">
                                            <button class="btn-delete-yes" style="">Edit</button>
                                            </form>
                                            @endif

                                            @php $total = 0; @endphp
                                            @if(count($distribution) > 0)
                                            @foreach($distribution as $i=>$tran)
                                                @if($tran->distributionAssignedTo == $dist->distributionAssignedTo)
                                                @php $total += $tran->distributionAmount; @endphp
                                                @endif
                                            @endforeach
                                            @endif

                                            @php $transtotal = 0; @endphp
                                            @if(count($transparency) > 0)
                                            @foreach($transparency as $i=>$tran)
                                                @if($tran->transparencyUserId == $dist->distributionAssignedTo)
                                                @php $transtotal += $tran->transparencyAmount; @endphp
                                                @endif
                                            @endforeach
                                            @endif

                                            @php $total2 = 0; $total3 = 0; @endphp
                                            @if(count($transparency) > 0)
                                            @foreach($transparency as $i=>$tran)
                                                @if($tran->transparencyUserId == $dist->distributionAssignedTo)
                                                @php $total3 += $tran->transparencyAmount; @endphp
                                                @php $total2 += $tran->transparencyAmount; @endphp
                                                @endif
                                            @endforeach
                                            @endif
                                            <h5 style="text-align:left;font-weight:bold;">
                                            Donations: PHP {{number_format($total,2)}} |  Distributions: PHP {{number_format($transtotal,2)}} | Remaining: PHP @php $remains = $total - $transtotal; @endphp @if($remains < 0) <div style="color:red;">&nbsp;{{number_format($remains,2)}}</div> @else {{number_format($remains,2)}} @endif
                                            </h5><br>

                                            

                                            <!-- update / delete record -->
                                            <div class="row">
                                            <div class="col-12">
                                            <table>
                                                <tr style="border-top:1px solid black;">
                                                    <th>Barangay</th>
                                                    <th>Date</th>
                                                    <th>Name/Recepient</th>
                                                    <th>Amount</th>
                                                </tr>

                                                @if(count($transparency) > 0)
                                                @foreach($transparency as $i=>$tran)
                                                @if($tran->transparencyUserId == $dist->distributionAssignedTo)
                                                <tr>
                                                    
                                                    <input type="hidden" name="menusettings[{{$i}}][transparencyid]" id="" value="{{$tran->transparencyId}}">
                                                    <input type="hidden" name="menusettings[{{$i}}][postid]" id="" value="{{$post->postId}}">

                                                    <td style="background:white;">{{$tran->transparencyLocation}}</td>
                                                    <td style="background:white;">{{date('F j, Y',strtotime($tran->transparencyCreatedAt))}}</td>
                                                    <td style="background:white;">{{$tran->firstName.' '.$tran->middleName.' '.$tran->lastName.' '.$tran->orgName}}</td>
                                                    <td style="background:white;">PHP {{number_format($tran->transparencyAmount,2)}}</td>
                                                    
                                                </tr>
                                                @endif
                                                @endforeach
                                                
                                                <tr style="border-top:1px solid black;background:white;font-weight:bold;">
                                                
                                                    <td  colspan="3">Total</td>
                                                    <td>PHP {{number_format($total2,2)}}</td>
                                                </tr>
                                                @endif

                                            </table>
                                            </div>
                                            <!-- update / delete record end -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
                            <!-- view transparency history -->
                        </td>
                        <!-- delete from table -->
                        <!-- <td>
                            <form action="{{route('distributiondelete')}}" >
                            <input type="hidden" name="distid" id="" value="{{$dist->distributionId}}">
                            <button type="submit" style="background:none; border:none; position:relative;">
                                <i class="fa fa-trash" style="position:absolute; left: -20px; top: -12px;color:red;"></i>
                            </button>
                            </form>
                        </td> -->
                    </tr>
                    @endforeach
                </table>
                <!-- record table end -->
                @endif
                

            </div>
        </div>
        
        
        
        

        

    </div>
    <!-- right panel content end -->
</div>
@else
<div style="padding:30px;">Please select a Title to get started..</div>
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    var span = 1;
    var prevTD = "";
    var prevTDVal = "";
    $("#myTable tr td:first-child").each(function() { //for each first td in every tr
        var $this = $(this);
        if ($this.text() == prevTDVal) { // check value of previous td text
            span++;
            if (prevTD != "") {
                prevTD.attr("rowspan", span); // add attribute to previous td
                $this.remove(); // remove current td
            }
        } else {
            prevTD     = $this; // store current td 
            prevTDVal  = $this.text();
            span       = 1;
        }
    });
    });
</script>
@endsection