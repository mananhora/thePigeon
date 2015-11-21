<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Pigeon</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        $(document).ready(function(){
            $("#sendButton").click(function(){
                $.ajax({ url: "../server/broadcast.php",
                type: "POST",
                dataType: "text",
                data:{usernameVal: localStorage["userloggedin"], letter: $("#letter").val()},
                success: function(result){
                    alert('Success! LETTER BROADCASTED'+ result);
                    $("#sendLetter").hide();
                    $("#sent").append("A pigeon is on its way to deliver your letter.");
                }});        
            });
       });
    </script>

</head>

<body id="broadcaster">

    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#">The Pigeon</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
			  <ul class="nav navbar-nav">
				<li><a href="#ourmission">About Us</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="#top">Top</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.html"><span class="glyphicon glyphicon-ok padding-icon"></span>Destinations</a>
                    </li>
                    <li>
                        <a href="managefriends.html"><span class="glyphicon glyphicon-star padding-icon"></span>Manage Friends</a>
                    </li>
                    <li>
                        <a href="settings.html"><span class="glyphicon glyphicon-envelope padding-icon"></span>  Settings</a>
                    </li>
					<a href= "broadcast.html"  class="active">
						<button type="button" class="btn btn-default btn-md" id="sidebar-button">
							<span class="glyphicon glyphicon-star padding-icon" aria-hidden="true"></span>
							Create Broadcast
						</button>
					</a>
                </ul>
			</div>
            <!-- /.navbar-collapse -->
        </nav>

        <div class="content-container">
			<div id = "sendLetter">
				<div class="container-fluid">
					<div id="groups">
							<div class="btn-group" id="groupsdropdown">
						  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="groupsbutton">Select Group(s) <span class="caret"></span></button>
						  <ul class="dropdown-menu">

							<li><a href="#" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 1</a></li>	
							<li><a href="#" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 2</a></li>
						
						<li role="separator" class="divider"></li>

							<li><a href="#">Group 1</a></li>
							<li><a href="#">Group 2</a></li>
							<li><a href="#">Group 3</a></li>	

						</ul>
						</div><!-- /btn-group -->
							<div class="btn-group">
						<div class="input-group input-group-lg">
							<input id="groupprint" type="text" class="form-control" placeholder="Groups" aria-describedby="sizing-addon1">					
						</div>
						</div><!-- /btn-group -->	
	
	

					</div>

					<div class="form-group">
						<textarea class="form-control" placeholder="Type your letter here..." id = "letter" name="paragraph_text" cols="10" rows="20"></textarea>
					</div>

					<button id = "sendButton" type="button" class="btn btn-danger custom-button">Send Broadcast!</button>
				</div>
			</div>
            <div id = "sent"></div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#content-container -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
