@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm" id="side_note">
            <div class="reg_title">
                
            @if($errors->any())
            <h4 style="color:red">{{$errors->first()}}</h4>
            @endif

                No Account? Register Now,
            </div>

            <div class="note">
                and help make the world a better place
            </div>

            <div class="btn_grp">
                <a href="{{ route('register') }}"><button style="width:250px;">Register as an Individual</button></a>
                <div class="w-100"></div>
                <label for="" class="">or</label>
                <div class="w-100"></div>
                <a href="{{ route('register_org') }}"><button style="width:250px;">Register as an Organization</button></a>
            </div>
        </div>

        <div class="col-sm">
            <img src="images/wecareloginillu.png" alt="" id="wecarelog_img" class="img-fluid">
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="row center_row_home">
                <div class="col-12">
                    <label for="" class="title_home_pg about_view">About</label>
                </div>

                <div class="col-12">
                    <label for="" style="font-size:22px; color:#2a2d5a;margin-top:20px;">What we do?</label>
                    <p> 
                        WeCare is an essential platform that serves as an online hub for donors and organizations/recipients that are victims of different calamities and tragedies or any other uncertainties that seeks for financial help. We're focused on helping and bridging individuals to extend any amount of donation that will be beneficial to the ones who are in need. We are here to help guaranteeing that "hope in a tap" to make this world not just a better place but the best place to live in.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
