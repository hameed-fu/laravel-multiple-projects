<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style type="text/css">
      
    </style>
</head>
<body>
  
<div class="container">  
    <h1>Information</h1>
    <div class="row">
        <table class="table table-hover">
            <tr>
            
                <th>#</th>
                <th>Title</th>
                <th>FName</th>
                <th>LName</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Amount</th>
                <th>Card Holder</th>
            </tr>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->fname }}</td>
                <td>{{ $row->lname }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->contact }}</td>
                <td>{{ $row->amount }}</td>
                <td>{{ $row->card_holder }}</td>
            @endforeach
            </tr>
        </table>
    </div>
</div>
  
</body>
  

</html>