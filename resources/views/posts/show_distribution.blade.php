@extends('layouts.user_layout')

@section('content')
<link href="../../style/showdistribution.css" rel="stylesheet" type="text/css" >

<a href="/home/{{$postid}}"><button class="btn-delete-yes" style="position:absolute;width:130px;margin-top:20px;left:25px;"><< Go Back</button></a>
<div class="col-11 center_area_con" style="margin-top:10px;left:8%;">
    <div class="container center_post_area">
        <div class="row center_post_main_con" style="height:auto;">
            <div class="row">
                <div class="col-12">
                    <div class="right_people_content" style="width:1090px;height:auto !important;">
                            @if($post->postUserId == Auth::user()->id)
                                <!-- add record row -->
                                <form action="/show-distribution/my">
                                    Choose Barangay: <input type="hidden" name="postid" value="{{$post->postId}}">
                                    <select class="form-select" style="padding-bottom:2%;width:200px; margin-bottom:10px;border:1px solid gray; border-radius:5px; height:50px;" onchange="this.form.submit()" name="l"> 
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

                                            @if($loc != $b)
                                            <option value="{{$b}}">{{$b}}</option>
                                            @endif

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

                                            @if($loc != $b)
                                            <option value="{{$b}}">{{$b}}</option>
                                            @endif

                                            @endforeach
                                        @endif
                                    </select>
                                </form>
                                <!-- add record row end-->

                                @if($l != "")
                                <!-- add record -->
                                <table>
                                    <tr>
                                        <th style="background:white;border:none;">Date</th>
                                        <th style="background:white;border:none;">Barangay</th>
                                        <th style="background:white;border:none;">No. of Distribution</th>
                                        <th style="background:white;border:none;">Amount</th>
                                    </tr>
                                    <form action="{{route('transparency')}}" method="GET">
                                    @for($i =1; $i <= 1; $i++)
                                    <input type="hidden" name="menusettings[{{$i}}][postid]" value="{{$post->postId}}">
                                    <input type="hidden" name="l" id="" value=""> 
                                    <tr>
                                    
                                        <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][date]" id="" placeholder="Date {{$i}}" value="{{date('F j, Y')}}"></td>
                                        <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][location]" id="" placeholder="Barangay {{$i}}" value="{{$l}}" readonly></td>
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
                                <!-- add record end -->
                                @endif
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-12">
                    <div class="right_people_content" style="border:1px solid black; border-radius:10px; padding: 20px;width:1090px;height:390px !important;">
                        <!-- update / delete record -->
                        <div class="row">
                            <div class="col-11">

                            <form action="{{route('transparencyedit')}}" method="GET">
                            <button class="btn-delete-yes" type="submit" style="float:left;">Update Table</button>

                                    @php $total = 0; @endphp
                                    @if(count($transparency) > 0)
                                    @foreach($transparency as $i=>$tran)
                                        @php $total += ($tran->transparencyHousehold * $tran->transparencyAmount); @endphp
                                    @endforeach
                                    @endif
                                    <div style="text-align:right;font-weight:bold;display:flex;float:right;">
                                    (Grand Total) Donations: PHP {{number_format($post->postReceivedAmount,2)}} |  Distributions: PHP {{number_format($total,2)}} | Remaining: PHP @php $remains = $post->postReceivedAmount - $total; @endphp @if($remains < 0) <div style="color:red;">&nbsp;{{number_format($remains,2)}}</div> @else {{number_format($remains,2)}} @endif
                                    </div><br>
                            
                            <table>
                                <tr>
                                    <th style="background:white;border:none;">Date</th>
                                    <th style="background:white;border:none;">Barangay</th>
                                    <th style="background:white;border:none;">No. of Distribution</th>
                                    <th style="background:white;border:none;">Amount (PHP)</th>
                                    <th style="background:white;border:none;">Total (PHP)</th>
                                </tr>
                                <div id="edit">
                                    
                                    @if(count($transparency) > 0)
                                    @foreach($transparency as $i=>$tran)
                                    <tr>
                                        
                                        <input type="hidden" name="menusettings[{{$i}}][transparencyid]" id="" value="{{$tran->transparencyId}}">
                                        <input type="hidden" name="menusettings[{{$i}}][postid]" id="" value="{{$post->postId}}">

                                        <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][date]" id="" value="{{$tran->transparencyDate}}" style="width:140px;" readonly></td>
                                        <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][location]" id="" value="{{$tran->transparencyLocation}}" style="width:180px;" readonly></td>
                                        <td style="background:white;border:none;width:20px !important;"><input type="text" name="menusettings[{{$i}}][household]" id="" value="{{$tran->transparencyHousehold}}" style="width:140px;"></td>
                                        <td style="background:white;border:none;"><input type="text" name="menusettings[{{$i}}][hamount]" id="" value="{{$tran->transparencyAmount}}"></td>
                                        <td style="background:white;border:none;"><input type="text" name="" id="" value="{{number_format($tran->transparencyHousehold * $tran->transparencyAmount, 2)}}" readonly></td>
                                        
                                    </tr>
                                    @endforeach
                                    @endif
                                    
                                </div>
                            </table>
                            </form>
                            
                            </div>
                            <!-- update / delete record end -->
                            
                            @if($post->postUserId == Auth::user()->id)
                            <!-- delete  -->
                            <div class="col-1"  style="margin-left:-40px;margin-top:30px;">
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
                            </div>
                            <!-- //delete -->
                            @endif
                            </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection