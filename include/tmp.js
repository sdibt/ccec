function postData(theAction,theMethod,theData)
{
	var thePost=GetXmlHttpObject();
	if(thePost == null)
	{
		alert("Browser does not support HTTP Request");
		return;
	}
	switch(theMethod)
	{
		case "post":
			thePost.open("POST",theAction,false);
			thePost.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			thePost.send(theData);
			break;
		case "get":
			thePost.open("GET",theAction+"?"+theData,false);
			thePost.send("");
			break;
		default:
			return "";
	}
	return thePost.responseText;

}
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	{
		xmlHttp=new XMLHttpRequest();
	}
	catch(e)
	{
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}