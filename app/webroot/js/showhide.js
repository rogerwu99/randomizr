
/* This script and many more are available free online at
The JavaScript Source :: http://javascript.internet.com
Created by: Ultimater, Mr J :: http://www.webdeveloper.com/forum/showthread.php?t=77389 */

function showhide(a,b)
{
	var e = document.getElementById(a);
 	var f = document.getElementById(b);
	if(!e) return true;
	if(!f) return true;
  	if(e.style.display == "none")
  	{
   	    e.style.display = "block";
		f.style.display = "none";
 	}
  	else
  	{
   	    e.style.display = "none";
		f.style.display = "block";
  	}
  	return true;
}
