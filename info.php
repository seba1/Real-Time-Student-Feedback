<?php header('Content-type: text/html; charset=utf-8'); ?>
<!-- Name: 	Sebastian Horoszkiewicz -->
<!-- Date: 	16.05.2014 -->
<!-- ID	 :	C00156243 -->
<!-- Purpose: Display general information about this web application -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
	<title>Information</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../main.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
	</head>
	<!--css below - http://www.dreamweaverclub.com/dreamweaver-show-larger-image.php -->
	<style>
	#picture {width:100px; height: 250px; background-color:#ffffff;}
	#picture a.small, #picture a.small:visited { display:block; width:100px; height:100px; text-decoration:none; background:#ffffff; top:0; left:0; border:0;}
	#picture a img {border:0;}
	#picture a.small:hover {text-decoration:none; background-color:#000000; color:#000000;}
	#picture a .large {display:block; position:absolute; width:0; height:0; border:0; top:0; left:0;}
	#picture a.small:hover .large {display:block; position:absolute; top: 90px; left:150px; width:455px; height:520px; }
	#menu a.p1:hover .large {display:block; position:absolute; top:-65px; left:150px; width:200px; height:200px; 
	</style>
<body>
<br>
<div data-role="page" style="text-align: center;" >
	<div data-role="header" data-theme="b" data-position="inline" >
	<h1>Information</h1>
	</div>
	<br>
    <div style="margin-right:7%; margin-left:7%; text-align: center;">	
		<div style="font-size:22px;">
			<b>What is Real Time Student Feedback?</b>
		</div>
	<p>
		This application is made to give feedback to lecturer from group of students 
		in short time and display results on chart coming in real-time on everybody's screen.
		This application is made to work on any type of device that student might 
		have (e.g. laptop, smartphone tablet etc.) Only requirement to run this application 
		is web access as well as web browser (recommended Google Chrome).
		</p>
	<!--picture div below - http://www.dreamweaverclub.com/dreamweaver-show-larger-image.php -->
	<table style="margin-right:7%; margin-left:7%; text-align: center;">
	<tr>
	<td style="width:340px">
	<div id="picture" style="height:305px">
	<a class="small" href="#nogo" title="small image">
	<img src="screens/Smallss4.jpg" title="small image" />
	<img class="large" src="screens/ss4.jpg" title="large image" />
	</a></div>
	</td>
	<td style="width:260px">
	<div id="picture" style="height:305px">
	<a class="small" href="#nogo" title="small image">
	<img src="screens/Smallss3.jpg" title="small image" />
	<img class="large" src="screens/ss3.jpg" title="large image" />
	</a></div>
	</td>
	<td style="width:300px">
	<div id="picture" style="height:305px">
	<a class="small" href="#nogo" title="small image">
	<img src="screens/Smallss2.jpg" title="small image" />
	<img class="large" src="screens/ss2.jpg" title="large image" />
	</a></div>
	</td>
	<td style="width:260px">
	<div id="picture" style="height:305px">
	<a class="small" href="#nogo" title="small image">
	<img src="screens/Smallss1.jpg" title="small image" />
	<img class="large" src="screens/ss1.jpg" title="large image" />
	</a></div>
	</td>
	</tr>
	</table>
	<br>
	<div style="font-size:22px;">
		<b>Does my Browser Support this application?</b>
	</div>
	<table style="margin-right:7%; margin-left:7%; text-align: center;">
	<tr>
	<tr>
	<td>
	<div style="font-size:22px;">
		<b>Mobile Browsers</b>
	</div>
	</td>
	<td>
	<div style="font-size:22px;">
		<b>Desktop Browsers</b>
	</div>
	</td>
	</tr>
	<tr>
	<td style="text-align:left;">
		<b>Google Chrome </b>(version 34.0.1847.114 and newer) - works
		<BR><b>Maxthon </b>(version 4.2.3.2000 and newer) - works
		<BR><b>Dolphin </b>(version 11.0.1 and newer) - works
		<BR><b>Android default browser </b>- works
		<BR><b>Firefox </b>(version 29.0.1) - does not refresh chart (need manual refresh of page)
		<BR><b>Opera Mini </b>(version 7.5.35199) - graph not displayed / does not support Server Sent Events (but can be used to submit answers)
	</td>
	<td style="text-align:left;">
		<b>Google Chrome </b>(version  34.0.1847.137 m and newer) - works
		<BR><b>Safari </b>(5.1.7 for Windows and newer) - works
		<BR><b>Opera </b>(version 12.16) - works (colours are not displayed correctly)
		<BR><b>Firefox </b>(version 28.0 and 29.0.1) - does not refresh chart (need manual refresh of page)
		<BR><b>IE </b>(version 11.0.9600.17107) - graph not displayed / does not support Server Sent Events (but can be used to submit answers)
		<BR><b>IE </b>(version 9.0.8112.16421) - not working
	</td>
	</tr>
	</tr>
	</table>
	<BR>
	<div style="font-size:22px;">
		<b>Are there any Tutorials Available?</b>
	</div>
	<br>
		<a href="https://www.youtube.com/watch?v=UGK5nPyKYWY">Tutorial on Creating Question</a>
	<br><br>
		<a href="https://www.youtube.com/watch?v=WZ6E0H32fmY">Tutorial on Answering the Question</a>
	<br><br>
	<div style="font-size:22px;">
		<b>How permanent is http://c00156243.candept.com/ will it be there next year?</b>
	</div>
	<p>
	This domain is provided to me by IT Carlow therefore I'm assuming that it 
	will be deleted after I finish this College Year.
	</p>
	
	<div style="font-size:22px;">
		<b>What would an admin need (what kind of server setup) to host 
		your project? </b>
	</div>
	<p>
	If someone would like to host this application he would require to have web server on which all files could be stored. Another thing it would have to support PHP 5.0.0 as it's used a lot in my code, also to access my database I used MySqli functions which are extension to PHP 5.0.0. MySqli functions were introduced with PHP 5.0.0 and that’s the minimum version needed to run this application. Another needed thing would be database on which data would be stored. Last required thing would be valid domain.</p>
	<div style="font-size:22px;"><b>
	Do I need PhPMyAdmin on the Server?
	</b></div>
	<p>
	No, any database that is structured using tables, fields and records can be used to run my application, probably only thing that would have to be changed in my code is connection information (login, password and database name) as long as created database will be using names that I’ve used in my code it should work with no issues.
	</p>	
	<BR>
		<input data-theme="b" class="mybtn" type="button" value="Back"  id="home" />
		<BR><BR>
	</div>
</div>
<script>
$(document).ready(function () {
	$("#home").click(function() 
	{
		window.location="/";
	});
});
</script>
</body>
</html>
