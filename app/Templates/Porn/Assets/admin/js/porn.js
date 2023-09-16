//Activity
function activityUser(userid)
{

    setTimeout( function()
	{
        sendData(userid);
        activityUser(userid);

    }, 300000);
	
	sendData(userid)

}

function sendData(userid)
{
        $.ajax(
		{
            url : "activity",
			type: "POST",
			data: {'userid' : userid},
            success : function(response)
			{
                //console.log(response);
            }
        });	
}