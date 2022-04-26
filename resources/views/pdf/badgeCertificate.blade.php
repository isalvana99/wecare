<html>
    <head>
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
                
            }
            body {
                color: black;
                font-family: Georgia, serif;
                font-size: 30px;
                text-align: center;
            }
            .container {
                
                border: 20px solid #64c7fe;
                width: 96%;
                height: 95%;
                vertical-align: middle;
            }
            .logo {
                margin-top:17%;
                color: #64c7fe;
            }

            .marquee {
                color: #64c7fe;
                font-size: 53px;
                margin: 20px;
            }
            .assignment {
                margin: 20px;
            }
            .person {
                border-bottom: 2px solid black;
                font-size: 40px;
                font-style: italic;
                margin: 20px auto;
                width: 400px;
            }
            .reason {
                margin: 20px;
            }
            .badge {
                position:absolute;
                left:70px;
                top:8%;
            }
        </style>
    </head>
    <body>
        @if(count($vars) > 0)
        @foreach($vars as $var)
        <div class="container">
            

            <div class="logo">
                <img src="{{ asset('images/wecarebanner.png') }}" alt="" style="width:300px;">
            </div>

            <div class="marquee">
                Certificate of Achievement
            </div>

            



            <div class="assignment">
                This certificate is presented to
            </div>

            <div class="person">
                {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
            </div>

            
            <div class="reason">
                as ranking No.
                @if($var->badgeType == "GOLD")
                1
                @elseif($var->badgeType == "SILVER")
                2
                @elseif($var->badgeType == "BRONZE")
                3
                @endif
                of 
                @if($var->badgeFilterLocation == "BARANGAY")
                {{$var->barangay}}
                @elseif($var->badgeFilterLocation == "CITY")
                {{$var->city}}
                @endif
                as of {{date('F j, Y', strtotime($var->badgeCreatedAt))}}.
            </div>


            <div class="badge">
                @if($var->badgeType == "GOLD")
                <img src="{{ asset('images/caregold.png') }}" alt="" style="width:200px;">
                @elseif($var->badgeType == "SILVER")
                <img src="{{ asset('images/caresilver.png') }}" alt="" style="width:200px;">
                @elseif($var->badgeType == "BRONZE")
                <img src="{{ asset('images/carebronze.png') }}" alt="" style="width:200px;">
                @endif
            </div>

            
        </div>
        @endforeach
        @endif
    </body>
</html>