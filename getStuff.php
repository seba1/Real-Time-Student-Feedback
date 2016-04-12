<?php
// Name  : 	Sebastian Horoszkiewicz
// Date  : 	11.05.2014
// ID	 :	C00156243
//Purpose:  SSE will access this file each time and pull new information from it
header('Connection: keep-alive');
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include 'db.php';
//get values from db
$sql="SELECT * FROM Totals
	  WHERE sessionID IS NOT NULL";
$result=mysqli_query($con,$sql);
if( ! $result = mysqli_query($con,$sql)) {
	echo "Mysql error: " . mysqli_error($con);

	}
	
$sessionId = "";
$allText="";
//store all values into array 
while ($row = mysqli_fetch_array($result))
{
	$answers=array(
	$row['ans1'], $row['ans2'],
	$row['ans3'], $row['ans4'],
	$row['ans5'], $row['ans6'],
	$row['ans7'], $row['ans8'],
	$row['ans9'], $row['ans10'], "");

	$sessID=$row['sessionID'];
	if($alltext!='')
		$alltext=$alltext.','.$sessID;
	else
		$alltext=$sessID;
	for($i=0; $answers[$i]!=""; $i++) 
	{	//put "," character between all values
		$alltext=$alltext.','.$answers[$i];
	}
}
	echo "data:{$alltext}\n\n";//send back data
flush();
?>