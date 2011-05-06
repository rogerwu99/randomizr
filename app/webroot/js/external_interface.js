
/* This script and many more are available free online at
The JavaScript Source :: http://javascript.internet.com
Created by: Ultimater, Mr J :: http://www.webdeveloper.com/forum/showthread.php?t=77389 */

function thisMovie(movieName) {
         if (navigator.appName.indexOf("Microsoft") != -1) {
             return window[movieName];
         } else {
             return document[movieName];
         }
     }

function comment(type) {
	toggle(type);
	if (type=="comment"){
		thisMovie("MooPlayer").crunchThisVideo();
		toggle("watch");
	}
	else {
		thisMovie("MooPlayer").hideCrunches();
		toggle("comment");
	
	}
}
function playheadUpate(playheadtime){
	time.innerHTML=playheadtime;
}
