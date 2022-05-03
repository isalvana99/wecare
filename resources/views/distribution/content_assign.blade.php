@extends('distribution.sidepanel_assign')

@section('content')

@if($postid != "")
<div style="width:100%;display:flex;margin-bottom:10px;">

    <button style="display:none;" onclick="document.getElementById('left-content').style.display == 'none' ? document.getElementById('left-content').style.display = 'inline' : document.getElementById('left-content').style.display = 'none'" class="content-collapse-btn"><i class="fa fa-bars" aria-hidden="true"></i></button>

    <!-- left panel content -->
    <div class="left-content" id="left-content" style="border-right: 2px solid grey;display:none;">
        <div class="col-12" style="">
            <form action="{{route('distributioncontent2')}}">
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
            <form action="{{route('distributioncontent2')}}">
                <input type="hidden" name="referenceno" value="{{$postid}}">
                <input type="hidden" name="userid" value="{{$user->id}}">
                <button type="submit" class="name-1-btn" style="width: 200px;">
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

        <!-- computations -->
            @php $total = 0; @endphp
            @if(count($distribution) > 0)
            @foreach($distribution as $i=>$tran)
                @if($tran->distributionAssignedTo == Auth::user()->id)
                @php $total += $tran->distributionAmount; @endphp
                @endif
            @endforeach
            @endif

            @php $transtotal = 0; @endphp
            @if(count($transparency) > 0)
            @foreach($transparency as $i=>$tran)
                @if($tran->transparencyUserId == Auth::user()->id)
                @php $transtotal += $tran->transparencyAmount; @endphp
                @endif
            @endforeach
            @endif

            <h5 style="text-align:left;font-weight:bold;">
            Donations: PHP {{number_format($total,2)}} |  Distributions: PHP {{number_format($transtotal,2)}} | Remaining: PHP @php $remains = $total - $transtotal; @endphp @if($remains < 0) <div style="color:red;">&nbsp;{{number_format($remains,2)}}</div> @else {{number_format($remains,2)}} @endif
            </h5><br>
        <!-- computations end -->

        <!-- add record row -->
        <form action="{{route('distributioncontent2')}}" style="">
            <div class="row">
                <div class="col-6">Choose barangay you catered here to get started: </div>
                <div class="col-6" data-toggle="modal" data-target="#thistablehere" >
                    <div style="font-size:16px; text-decoration:underline; color:blue;text-align:left;">View My Table Distribution</div>
                </div>
            </div>

            <input type="hidden" name="referenceno" value="{{$postid}}">
            <select class="form-select" style="width:200px;" onchange="this.form.submit()" name="l"> 
                <option value="{{$l}}" hidden>{{$l}}</option>
                @php $loc = ""; @endphp
                @if($post->postCity == "Mandaue")
                    @foreach($b1 as $b)

                    @if(count($transparency) > 0)
                    @foreach($transparency as $i=>$tran)
                    @if($post->postId == $tran->transparencyPostId && $tran->transparencyLocation == $b)

                    @php $loc = $b; @endphp

                    @endif
                    @endforeach
                    @endif

                    <option value="{{$b}}">{{$b}}</option>
                   

                    @endforeach

                @elseif($post->postCity == "Lapu-Lapu")
                    @foreach($b2 as $b)
                    
                    @if(count($transparency) > 0)
                    @foreach($transparency as $i=>$tran)
                    @if($post->postId == $tran->transparencyPostId && $tran->transparencyLocation == $b)

                    @php $loc = $b; @endphp

                    @endif
                    @endforeach
                    @endif

                    <option value="{{$b}}">{{$b}}</option>

                    @endforeach
                @endif
            </select>
        </form>
        <!-- add record row end-->

        
        <!-- add record -->
        <table style="display:none;">
            @if($l != "")
            <tr>
                <th style="background:white;border:none;">Barangay</th>
                <th style="background:white;border:none;">Date</th>
                <th style="background:white;border:none;">No. of Distribution</th>
                <th style="background:white;border:none;">Amount</th>
            </tr>
            <form action="{{route('transparency2')}}" method="GET">
            @for($i =1; $i <= 1; $i++)
            <input type="hidden" name="menusettings[{{$i}}][postid]" value="{{$post->postId}}">
            <input type="hidden" name="l" id="" value=""> 
            <input type="hidden" name="postid" id="" value="{{$post->postId}}">
            <tr>
                <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][location]" id="" placeholder="Barangay {{$i}}" value="{{$l}}" readonly></td>
                <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][date]" id="" placeholder="Date {{$i}}" value="{{date('F j, Y')}}"></td>
                <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][household]" id="" placeholder="Distributed Count"></td>
                <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][hamount]" id="" placeholder="PHP"><br></td>
            </tr>
            @endfor
            <tr>
                <td style="background:white;border:none;" colspan="4"><button class="btn-delete-yes" type="submit" style="position:relative;float:right;width:100px;">OK</button></td>
            </tr>
            @endif
            </form>
        </table>

        

        <div class="row">
            <div class="col-6">
            @if($l != "")
            <br>
            <label for="">These are the list of recepients in Baranagay {{$l}}:</label>
            @php $id = ""; @endphp
            @if(count($allusers) > 0)
            @foreach($allusers as $a)

                @if(count($transparency) > 0)
                @foreach($transparency as $i=>$tran)
                @if($tran->transparencyHouseholdUserId == $a->id)

                @php $id = $a->id; @endphp

                @endif
                @endforeach
                @endif

                @if($id != $a->id)
                @if($a->accountType == "DONOR" && $a->role != "ADMIN" && $a->id != Auth::user()->id &&$a->barangay == $l)
                <form action="{{route('distributioncontent2')}}">
                    <input type="hidden" name="referenceno" value="{{$postid}}">
                    <input type="hidden" name="recepientid" value="{{$a->id}}">
                    <input type="hidden" name="l" value="{{$l}}">
                    <button type="submit" class="name-1-btn" style="width: 200px;">
                    <div class="content-name-1">
                        <img src="/storage/profile_images/{{$a->profileImage}}" alt="" class="img-content-name-1">
                        {{$a->firstName." ".$a->middleName." ".$a->lastName." ".$a->orgName}}
                    </div>
                    </button>
                </form>
                @endif
                @endif
                
            @endforeach
            @endif

            @endif
            </div>
            <div class="col-6">
            @if($recepientid != "")
            <br>
            <label for="">You have selected:</label>
            @if(count($allusers) > 0)
            @foreach($allusers as $a)
                @if($a->accountType == "DONOR" && $a->role != "ADMIN" && $a->id == $recepientid)
                <br>
                <button type="submit" class="" style="width: auto;border:none;background:none;">
                <div class="">
                    <img src="/storage/profile_images/{{$a->profileImage}}" alt="" class="img-content-name-1">
                    {{$a->firstName." ".$a->middleName." ".$a->lastName." ".$a->orgName}}
                </div>
                </button>
                @endif
            @endforeach
            <div data-toggle="modal" data-target="#mpostModal2-{{$a->id}}" style="width:200px;">
                <input type="hidden" name="postid" value="{{$postid}}">
                <button class="post_donate_button" style="width:200px;">Assign Amount</button>
            </div>


            <!-- Modal OF DONATE BUTTON-->
            <div class="modal fade" id="mpostModal2-{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height:300px;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Distribution</h5>
                            <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times" aria-hidden="true" class="close-btn"></i>
                            </button>
                        </div>

                        <div class="modal-body" style="height:100px;">
                            <form action="/transpayment/" method="GET">
                            <div class="form-group">
                            <label for="amount" style="font-weight:bold;font-size:18px;">Enter Amount:</label><br>
                            PHP <input style="border-radius: 10px;padding:5px;" type="text" name="hamount">
                            <input type="hidden" name="" id="" value="{{$remains}}">
                            </div>
                            <input type="hidden" name="userid" value="{{$recepientid}}">
                            <input type="hidden" name="postid" value="{{$postid}}">
                            <input type="hidden" name="donor" value="{{Auth::user()->id}}">
                            <input type="hidden" name="location" value="{{$l}}">
                            <input type="hidden" name="donation" value="{{$remains}}">
                            <input type="hidden" name="previous_url" value="distribution/my?referenceno={{$postid}}&l={{$l}}">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="width:100%;">Proceed to Payment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /END Modal -->
            @endif
            @endif
            </div>
        </div>
        

        
        <!-- add record end -->
                

    </div>
    <!-- right panel content end -->
