<?php header('Content-type: text/html; charset=utf-8'); ?>
<!-- Name: 	Sebastian Horoszkiewicz -->
<!-- Date: 	02.05.2014 -->
<!-- ID	 :	C00156243 -->
<?php
	include '../db.php';
	session_start();
	$answers = $_SESSION['ansArr'];//retrieve values from $_SESSION
	$sessionId = $_SESSION['sesIdTC'];
	$question = $_SESSION['quest'];

	setcookie($sessionId, "1", time()+60*60*24 , '/', 'everythingineed.x10host.com' ); //set cookie which will expire after 24hours
	$sql="SELECT passwd
		  FROM CRUD_QAndAnswer
		  WHERE sessionID = '$sessionId'";//get password assigned to that id
	$result=mysqli_query($con,$sql);
	if( ! $result = mysqli_query($con,$sql)) {
		echo "Mysql error: " . mysqli_error($con);
	}
	$row = mysqli_fetch_array($result);
	$psw="";
	$psw= $row['passwd'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chart</title>
	<link href="../main.css" rel="stylesheet" type="text/css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
	<script language="javascript" type="text/javascript" src="../jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="../jquery.flot.pie.js"></script>
</head>
<body>
<div data-role="page" style="text-align: center;">	
	<div data-role="header" data-theme="b" data-position="inline">
	<h1>Chart</h1>
	</div>
	<center><h1> Question ID: <?php echo $sessionId; ?>
		<div id="divForPsw"></div>
	</h1></center>
	Question: <?php echo $question ?>
	<div id="divForWait"></div>
	<div id="divForNumOfA"></div>
	<div id="divForChart"></div>
	<div style="margin-right:7%; margin-left:7%; text-align:left;">
		<div id="labeler"></div>
		<br><br>
		<button data-theme="b" class="mybtn" name="sbmBtn" id="sbmBtn" value="QSess">Quit</button>
	</div>
</div>
<?php
//if password exist display it on the screen
if($psw!="")
{
	?>
	<script> 	
	var pdiv = $("<div id=\"pass\">Password: <?php echo $psw ?></div>");
	$("#divForPsw").append(pdiv);
	</script>
	<?php
}
?>
<script>
$(document).on('click', '#sbmBtn', function() {
    window.location = '/';//when user clicks on quit button bring him back to homepage
});
$(document).ready(function () 
{	//check does sse supports browser used
	if(typeof(EventSource)!=="undefined")
	{
		var source=new EventSource("../getStuff.php"); //set source
		source.onmessage=function(event) 
		{	//when data comes do the following..
			var myData = event.data; //get data from the source file
			var sessID='<?php echo $sessionId;?>';
			var substr = myData.split(',');//store values into array, .split will put every value after "," to new array position
			var indexID=0;
			//this loop... looks for session ID assigned to current session in substr array, position i+1 from session ID == first value of our answer results
			//so i will be used in another loop under that loop to count results going i+1 up to and including last answer result
			for(var i=0; substr[i-1]!=sessID; i++){}//probably I could do it another way... next time
			var dataSet = [], series = 10; //create empty array with (hard coded) 10 series (need to change..) (for chart)
			var labelForChart = <?php echo json_encode($answers); ?>; // store answers array (with answers) into js array
			var arrLen = labelForChart.length;
			var countEmpty=0;
			var totalNumOfAnswers=0;
			//and now, mentioned above for loop which will put labels and results(data) into the chart
			for(var c=0; c!=arrLen; c++)
			{
				var numOfAnsForQ = Number(substr[i]);
				if(!isNaN(numOfAnsForQ))
					totalNumOfAnswers = parseInt(totalNumOfAnswers)+parseInt(numOfAnsForQ);//count answers
				//'if' below will count results where answers submitted == 0
				if(numOfAnsForQ==0)
					countEmpty++;
				dataSet[c] = 
				{
					label: labelForChart[c] ,
					data: numOfAnsForQ
				}
				i++;
			}
			<!--flot charts: http://www.flotcharts.org/flot/examples/-->
			//creates chart
			var options = {
				series: {
					pie: {
						show: true,
						label: {
							show: true,
							radius:2/3,
							formatter: function (label, series) {
								return '<div style="border:1px solid grey;font-size:9pt;text-align:center;padding:5px;color:white;">' +
								Math.round(series.percent) + '%</div>';
							},
							background: {
								opacity: 0.8,
								color: '#000'
							}
						}
					}
				},
				legend:{
					show: true, 
					container: '#labeler',	
                    noColumns: 2, // number of colums in legend table
                    labelBoxBorderColor: "#ffffff", // border color for the little label boxes
				},
				grid: {
					hoverable: false
				}
			};
			//depending on window size choose appropriate chart size
			var windowsize = $(window).width();
			if (windowsize < 550) 
				var div = $("<div id=\"flot-placeholder\" style=\"min-width: 300px; min-height: 300px;\"></div>");
			else if (windowsize > 800) 
				var div = $("<div id=\"flot-placeholder\" style=\"min-width: 700px; min-height: 700px;\"></div>");
			else
				var div = $("<div id=\"flot-placeholder\" style=\"min-width: 500px; min-height: 500px;\"></div>");
			//if number of answers == 0 output message to user
			if (countEmpty==c)			
			{
				var mdiv = $("<div id=\"wait\"> <BR><BR><BR>Waiting for Answers... </div>");
				$("#divForWait").append(mdiv);
				$("#divForWait").replaceWith(mdiv);
			}
			else
			{	//append to div's number of users that submitted answer and chart with legend
				var tdiv = $("<div id=\"totAns\"> <BR> Answers Received: "+totalNumOfAnswers+"</div>");
				if ($("#wait").length != 0)
					$("#wait").remove();
				if ($("#totAns").length != 0)
					$("#totAns").remove();
				if ($("#divForChart").length != 0)
				{
					$("#divForChart").replaceWith(div);
					$("#divForNumOfA").append(tdiv);
				}
				else
				{
					$("#divForChart").append(div);
					$("#divForNumOfA").append(tdiv);
				}
				$.plot($("#flot-placeholder"), dataSet, options);//plot chart
			}
		};	
		evtSource.onerror = function(e) {
			alert("EventSource failed.");
		};
	}
	else
	{	
		alert("Your answer has been submitted");//this will prompt to user who uses browser that does not support SSE
		$("#divForChart").append("<BR>Sorry, your browser can't display this chart...");
	}
});
</script>
</body>
</html>