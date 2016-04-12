<!-- Name: 	Sebastian Horoszkiewicz -->
<!-- Date: 	16.05.2014 -->
<!-- ID	 :	C00156243 -->
<!-- Purpose: Display Tutorials on How to use app -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
	<title>How to use?</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../main.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
	</head>
<body>
<br>
<div data-role="page" style="text-align: center;" >
	<div data-role="header" data-theme="b" data-position="inline" >
	<h1>Tutorial</h1>
	</div>
	<br>
    <div style="margin-right:7%; margin-left:7%; text-align: center;">	
		<div style="font-size:22px;">
			<b>How to Create Question and Answers</b>
		</div>
		<BR>
		<div id="lect"></div>
		<BR><BR>
		<div style="font-size:22px;">
		<center><b>How to Answer Question</b></center>
		</div>
		<BR>
		<div id="st"></div>
		<BR>
		<input data-theme="b" class="mybtn" type="button" value="Back"  id="home" />
		<BR><BR>
	</div>
</div>
<script>
$(document).ready(function () 
{
	//depending on window size display adequate youtube window resolution
	var linkCS="//www.youtube.com/embed/UGK5nPyKYWY";
	var linkAQ="//www.youtube.com/embed/WZ6E0H32fmY";
	var windowsize = $(window).width();
	if (windowsize < 670) 
	{
		var lectVid = $("<iframe width=\"300\" height=\"255\" src=\""+linkCS+"\" frameborder=\"0\" allowfullscreen></iframe>");
		var studVid = $("<iframe width=\"300\" height=\"255\" src=\""+linkAQ+"\" frameborder=\"0\" allowfullscreen></iframe>");	
	}
	else if (windowsize >= 670 && windowsize < 750 ) 
	{
		var lectVid = $("<iframe width=\"560\" height=\"315\" src=\""+linkCS+"\" frameborder=\"0\" allowfullscreen></iframe>");
		var studVid = $("<iframe width=\"560\" height=\"315\" src=\""+linkAQ+"\" frameborder=\"0\" allowfullscreen></iframe>");	
	}
	else if (windowsize >= 750 && windowsize < 1390  ) 
	{
		var lectVid = $("<iframe width=\"640\" height=\"360\" src=\""+linkCS+"\" frameborder=\"0\" allowfullscreen></iframe>");
		var studVid = $("<iframe width=\"640\" height=\"360\" src=\""+linkAQ+"\" frameborder=\"0\" allowfullscreen></iframe>");
	}
	else
	{
		var lectVid = $("<iframe width=\"1280\" height=\"720\" src=\""+linkCS+"\" frameborder=\"0\" allowfullscreen></iframe>");
		var studVid = $("<iframe width=\"1280\" height=\"720\" src=\""+linkAQ+"\" frameborder=\"0\" allowfullscreen></iframe>");
	}
	$("#lect").append(lectVid);
	$("#st").append(studVid);
	$("#home").click(function() 
	{
		window.location="/";
	});
});
</script>
</body>
</html>
