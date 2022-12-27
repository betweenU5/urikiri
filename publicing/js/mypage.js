

let only = false;

function ShowMenu() {
  let IfFocus = document.getElementById("IfFocus");
  let ThisIsMenuBox = document.querySelector(".ThisIsMenuBox");
  let ShowmenuButton = document.querySelector(".ShowmenuButton");
  let body = document.querySelector(".body");
  if (only) {
    ThisIsMenuBox.style.transform = "translateX(-110%)";
    only = false;
    ShowmenuButton.innerHTML =
      '<img src="../../../source/img/menu.png" class="HeaderLogoIcon">  ';
    body.style.display = "none";
  } else {
    ThisIsMenuBox.style.transform = "translateX(0)";
    only = true;
    ShowmenuButton.innerHTML =
      '<img src="../../../source/img/no.png" class="HeaderLogoIcon">  ';
    body.style.display = "block";
  }
}



function ShowAco1(x){
    let aco1 = document.getElementById("aco1");
    let aco2 = document.getElementById("aco2");
    let acoHead1 = document.getElementById("acoHead1");
    let acoHead2 = document.getElementById("acoHead2");
    let acoTitle1 = document.getElementById("acoTitle1");
    let acoTitle2 = document.getElementById("acoTitle2");



    if(x == 1){
        acoHead1.style.backgroundColor = "#4778ff";
        acoTitle1.style.color = "white";
        aco1.style.height = "250px";
        aco1.style.overflowY ="scroll"


        acoHead2.style.backgroundColor = "white";
        acoTitle2.style.color = "#4778ff";
        aco2.style.height = "0";
        aco2.style.overflowY ="hidden";
        
    }else if(x == 2){
        acoHead2.style.backgroundColor = "#4778ff";
        acoTitle2.style.color = "white";
        aco2.style.height = "250px";
        aco2.style.overflowY ="scroll";
        
        acoHead1.style.backgroundColor = "white";
        acoTitle1.style.color = "#4778ff";
        aco1.style.height = "0";
        aco1.style.overflowY ="hidden"
    }
}




function ToGoLink(name){
  location.href = "../page/profile.php?id=" + name;
}