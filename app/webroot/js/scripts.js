function change(tab_number){
	for (i=1;i<5;i++){
		tab_name = 'step_'+i;
		tab = document.getElementById(tab_name);
		tab.style.display="none";
		
	}
	tab_name = 'step_'+tab_number;
	focus_tab = document.getElementById(tab_name);
	focus_tab.style.display="block";
	
}


function synchTab(frameName) {

  var elList, i;

  // Exit if no frame name was given.

  if (frameName == null)
    return;

  // Check all links.

  elList = document.getElementsByTagName("A");
  for (i = 0; i < elList.length; i++)

    // Check if the link's target matches the frame being loaded.

    if (elList[i].target == frameName) {

      // If the link's URL matches the page being loaded, activate it.
      // Otherwise, make sure the tab is deactivated.

      if (elList[i].href == window.frames[frameName].location.href) {
        elList[i].className += " activeTab";
        elList[i].blur();
      }
      else
        removeName(elList[i], "activeTab");
    }
}

function removeName(el, name) {

  var i, curList, newList;

  if (el.className == null)
    return;

  // Remove the given class name from the element's className property.

  newList = new Array();
  curList = el.className.split(" ");
  for (i = 0; i < curList.length; i++)
    if (curList[i] != name)
      newList.push(curList[i]);
  el.className = newList.join(" ");
}
// JavaScript Document