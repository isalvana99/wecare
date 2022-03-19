@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm" id="side_note">
            <div class="reg_title">
                
            @if($errors->any())
            <h4 style="color:red">{{$errors->first()}}</h4>
            @endif

                Register Now!
            </div>

            <div class="note">
                and help make the world a better place
            </div>

            <div class="btn_grp">
                <a href="{{ route('register') }}"><button>Register Now</button></a>
                <div class="w-100"></div>
                <label for="" class="qu">Have an Organization?</label>
                <div class="w-100"></div>
                <a href="{{ route('register_org') }}"><button>Register your Organization</button></a>
            </div>
        </div>

        <div class="col-sm">
            <img src="images/wecareloginillu.png" alt="" id="wecarelog_img" class="img-fluid">
        </div>
    </div>
</div>
@endsection
