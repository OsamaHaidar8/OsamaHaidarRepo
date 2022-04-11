var model1=document.getElementById('simplemodel1');

var button1=document.getElementById('modelbtn1');
var button2=document.getElementById('modelbtn2');

var closebtn1=document.getElementsByClassName('closebtn1')[0];

button1.addEventListener('click',openModel);
button2.addEventListener('click',openModel);

closebtn1.addEventListener('click',closeModel);

window.addEventListener('click',close);

function openModel()
{
    model1.style.display='block';
}
function closeModel()
{
    model1.style.display='none';
}
function close(e)
{
    if(e==model1)
    {
    model1.style.display='none';
    }
}


navbar = document.querySelector(".nav").querySelectorAll("a");
console.log(navbar);

navbar.array.forEach(element => {
    element.addEventListener("click",function(){
        navbar.forEach(nav=>nav.classList.remove("active"))
        this.classList.add("active");
    });
});