</div>

<!-- Modal OF view transparency BUTTON-->
<div class="modal fade" id="thistablehere" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:9999999; position: fixed;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="left:-180px;width:900px;">

            <div class="modal-body" style="">
                <div class="col-12">
                        <!-- update / delete record -->
                        <div class="row">

                            <form action="{{route('transparencyedit')}}" method="GET">
                            <button class="btn-delete-yes" type="submit" style="float:left;display:none;">Update Table</button><br><br>

                                    
                                    <h5 style="text-align:left;font-weight:bold;">
                                    Donations: PHP {{number_format($total,2)}} |  Distributions: PHP {{number_format($transtotal,2)}} | Remaining: PHP @php $remains = $total - $transtotal; @endphp @if($remains < 0) <div style="color:red;">&nbsp;{{number_format($remains,2)}}</div> @else {{number_format($remains,2)}} @endif
                                    </h5><br>
                            
                            <table id="myTable">
                                <tr>
                                    <th style="background:white;border:none;">Barangay</th>
                                    <th style="background:white;border:none;">Date</th>
                                    <th style="background:white;border:none;">Name/Recepient</th>
                                    <th style="background:white;border:none;">Amount (PHP)</th>
                                    <!-- <th style="background:white;border:none;">Remove</th> -->
                                </tr>
                                <div id="edit">
                                    
                                    @if(count($transparency) > 0)
                                    @foreach($transparency as $i=>$tran)
                                    @if($tran->transparencyUserId ==  Auth::user()->id)
                                    <tr>
                                        
                                        <input type="hidden" name="menusettings[{{$i}}][transparencyid]" id="" value="{{$tran->transparencyId}}">
                                        <input type="hidden" name="menusettings[{{$i}}][postid]" id="" value="{{$post->postId}}">

                                        <td style="background:white;border:none;width:200px !important;"><h5>{{$tran->transparencyLocation}}</h5></td>
                                        <td style="background:white;border:none;width:200px !important;"><h6>{{date('F j, Y',strtotime($tran->transparencyCreatedAt))}}</h6></td>
                                        <div style="display:none;">
                                        <td style="display:none;background:white;border:none;width:20px !important;"><input type="text" name="menusettings[{{$i}}][household]" id="" value="{{$tran->firstName.' '.$tran->middleName.' '.$tran->lastName.' '.$tran->orgName}}" style="width:140px;"></td>
                                        <td style="display:none;background:white;border:none;"><input type="text" name="menusettings[{{$i}}][hamount]" id="" value="{{$tran->transparencyAmount}}" style="width:140px;"></td>
                                        </div>
                                        <td style="background:white;border:none;width:200px !important;">{{$tran->firstName.' '.$tran->middleName.' '.$tran->lastName.' '.$tran->orgName}}</td>
                                        <td style="background:white;border:none;width:200px !important;">PHP {{number_format($tran->transparencyAmount,2)}}</td>
                                        </form>



                                        <!-- distribution table delete -->
                                        <!-- <form action="{{route('transparencydelete')}}" method="GET">
                                        <input type="hidden" name="transid"  value="{{$tran->transparencyId}}">
                                        <td style="background:white;"><button type="submit" style="border:none;background:none;font-size:12px;">
                                        <i class="fa fa-trash" aria-hidden="true" style="position:relative; left: 8px; top: -1px;color:red;"></i>
                                        </button></td>
                                        </form> -->

                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                    <tr style="border-top:1px solid black;background:white;font-weight:bold;">
                                                
                                        <td  colspan="3">Total</td>
                                        <td>PHP {{number_format($transtotal,2)}}</td>
                                    </tr>
                                    
                                </div>
                            </table>
                            </form>
                            
                            </div>
                            <!-- update / delete record end -->
                            
                            @if($post->postUserId == Auth::user()->id)
                            <!-- delete  -->
                            <div class="col-1"  style="margin-left:-40px;margin-top:30px; display:none;">
                            <table>
                                <tr>
                                    <th style="background:white;border:none;">Remove</th>
                                </tr>
                                @if(count($transparency) > 0)
                                @foreach($transparency as $i=>$tran)
                                <tr>
                                    <form action="{{route('transparencydelete')}}" method="GET">
                                    <input type="hidden" name="transid"  value="{{$tran->transparencyId}}">
                                    <td style="line-height: 1.88;background-color:white !important;text-align:center;background:white;border:none;"><button type="submit" style="color:red;border:none;background:none;font-size:12px;">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button></td>
                                    </form>
                                </tr>
                                @endforeach
                                @endif
                            </table>
                            <!-- //delete -->
                            @endif
                        </div>
                
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
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