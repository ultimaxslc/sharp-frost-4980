<?php
	
	// Provides access to app specific values such as your app id and app secret.
	// Defined in 'AppInfo.php'
	require_once('AppInfo.php');

	// Enforce https on production
	if (substr(AppInfo::getUrl(), 0, 8) != 'https://' && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
	  header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	  exit();
	}

	// This provides access to helper functions defined in 'utils.php'
	require_once('utils.php');


	/*****************************************************************************
	 *
	 * The content below provides examples of how to fetch Facebook data using the
	 * Graph API and FQL.  It uses the helper functions defined in 'utils.php' to
	 * do so.  You should change this section so that it prepares all of the
	 * information that you want to display to the user.
	 *
	 ****************************************************************************/

	require_once('sdk/src/facebook.php');

	$facebook = new Facebook(array(
	  'appId'  => AppInfo::appID(),
	  'secret' => AppInfo::appSecret(),
	));
	





	$basic = $facebook->api('/ultimaxslc');









	$user_id = $facebook->getUser();
	if ($user_id){
		try {
		    // Fetch the viewer's basic information
		    $basic = $facebook->api('/ultimaxslc');
		  } catch (FacebookApiException $e) {
		    // If the call fails we check if we still have a user. The user will be
		    // cleared if the error is because of an invalid accesstoken
		    if (!$facebook->getUser()) {
		      header('Location: '. AppInfo::getUrl($_SERVER['REQUEST_URI']));
		      exit();
		    }
		}	
	}	

	/*
	$host = ""; //hostname
	$id = ""; //userid
	$f_name = "";
	$l_name = "";
	$email = "";
	$occupation = "";
	$country = "";
	//
	$contactno = "";
	
	//$submission = "";
	//$datetime = "";

	// we need to initialize and use these information eventually because
	// these info are not stored locally on the db
	// at this point of time, they will be taken from the previous page and
	// inserted into our database


	//Step 1: Connect to db (host, username, password)
    $connect = mysql_connect('localhost:8889', 'root', 'root');
    if (!$connect)
     {	die( 'Could not connect: ' .mysql_error() ); };

	//Step 2: Select database
    if (!mysql_select_db('test_db')) {
        die ('Cannot find table: ');
    }
    /*
	//Step 3a: Form the query statement
    $queryStmt = "Select distinct tagID from tag";

	//Step 3b: Query the statement in the database
    $result = mysql_query($queryStmt);
	
	//process the data retrieved
    print'
    <form method = "post" action = "q1result.php">
    <p>Start Date [yyyy-mm-dd]:
    <input type="text" name="start_date" id="start_date" />
    </p>
    <p>End Date    [yyyy-mm-dd]:
    <input type="text" name="end_date" id="end_date" />
    </p>
    <p>Total number(X) of popular tagging keywords:
    <select name="tag_total" id="tag_total">
    <option value ="" selected> -- Select One -- </option>';

    while ($row = mysql_fetch_row($result)){
      print " <option value =$row[0]> $row[0]</option> ";
  	}
  	print'</p>
  	<p>Number:
  	</select>

  	<input type="submit" name="tag_send" id="tag_send" value="Send" /></form>' ;
 	*/
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Download & Play, Feedback & Win!</title>
	<meta name="description" content="Twitter Bootstrap Version2.0 horizontal form layout example from w3resource.com.">
	<!-- This helps to detect and auto adjust to the device scale -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jQuery file goes here-->
	<!--script src="js/jquery.tools.min.js"> </script>
	<!-- the javascript as explained-->
	<!--script src="js/forms.js"></script>
	<!-- This imports the css file. -->
	<link href="stylesheets/bootstrap.css" rel="stylesheet">
	<!-- script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script-->	

</head>


<body>
<script type="text/javascript">
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo AppInfo::appID(); ?>', // App ID
          channelUrl : '//<?php echo $_SERVER["HTTP_HOST"]; ?>/channel.html', // Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true // parse XFBML
        });

        // Listen to the auth.login which will be called when the user logs in
        // using the Login button
        FB.Event.subscribe('auth.login', function(response) {
          // We want to reload the page now so PHP can read the cookie that the
          // Javascript SDK sat. But we don't want to use
          // window.location.reload() because if this is in a canvas there was a
          // post made to this page and a reload will trigger a message to the
          // user asking if they want to send data again.
          window.location = window.location;
        });

        FB.Canvas.setAutoGrow();
      };

      // Load the SDK Asynchronously
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>


<table width="300" border="0" align="center" cellpadding="6" cellspacing="1" bgcolor="#CCCCCC">
	
	<!-- MY FORM BEGINS HERE -->

	<tr>
		<form enctype="multipart/form-data" id="submission" class="form-horizontal" name="submission" method="post" action="submit.php">
			<td>
			<table width = "100%" border = "0" cellpadding = "3" cellspacing = "1">
				<tr>
					<td colspan = "3"><strong><center>Download & Play, Feedback & Win!</center></strong></td>
				</tr>
				<tr>
					<td colspan = "3" width="100%">
						<p align="center">Download any of the software over at developerWorks. Take a spin of the software, and take a screenshot of aspect you wish to feedback!
							Submit your feedback along with screenshot, and stand a chance to win free certification for IBM products!</p>
						<div align = "center"><textarea class="input-xlarge" rows ="5" style="resize:none" placeholder="Feedback goes here!" autofocus></textarea>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan = "2">
					<label class="control-label" for="f_name"> First Name:</label> <input class="input-xlarge" name="f_name" type="text" id="f_name" required="required" value="<?php echo he(idx($basic, 'first_name')); ?>">
					</td>
					<td colspan = "2"><label class="control-label" for="l_name"> Last Name:</label> <input class="input-xlarge" name="l_name" type="text" id="l_name" required="required" value="<?php echo he(idx($basic, 'last_name')); ?>"></td>
				</tr>

				<tr>
					<td colspan = "2">
					<label class="control-label" for="occupation"> Occupation:</label> <input class="input-xlarge" name="occupation" type="text" required="required" id="occupation">
					</td>
					<td><label class="control-label" for="email"> Email:</label> <input class="input-xlarge" name="email" type="email" id="email" required="required" value="<?php echo he(idx($basic, 'email')); ?>"></td>

				</tr>

				<tr>
					<td colspan = "2">
					<label class="control-label" for="country"> Country:</label> <input class="input-xlarge" name="country" type="text" id="country" required="required" value="<?php echo he(idx($basic, 'location')); ?>">
					</td>
					<td><label class="control-label" for="contactno"> Contact No:</label> <input class="input-xlarge" name="contactno" type="text" required="required" id="contactno" value=""></td>

				</tr>

				<tr>
				
					<td colspan = "2">
						<label class="control-label" for="upload">Screenshot Image (image should be < 512 kB)</label>
						<div class="controls">
         	     			<input class="input-file" id="upload" type="file" name="upload" required="required">
          				</div>
					</td>

					<td colspan = "1"><center>
					<label class="control-label" for="select01">How did you know of Download & Play?</label>  
    	        	<select id="select01">  
		                <option>Friends</option>  
	    	            <option>Faculty Email</option>  
	        	        <option>Newsletter</option>  
	            	    <option>Blog</option>  
	                	<option>5</option>  
			            </select></center>
					</td>
				</tr>

				<tr>
					<td colspan = "3"><center><input type ="submit" name="submit" value="Submit!" /></center></td>
				</tr>
			</td>
		</form>
	</tr>


</table>  
</body>


