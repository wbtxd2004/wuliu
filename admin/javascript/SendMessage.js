function SendMessage(url,message)
{
	msg = message;
	if(confirm(msg))
	{
		url = url;
		location.href = url;	
	}
}