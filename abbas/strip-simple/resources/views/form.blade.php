<!DOCTYPE html>
<html>
<head>
	<title>Laravel 7 - Integrate Stripe Payment Gateway Example</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style type="text/css">
        .container {
            margin-top: 40px;
        }
        .panel-heading {
        display: inline;
        font-weight: bold;
        }
        .flex-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 55%;
        }
    </style>
</head>
<body>
  
<div class="container">  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row text-center">
                        <h5 class="panel-heading">Your information</h5>
                    </div>                    
                </div>
                <div class="panel-body">
  
                  
  
                    <form role="form" action="/data" method="get" >
                        
  
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Amount</label> <input
                                    autocomplete='off' value ="20" name="am" class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>night</label> <input
                                    autocomplete='off' value ="10" name="nights" class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>water</label> <input
                                    autocomplete='off' value ="20" name="water" class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Food</label> <input
                                    autocomplete='off' value ="20" name="food" class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Medical</label> <input
                                    autocomplete='off' value ="20" name="med" class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>educ</label> <input
                                    autocomplete='off' value ="20" name="edu" class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>We</label> <input
                                    autocomplete='off' value ="20" value="" name="we" class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>date</label> <input
                                    class='form-control' name="fdate" value="{{date('Y-m-d')}}" date="date"
                                    type='date'>
                            </div>
  
                        
  
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-danger btn-lg btn-block" type="submit">Submit</button>
                            </div>
                        </div>
                          
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>
  
</body>
  

</html>