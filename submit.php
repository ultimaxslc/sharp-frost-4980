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

	// we need to initialize and use these information eventually because
	// these info are not stored locally on the db
	// at this point of time, they will be taken from the previous page and
	// inserted into our database


	//Step 1: Connect to db
    $connect = mysql_connect('localhost', 'root', '');
    if (!$connect)
     {	die( 'Could not connect: ' .mysql_error() ); };

	//Step 2: Select database
    if (!mysql_select_db('youtube')) {
        die ('Cannot find table: ');
    }

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
 ?>
  <br>

-->
<?php 
//This is the directory where images will be saved 
$target = 'uploads/'; 
$target = $target . basename( $_FILES['upload']['name']); 

//This gets all the other information from the form 
$pic=($_FILES['upload']['name']); 


//Writes the photo to the server 
if(move_uploaded_file($_FILES['upload']['tmp_name'], $target)) 
{ 
//Tells you if its all ok 
echo "The file ". basename( $_FILES['upload']['name']). " has been uploaded, and your information has been added to the directory"; 
} 
else { 
//Gives and error if its not 
echo "Sorry, there was a problem uploading your file."; 
} 
?>