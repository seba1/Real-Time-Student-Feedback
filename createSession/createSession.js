/*
 Name: 	Sebastian Horoszkiewicz
 Date: 	04.04.2014
 ID	 :	C00156243
*/
$(document).ready( function() { 
	//when user clicks button with id add then add answer field
	$("#add").click(function() 
	{
        var i = $("#addFieldForm table").length + 1;
		i+=2;
		if(i<11)
		{
			$("#ans"+i+"").remove();//remove hidden field with corresponding id
			var fieldWrapper = $("<table style=\"width:100%\" id=\"field" + i + "\"/>");
			var label = $("<label> Enter Answer "+ i +":</label>");
			var inputBox = $("<input class=\"ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset\" style=\"width:100%; height: 44px;\" type=\"text\" id=\"ans" + i + "\" name=\"ans"+i+"\"/>");
			fieldWrapper.append(label);
			fieldWrapper.append(inputBox);
			$("#addFieldForm").append(fieldWrapper);
		}
		else
		{
			alert('Maximum Number of Answers is Set!');
		}
    });
});

//need to improve popup/dialog/alert box
function confFunct()
{
	var x;
	var r=confirm("Do you really want to exit?!");
	if (r==true)
	{
		window.location = "/";
	}
}
