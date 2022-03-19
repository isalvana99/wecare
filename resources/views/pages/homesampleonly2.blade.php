
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/navstyle3.css" rel="stylesheet" type="text/css" >
    <link href="../../style/viewpost.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Username here</title>
</head>
<body>

    <div class="sticky-top">
     @extends('layouts.usertopnav')
    </div>

    <div class="con post_main_view">
        <div class="con1" >
            <div class="row view_post_row1">
                <div class="col-8w">
                    <div class="row view_post_left_row">
                        <img src="../../images/report1.jpg" alt="" class="view_post_img">
                    </div>
                </div>
                <div class="w-100 seperator"></div>
                <div class="col-4w">
                    <div class="row view_post_right_row">
        	            <div class="con">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../../images/app3.jpg" class="view_right_user_pic" alt="">
                                </div>
                                <div class="col-10 view_post_col_user">
                                    <div class="row">
                                        <a href="" class="view_post_user_name">Jenie Ann Galagar</a>
                                    </div>
                                    <div class="row">
                                        <a href="" class="view_post_i">
                                            <i class="fal fa-map-marker-alt"></i>
                                            1160 Barrington Court
                                        </a>
                                    </div>
                                    <div class="row">
                                        <a href="" class="view_post_i">
                                            <i class="fal fa-list-ul"></i>
                                            Memorial
                                        </a>
                                    </div>
                                    <div class="row">
                                        <a href="" class="view_post_i">
                                            <i class="fal fa-clock"></i>
                                            12 hours ago
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row view_post_caption">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nam libero justo laoreet sit amet cursus. Odio ut enim blandit volutpat maecenas volutpat blandit aliquam. Mauris vitae ultricies leo integer malesuada nunc. Risus nec feugiat in fermentum posuere urna nec tincidunt praesent. Non nisi est sit amet facilisis magna etiam tempor. Cursus eget nunc scelerisque viverra mauris in aliquam sem fringilla. Aliquet nibh praesent tristique magna sit amet. Amet justo donec enim diam. Leo vel orci porta non pulvinar neque laoreet.
                            </div>

                            <hr>

                            <div class="row react_button_row">
                                <div class="col-4 button_react_con">
                                    <button class="react_btn_active">
                                        <img src="../../images/wecare svg.svg" class="wecarelogo_svg" alt="">
                                        <a href="">0000</a>
                                    </button>
                                </div>
                                <div class="col-4 button_react_con">
                                    <button class="react_btn_active">
                                        <i class="fas fa-comment-alt"></i>
                                        <a href="">0000</a>
                                    </button>
                                </div>
                                <div class="col-4 button_react_con">
                                    <button class="react_btn_style">
                                        <i class="fas fa-share"></i>
                                        <a href="">0000</a>
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <div class="row view_post_comment_con">
                                <div class="container">

                                    <div class="row row_comment_con">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="../../images/app3.jpg" class="view_commentor_pic" alt="">
                                            </div>
                                            <div class="col-10 view_add_comment">
                                                <button data-toggle="modal" data-target="#exampleModalCenter">
                                                    Add comment
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- comment container -->
                                    <div class="row row_comment_con">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="../../images/app3.jpg" class="view_commentor_pic" alt="">
                                            </div>
                                            <div class="col-8 commentor_details">
                                                <div class="row view_commentor_name">
                                                    Demmy Joseeiih Dalumpenis
                                                </div>
                                                <div class="row view_commentor_time">
                                                    bout a week ago
                                                </div>
                                            </div>
                                            <div class="col-1 view_dots_btn">
                                                <button data-toggle="modal" data-target="#exampleModalCenter1">
                                                    <i class="far fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 view_commentor_caption">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero nunc consequat interdum varius sit amet mattis.
                                        </div>
                                    </div>
                                    <!-- comment end -->

                                                                        <!-- comment container -->
                                    <div class="row row_comment_con">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="../../images/app3.jpg" class="view_commentor_pic" alt="">
                                            </div>
                                            <div class="col-8 commentor_details">
                                                <div class="row view_commentor_name">
                                                    Demmy Joseeiih Dalumpenis
                                                </div>
                                                <div class="row view_commentor_time">
                                                    bout a week ago
                                                </div>
                                            </div>
                                            <div class="col-1 view_dots_btn">
                                                <button data-toggle="modal" data-target="#exampleModalCenter1">
                                                    <i class="far fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 view_commentor_caption">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero nunc consequat interdum varius sit amet mattis.
                                        </div>
                                    </div>
                                    <!-- comment end -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add comment Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Type your comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea class="add_comment_modal" name="" id="" cols="58" rows="7" placeholder="Anong latest"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary primary_btn">Save changes</button>
        <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- add comment modal end -->

    <!-- comment option Modal -->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<!-- comment optionmodal end -->


    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- custom scrollbar plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>