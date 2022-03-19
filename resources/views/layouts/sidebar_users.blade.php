<div class="left-menu">
    <div class="profile-con">
        <div>
            <div class="">
                <label for="" style="text-align: center;">{{Auth::user()->firstName." ".Auth::user()->middleName." ".Auth::user()->lastName." ".Auth::user()->orgName}}
                </label>
            </div>              
        </div>
    </div>
    <h3>Total Received: {{Auth::user()->amountReceived}}</h3>
        <h3>Total Donated: {{Auth::user()->amountGiven}}</h3> 
</div>