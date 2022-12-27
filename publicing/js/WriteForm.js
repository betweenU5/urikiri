
  
function setThumbnail(event) {
  document.querySelector("div.ShowImgBoxx").innerHTML = " ";
  for (var image of event.target.files) {
    var reader = new FileReader();

    reader.onload = function (event) {
      var img = document.createElement("img");
      img.classList.add("ShowUserImgBox2");
      img.setAttribute("src", event.target.result);
      document.querySelector("div.ShowImgBoxx").appendChild(img);
    };

    console.log(image);
    reader.readAsDataURL(image);
  }
}
