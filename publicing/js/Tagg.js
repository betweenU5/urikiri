window.onload = function() {
    maketag();
}
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


let TagArray = ['C', 'Cs', 'C++', 'Python', 'Python', 'Java', 'Spring', 'HTML', 'CSS', 'JS', 'Ruby', 'Rust', 'Go', 'PHP', 'ASP', 'Java', 'node', 'React', 'Vue', 'Ts','Sql','unity', 'Linux', 'arduino', 'Android', 'Plus'];
let ValArray = ['C', 'C#', 'C++', 'PythonAl', 'PythonBack', 'Java', 'JavaSpring', 'HTML', 'CSS', 'JS', 'Ruby', 'Rust', 'Go', 'PHP', 'ASP', 'JSP', 'node', 'React', 'Vue', 'Ts','Sql','unity', 'Linux', 'arduino', 'Android', 'other'];
let TextArray = ['C', 'C#', 'C++', 'Py 알고리즘', 'Py 백엔드', 'Java', 'JavaSpring', 'HTML', 'CSS', 'JS', 'Ruby', 'Rust', 'Go', 'PHP', 'ASP', 'JSP', 'nodeJS', 'ReactJS', 'VueJS', 'TypeScript','Sql','unity', 'Linux', 'arduino', 'Android', '기타'];

function maketag(){
    let SectionBox = document.querySelector(".SectionForm");

   

    for(var i = 0; i < TagArray.length; i++){
        let div = document.createElement('div');
        div.classList.add("TagBox");

        console.log("url(../../../source/TagImg/"+TagArray[i]+".png)");
        

        let input = document.createElement('input');
        input.setAttribute("type", "checkbox");
        input.setAttribute("name", "MySelectTag[]");
        input.setAttribute("id", "MyTag" + i);
        input.setAttribute("value", ValArray[i]);
        input.classList.add("hidden");






        let label = document.createElement('label');
        label.setAttribute("for", "MyTag" + i);
        
        label.classList.add("MySelectA");
        label.style.backgroundImage = "url(../../../source/TagImg/"+TagArray[i]+".png)";
        label.classList.add("Taglabel");

        let p = document.createElement('p');
        
        p.innerHTML = TextArray[i];
        p.classList.add("TagText")


        div.appendChild(input);
        label.appendChild(p);
        div.appendChild(label);
        

        SectionBox.appendChild(div);
    }


}