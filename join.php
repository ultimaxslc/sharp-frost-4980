<!-- ?php
	$host = ""; //hostname
	$id = ""; //userid
	$f_name = "";
	$l_name = "";
	$email = "";
	$occupation = "";
	$country = "";
	$howknow = "";
	$id = "";
	$contactno = "";
	
	$submission = "";
	$datetime = "";
	$screenshot ="";

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

-->
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
</head>



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
					<label class="control-label" for="f_name"> First Name:</label> <input class="input-xlarge" name="f_name" type="text" id="f_name" required="required" value="From Graph API">
					</td>
					<td colspan = "2"><label class="control-label" for="l_name"> Last Name:</label> <input class="input-xlarge" name="l_name" type="text" id="l_name" required="required" value="From Graph API"></td>
				</tr>

				<tr>
					<td colspan = "2">
					<label class="control-label" for="occupation"> Occupation:</label> <input class="input-xlarge" name="occupation" type="text" required="required" id="occupation">
					</td>
					<td><label class="control-label" for="email"> Email:</label> <input class="input-xlarge" name="email" type="email" id="email" required="required" value="From Graph API"></td>

				</tr>

				<tr>
					<td colspan = "2">
					<label class="control-label" for="country"> Country:</label> <input class="input-xlarge" name="country" type="text" id="country" required="required" value="From Graph API">
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

<script> 
	$("submission").validator(); 
	// initialize validator for a bunch of input fields
  	var inputs = $("#form :input").validator();
 
  	// perform validation programmatically
  	inputs.data("validator").checkValidity();



</script>


  