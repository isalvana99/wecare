@extends('layouts.topbar_users')
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #2f335c;
  color: white;
}
</style>

@section('content')
Your Transaction History:
    <table id="customers">
        <tr>
            <th>Date Donated</th>
            <th>Recepient</th>
            <th>GCash Number</th>
            <th>Date of Post</th>
            <th>Amount Donated</th>
        </tr>
      @if(count($tran) > 0)
      @foreach ($tran as $var)
      <tr>
          
                <td>{{date('F j, Y', strtotime($var->transactionCreatedAt))}}</td>
                <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>
                <td>{{$var->phoneNumber}}</td>
                <td>{{date('F j, Y', strtotime($var->postCreatedAt))}}</td>
                <td>Php {{number_format((float)$var->transactionAmount, 2, '.', '')}}</td>
            </tr>
      @endforeach
      @else
      <tr>
                <td colspan="10" style="text-align:center">No Record.</td>
            </tr>
      @endif
      </table>
@endsection