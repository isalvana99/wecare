@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <div class="row top_search_area" >
            <div class="col-7" style="margin:auto !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" class="form-control" placeholder="Search" aria-label="" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" style="display: none;">Search

                        </button>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <img src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="" class="profile_img_top">
            </div>
        </div>
        <!-- /topbar here -->

        <!-- body here -->
        <div class="row">
          <div class="message_con">
              <div class="row msg_row">
                      
                <div class="col-4 right_msg_con">  

                  <form action="{{ route('Users Inquiries') }}" method="GET">
                  <div class="row search_con" >
                      <div class="row" >
                      <div class="col-12" style="margin-top:10px !important;">
                          <div class="input-group mb-4"  style=" margin-top:-11px;">
                          <input type="hidden" name="selected_tile" value="Users Inquiries">
                          <input type="search" class="form-control search_input" placeholder="Search message" aria-label="" name="searchmsg" aria-describedby="basic-addon2" onclick="submit_form()" value="{{$search}}">
                          <div class="input-group-append">
                              <button type="submit" class="btn btn-outline-secondary" type="button" style="height:40px;;margin-top:-1px;width:30px;" ><i class="fa fa-search" aria-hidden="true" style="color:white;"></i></button>
                          </div>
                          </div>
                      </div>
                      </div>
                  </div> 
                  </form>

                  <div class="row right_msg_content">
                    <!-- left side message name list -->
                    @php $firstID = ""; @endphp

                    <!-- clicked from search -->
                    @if($selected_from_all != "")
                    @foreach($all as $p)
                      @if($selected_from_all == $p->id)
                        <input type="hidden" name="selected_tile" value="Users Inquiries">
                        <input type="hidden" name="selected_person_id" value="{{$p->id}}">
                        <button class="left_msg_white_con" style="padding-top:-5px;">
                          
                            <div class="row msg_active_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                          

                            <div class="col-3">
                                <img class="right_img_user" src="/storage/profile_images/{{$p->profileImage}}" alt="">
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <label for="" class="right_name">{{$p->firstName." ".$p->middleName." ".$p->lastName." ".$p->orgName}}</label>
                                </div>
                                <div class="row">
                                  <label for="" class="right_time">No message yet.</label>
                                </div>
                            </div>
                            <div class="col-1">
                                
                            </div>
                        </div> <!-- active chat end -->
                        </button>
                        @php $count = 2; @endphp
                        @php $firstID = $p->id; @endphp
                      @endif
                    @endforeach
                    @endif
                    <!-- /clicked from search -->

                    <!-- display names available in message inbox -->
                    @if(count($unique) > 0)
                      @foreach($unique as $p)

                      @if($p->inquiryUserId != $firstID)
                        <form style="width:675px;margin-top:-5px;" action="{{route('Users Inquiries')}}" method="GET">
                        <input type="hidden" name="msgid" value="{{$p->inquiryId}}">
                        <input type="hidden" name="selected_tile" value="Users Inquiries">
                        <input type="hidden" name="selected_person_id" value="{{$p->inquiryUserId}}">
                        <button type="submit" class="left_msg_white_con" style="padding-top:-5px;">
                          @if($selected_from_all == $p->inquiryUserId)
                            <div class="row msg_active_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                            @php $firstID = $p->inquiryUserId; @endphp
                          @elseif($count == 1)
                          <div class="row msg_active_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                            @php $firstID = $p->inquiryUserId; @endphp
                          
                          @elseif($selected_person_id == $p->inquiryUserId)
                          <div class="row msg_active_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                            @php $firstID = $p->inquiryUserId; @endphp
                          @else
                          <div class="row msg_info_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                          @endif

                            <div class="col-3">
                                <img class="right_img_user" src="/storage/profile_images/{{$p->profileImage}}" alt="">
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <label for="" class="right_name">{{$p->firstName." ".$p->middleName." ".$p->lastName." ".$p->orgName}}</label>
                                </div>
                                <div class="row">
                                    @if(date('h:m A', strtotime($p->inquiryCreatedAt)) == date("Y-m-d"))
                                    <label for="" class="right_time">{{date('h:m A', strtotime($p->inquiryCreatedAt))}}</label>
                                    @else
                                    <label for="" class="right_time">{{date('F j, Y', strtotime($p->inquiryCreatedAt))}}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-1">
                                @php $num = 0; @endphp
                                @if($p->inquiryStatus == "UNREAD")
                                    @php $num = 4; @endphp
                                @endif
                                @if($num == 4)
                                <div class="unread_dot">
                                <!-- show this to unread messages -->
                                </div>
                                @endif
                            </div>
                        </div> <!-- active chat end -->
                        </button>
                        </form>
                        @php $count = 2; @endphp

                      @endif
                      @endforeach



                      @if($search != "")

                        @php $nameid = 0; @endphp
                        @foreach($all as $a)
                        @foreach($unique as $p)
                        
                          @if($a->id != Auth::user()->id)

                            @if($a->id == $p->inquiryUserId)
                              @php $nameid = $p->inquiryUserId; @endphp
                            @endif

                          @endif
                        @endforeach

                        @if($a->id != Auth::user()->id)
                          @if($a->id == $nameid)
                          @else
                                <form style="width:675px;;margin-top:-5px;" action="{{route('Users Inquiries')}}" method="GET">
                                <input type="hidden" name="msgid" value="{{$p->inquiryId}}">
                                <input type="hidden" name="selected_tile" value="Users Inquiries">
                                <input type="hidden" name="selected_from_all" value="{{$a->id}}">
                                <button type="submit" class="left_msg_white_con" style="padding-top:-5px;">

                                @if($count == 1)
                                <div class="row msg_active_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                                  @php $firstID = $a->id; @endphp
                                
                                @elseif($selected_person_id == $a->id)
                                <div class="row msg_active_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                                  @php $firstID = $a->id; @endphp
                                @else
                                <div class="row msg_info_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                                @endif
                                  

                                    <div class="col-3">
                                        <img class="right_img_user" src="/storage/profile_images/{{$a->profileImage}}" alt="">
                                    </div>
                                    <div class="col-7">
                                        <div class="row">
                                            <label for="" class="right_name">{{$a->firstName." ".$a->middleName." ".$a->lastName." ".$a->orgName}}</label>
                                        </div>
                                        <div class="row">
                                          <label for="" class="right_time">No message yet.</label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                      
                                    </div>
                                </div> <!-- active chat end -->
                                </button>
                                </form>
                                @php $count = 2; @endphp
                          @endif
                          @php $nameid = 0; @endphp
                        @endif
                        @endforeach
                      @endif


                    @else

                    
                      @if(count($all) > 0)
                        @foreach($all as $a)
                          @if($a->id != Auth::user()->id)
                            <form style="width:675px;margin-top:-5px;" action="{{route('Users Inquiries')}}" method="GET">
                            <input type="hidden" name="msgid" value="{{$a->inquiryId}}">
                            <input type="hidden" name="selected_tile" value="Users Inquiries">
                            <input type="hidden" name="selected_from_all" value="{{$a->id}}">
                            <button type="submit" class="left_msg_white_con" style="padding-top:-5px;">
                            
                              @if($count == 1)
                              <div class="row msg_active_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                                @php $firstID = $a->id; @endphp
                              
                              @elseif($selected_person_id == $a->id)
                              <div class="row msg_active_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                                @php $firstID = $a->id; @endphp
                              @else
                              <div class="row msg_info_con" style=""> <!-- this is active chat design use msg_active_con to change design --start -->
                              @endif

                                <div class="col-3">
                                    <img class="right_img_user" src="/storage/profile_images/{{$a->profileImage}}" alt="">
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <label for="" class="right_name">{{$a->firstName." ".$a->middleName." ".$a->lastName." ".$a->orgName}}</label>
                                    </div>
                                    <div class="row">
                                      <label for="" class="right_time">No message yet.</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    
                                </div>
                            </div> <!-- active chat end -->
                            </button>
                            </form>
                            @php $count = 2; @endphp
                          @endif
                        @endforeach
                      @endif
                      
                    @endif
                    <!-- /display names available in message inbox -->

                  </div>
                  <!-- /left side message name list -->

                </div>


                  <!-- name of the message box convo/selected -->
                <div class="col-8 left_msg_con" >
                  
                  @if($selected_from_all != "")
                    
                    @foreach($all as $p)
                      @if($selected_from_all == $p->id)
                      <div class="row top_info">
                        <label for="" class="top_info_name">{{$p->firstName." ".$p->middleName." ".$p->lastName." ".$p->orgName}}</label>
                      </div>
                      @endif
                    @endforeach
                    
                  @else
                    @if(count($all) > 0)
                      @foreach($all as $p)
                          @if($firstID == $p->id)
                          <div class="row top_info">
                              <label for="" class="top_info_name">{{$p->firstName." ".$p->middleName." ".$p->lastName." ".$p->orgName}}</label>
                          </div>
                        @break
                        @elseif($selected_person_id == $p->id)
                        <div class="row top_info">
                            <label for="" class="top_info_name">{{$p->firstName." ".$p->middleName." ".$p->lastName." ".$p->orgName}}</label>
                        </div>
                        @break
                        @else
                        @endif
                      
                        @php $count2 = 2; @endphp
                      @endforeach
                    @else
                      <div class="row top_info">
                          <label for="" class="top_info_name" style="width:700px;color:white;">Empty</label>
                      </div>
                    @endif
                  @endif
                  <!-- /name of the message box convo/selected -->

                  <!-- the message area box/convos -->
                  <div class="convo_area" style="">

                      @if(count($vars) > 0)
                      @foreach($vars as $var)

                        @if($selected_person_id == "")
                          @if($var->inquiryUserId == $firstID && $var->inquiryMessage != "")
                            <div class="user_msg_con" > <!-- user message start here -->
                              <div class="row" >
                                  <div class="col-1">
                                    <img src="/storage/profile_images/{{$var->profileImage}}" class="left_img_user" alt="">
                                  </div>
                                  <div class="col-7" >
                                    <div class="row">
                                        <div class="col info-msg-user">
                                            <small class="user-msg-name">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</small>
                                            <small class="user-msg-time">{{date('h:m A', strtotime($var->inquiryCreatedAt))}}</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="" class="user_msg_body">{{$var->inquiryMessage}}</label>
                                    </div>
                                  </div>
                              </div>
                            </div><!-- user end here -->
                            @elseif($var->role == "ADMIN" && $var->inquirySentToId == $firstID && $var->inquiryMessage != "")
                            <div class="admin_msg_con"> <!-- admin message start here -->
                              <div class="row" >
                                <div class="col-4"></div>
                                <div class="col-7" style="padding-right: 27px;">
                                  <div class="row admin_msg_info">
                                      <div class="col info-msg-user">
                                          <small class="user-msg-name">{{$var->id." ".$var->firstName}}</small>
                                          <small class="user-msg-time">{{date('h:m A', strtotime($var->inquiryCreatedAt))}}</small>
                                      </div>
                                  </div>
                                  <div class="w-100"></div>
                                  <br>
                                  <div class="row admin_msg_content" >
                                      <label for="" class="admin_msg_body">{{$var->inquiryMessage}}</label>
                                  </div>
                                </div>
                                <div class="col-1">
                                  <img src="/storage/profile_images/{{$var->profileImage}}" class="left_img_admin" alt="">
                                </div>
                              </div>
                            </div> <!-- admin message end here -->
                            @endif

                        @else

                            @if($var->inquiryUserId == $selected_person_id && $var->inquiryMessage != "")
                            <div class="user_msg_con" > <!-- user message start here -->
                              <div class="row" >
                                  <div class="col-1">
                                    <img src="/storage/profile_images/{{$var->profileImage}}" class="left_img_user" alt="">
                                  </div>
                                  <div class="col-7" >
                                    <div class="row">
                                        <div class="col info-msg-user">
                                            <small class="user-msg-name">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</small>
                                            <small class="user-msg-time">{{date('h:m A', strtotime($var->inquiryCreatedAt))}}</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="" class="user_msg_body">{{$var->inquiryMessage}}</label>
                                    </div>
                                  </div>
                              </div>
                            </div><!-- user end here -->
                            @elseif($var->role == "ADMIN" && $var->inquirySentToId == $selected_person_id && $var->inquiryMessage != "")
                            <div class="admin_msg_con"> <!-- admin message start here -->
                              <div class="row" >
                                <div class="col-4"></div>
                                <div class="col-7" style="padding-right: 27px;">
                                  <div class="row admin_msg_info">
                                      <div class="col info-msg-user">
                                          <small class="user-msg-name">{{$var->firstName}}</small>
                                          <small class="user-msg-time">{{date('h:m A', strtotime($var->inquiryCreatedAt))}}</small>
                                      </div>
                                  </div>
                                  <div class="w-100"></div>
                                  <br>
                                  <div class="row admin_msg_content" >
                                      <label for="" class="admin_msg_body">{{$var->inquiryMessage}}</label>
                                  </div>
                                </div>
                                <div class="col-1">
                                  <img src="/storage/profile_images/{{$var->profileImage}}" class="left_img_admin" alt="">
                                </div>
                              </div>
                            </div> <!-- admin message end here -->
                            @endif
                        @endif
                      @php $count3 = 2; @endphp
                      @endforeach

                      @else
                      @endif

                  </div>
                  <!-- /the message area box/convos -->

                  <!-- this is the send button -->
                  <form action="{{route('inquiryToUser')}}" method="GET">
                  <div class="row type_area">
                  <div class="col-9" >
                      <input type="hidden" name="sentTo" value="{{$selected_person_id == '' ? $firstID : $selected_person_id}}">
                      <textarea type="text" name="inquirymessage" rows="4"class="message-input" placeholder="Ask your question..."></textarea>
                  </div>
                  <div class="col-3 btn_send_con">
                      <button type="submit" class="btn-msg-submit">
                          <i class="fas fa-paper-plane"></i>
                          Send
                      </button>
                  </div>
                  </div>
                  </form>
                  <!-- /this is the send button -->
                </div>
          </div>
      </div>
        <!-- /body here -->
    </div>
</div>
<!-- /big container (this is for the content) -->
@endsection