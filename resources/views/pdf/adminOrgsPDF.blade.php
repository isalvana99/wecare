<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Recepients Record</title>
  </head>
  <style>
    body{
      margin: 2;
      padding: 0;
    }
    #table {
      border-spacing: 0;
      font-family: "Times New Roman";
      width: 100%;
      font-size: 16px;
    }

    #table td, #table th {
      border: 1px solid #a1a1a1;
      padding: 7px;
    }

    #table tr:nth-child(even){background-color: #f2f2f2;}

    #table th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: center;
      color: black;
    }

    .titlebody {
      position: relative;
      text-align: center;
    }

    .label {
      font-family: "Times New Roman";
      line-height: 0.8;
      font-size: 16px;
    }
    
    .logo {
      padding: 15px;
      padding-left: 120px;
      width: 75px;
      height: 75px;
      position: absolute;
    }

    #pdfcat {
      font-size: 18px;
    }
    #number, td {
      font-size: 16px;
      font-family: "Times New Roman";
    }
  </style>
  <body>
    <div class="container">

        <div class="titlebody">
          <img src="{{ asset('images/wecarelogo blue.png') }}" class="logo"/>
          <div class="label">
            <h1>WeCare</h1>
            <span>A. C. Cortes Ave, Mandaue City, 6014, Cebu, Philippines</span>
            <p id="pdfcat">RECEPIENTS RECORD</p>
          </div>
        </div>

        <div class="col" id="number">
          <!--  counting number of items in a loop -->
          @if(count($vars) > 0)
              No. of Recepients:
              @foreach($vars as $count=>$var)
              @endforeach
              {{$count+=1}}
          @else
            No. of Recepients: 0
          @endif
        </div>
          <table id="table">
            <thead>
              <tr>
              <th scope="col">Account ID</th>
                      <th scope="col">Recepients Name</th>
                      <th scope="col">License No.</th>
                      <th scope="col">Address</th>
                      <th scope="col">GCash Number</th>
                      <th scope="col">Received</th>
                      <th scope="col">Account Status</th>
              </tr>
            </thead>
            
            <tbody>
            @if(count($vars) > 0)
            @foreach($vars as $var)
              <tr>
                      <td style="text-align:center;">{{$var->id}}</td>
                      <td>{{$var->orgName}}</td>
                      <td>{{$var->license}}</td>
                      <td>{{$var->sector.", ".$var->barangay.", ".$var->city.", ".$var->province.", ".$var->region}}</td>
                      <td>{{$var->phoneNumber}}</td>
                      <td>
                        @php $total = 0; @endphp
                        @if(count($received) > 0)
                        @foreach ($received as $var3)
                        @if($var3->postUserId == $var->id)
                            @php $total += $var3->transactionAmount; @endphp
                        @endif
                        @endforeach
                        @endif
                        PHP {{number_format($total, 2)}}
                      </td>
                      <td>{{$var->accountVerified}}</td>
                
              </tr>
              <!-- page number -->
              <div id="footer">
                <script type="text/php">
                  if (isset($pdf))
                  {
                      $font = $fontMetrics->get_font("Times New Roman", "normal");
                      $pdf->page_text(710, $pdf->get_height() - 30, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0.300, 0.300, 0.300));
                  }
              </script>
              </div> 
              <!-- page number -->
              @endforeach
              @else
              <tr>
                  <td colspan="11" style="text-align:center">No Record.</td>
              </tr>
              @endif
            </tbody>
          </table>
    </div>
  </body>
</html>