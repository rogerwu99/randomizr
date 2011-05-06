function setClock(){
	var hour=document.getElementById('system_hour').value;
	var minute=document.getElementById('system_minute').value;
	var d=new Date(0,0,0,hour,minute);
	//alert(hour);
	//alert(d);
	var now = document.createTextNode(d.toLocaleTimeString());
	document.getElementById('d_time').appendChild(now);
	//alert(now);

}
function GetCount(){

	dateNow = new Date();
	dateFuture = new Date(document.getElementById('dateFuture').value);									//grab current date
	amount = dateFuture.getTime() - dateNow.getTime();		//calc milliseconds between dates
	delete dateNow;

	// time is already past
	if(amount < 0){
		document.getElementById('countbox').innerHTML="Offer has now expired!";
	}
	// date is still good
	else{
		days=0;hours=0;mins=0;secs=0;out="";

		amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

		days=Math.floor(amount/86400);//days
		amount=amount%86400;

		hours=Math.floor(amount/3600);//hours
		amount=amount%3600;

		mins=Math.floor(amount/60);//minutes
		amount=amount%60;

		secs=Math.floor(amount);//seconds

		if(days != 0){out += days +" day"+((days!=1)?"s":"")+", ";}
		if(days != 0 || hours != 0){out += hours +" hour"+((hours!=1)?"s":"")+", ";}
		if(days != 0 || hours != 0 || mins != 0){out += mins +" minute"+((mins!=1)?"s":"")+", ";}
		out += secs +" seconds";
		document.getElementById('countbox').innerHTML=out;

		setTimeout("GetCount()", 1000);
	}
}
