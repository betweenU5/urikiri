var only = false;

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