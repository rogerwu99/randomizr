// JavaScript Document
//var tweetUsers = ['tutorialzine','TechCrunch','smashingmag','mashable'];
var tweetUsers = [];
var buildString = "";
var keyname = "dog"
var lastID = 0;
var tweetlist = new Array();
//var ob;

$(document).ready(function(){
    $('#twitter-ticker').slideDown('slow');
    buildString = keyname;
    if (tweetUsers.length) {
        for(var i=0;i<tweetUsers.length;i++)
        {
            if(i!=0) buildString+='+OR+';
            buildString+='from:'+tweetUsers[i];
        }
    }
    GetMatchingStatuses(buildString);
    TweetTick();    

});

function GetMatchingStatuses(buildString)
{
    var twitterapiurl = "http://search.twitter.com/search.json?since_id=" + lastID + "&q=" + buildString + "&rpp=50&callback=?";
//    alert("GetMatchingStatuses apiurl" + twitterapiurl);
    $.getJSON(twitterapiurl,function(ob){
//        alert("ob " + ob);
        FormatTweets(ob);
    });
}
function FormatTweets(data)
{
    var newlist = new Array();
    $(data.results).each(function(el){
        newlist.push(this);
    });
    // put new tweets in front of list
    if (lastID) newlist.length=1;
    tweetlist = newlist.concat(tweetlist);
    if (tweetlist.length > 50) tweetlist.length=50;
    var container=$('#tweet-container');
    container.html('');
    for(var i=0;i < tweetlist.length;i++) {
        obj = tweetlist[i];
        TimeForThisCall = obj.created_at;
        if (obj.id > lastID) lastID = obj.id;
        var str = '    <div class="tweet">\
                    <div class="avatar"><a href="http://twitter.com/'+obj.from_user+'" target="_blank"><img src="'+obj.profile_image_url+'" alt="'+obj.from_user+'" /></a></div>\
                    <div class="user"><a href="http://twitter.com/'+obj.from_user+'" target="_blank">'+obj.from_user+'</a></div>\
                    <div class="time">'+relativeTime(TimeForThisCall)+'</div>\
                    <div class="txt">'+formatTwitString(obj.text)+'</div>\
                    </div>';
        container.append(str);
    }
    container.jScrollPane();
}

function TweetTick()
{
//    alert("TweetTick lastID"+lastID);
    GetMatchingStatuses(buildString);
    var t=setTimeout("TweetTick()",6000)
}

function formatTwitString(str)
{
    str=' '+str;
    str = str.replace(/((ftp|https?):\/\/([-\w\.]+)+(:\d+)?(\/([\w/_\.]*(\?\S+)?)?)?)/gm,'<a href="$1" target="_blank">$1</a>');
    str = str.replace(/([^\w])\@([\w\-]+)/gm,'$1@<a href="http://twitter.com/$2" target="_blank">$2</a>');
    str = str.replace(/([^\w])\#([\w\-]+)/gm,'$1<a href="http://twitter.com/search?q=%23$2" target="_blank">#$2</a>');
    return str;
}

function relativeTime(pastTime)
{
    var origStamp = Date.parse(pastTime);
    var curDate = new Date();
    var currentStamp = curDate.getTime();

    var difference = parseInt((currentStamp - origStamp)/1000);

    if(difference < 0) return false;

//    if(difference <= 5)                return "Just now";
//    if(difference <= 20)            return "Seconds ago";
    if(difference <= 60)            return parseInt(difference)+ " seconds ago";
    if(difference < 3600)            return parseInt(difference/60)+" minutes ago";
    if(difference <= 1.5*3600)         return "One hour ago";
    if(difference < 23.5*3600)        return Math.round(difference/3600)+" hours ago";
    if(difference < 1.5*24*3600)    return "One day ago";

    var dateArr = pastTime.split(' ');
    return dateArr[4].replace(/\:\d+$/,'')+' '+dateArr[2]+' '+dateArr[1]+(dateArr[3]!=curDate.getFullYear()?' '+dateArr[3]:'');
}