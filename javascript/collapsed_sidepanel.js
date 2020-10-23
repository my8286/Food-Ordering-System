
var sidebar = document.getElementById("mySidebar");


function openNav() {
  document.getElementById("mySidebar").style.width = "100%";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
window.onclick = function(event) {
  if (event.target == sidebar) {
    document.getElementById("mySidebar").style.width = "0";
  }
}