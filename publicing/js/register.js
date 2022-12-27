
function setThumbnail(event) {
  document.querySelector("div.ShowImgBoxx").innerHTML = " ";
  for (var image of event.target.files) {
    var reader = new FileReader();

    reader.onload = function (event) {
      var img = document.createElement("img");
      img.classList.add("ShowUserImgBox");
      img.setAttribute("src", event.target.result);
      document.querySelector("div.ShowImgBoxx").appendChild(img);
    };

    console.log(image);
    reader.readAsDataURL(image);
  }
}

function CheckAllVal() {
  console.log("이 함수 실행됨");
  let id = document.getElementById("UserId");
  let email = document.getElementById("UserMail");
  let pw = document.getElementById("Password");
  let Passworck = document.getElementById("Passworck");

  if (id.value.trim().length > 4) {
    if (email.value.trim().length > 0) {
      if (pw.value.trim().length > 0) {
        if(pw.value == Passworck.value){
            return true;
        }else{
            alert("비밀번호를 다시 확인하세요");
            Passworck.focus();
            return false;
        }
      } else {
        
        alert("비밀번호를 입력하세요");
        pw.focus();
        return false;  
    }
    } else {

      alert("이메일 주소를 정확하게 입력하세요");
      email.focus();
      return false;
    }
  } else {

    alert("아이디는 4자리 수 이상 입력해주세요.");
    id.focus();
    return false;
}
}
