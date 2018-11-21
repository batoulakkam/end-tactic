function toggleMenu() {
  var menuBox = document.getElementById('menu-box');    
  if(menuBox.style.display == "block") { // if is menuBox displayed, hide it
    menuBox.style.display = "none";
  }
  else { // if is menuBox hidden, display it
    menuBox.style.display = "block";
  }
}

function toggleMenu2() {
  var box = document.getElementById('box');    
 
   if(box.style.display == "block") { 
    box.style.display = "none";
   
  }
  else { // if is menuBox hidden, display it
    box.style.display = "block";
  
  }
}


function check_pass() {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value)
		{
        document.getElementById('submit').disabled = false;
        }
	else {
        document.getElementById('submit').disabled = true;
    }
}
