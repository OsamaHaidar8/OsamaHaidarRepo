//Get modal element
var modal = document.getElementById('simpleModal');

//Get open modal button
var button1 = document.getElementById('modalBtn1');


//Get close modal button
var closeBtn = document.getElementsByClassName('closeBtn')[0];

// Listen for open click
button1.addEventListener('click' , openModal);

// Listen for close click
closeBtn.addEventListener('click',closeModal);

// Listen for outside click
window.addEventListener('click' , outsideclick);

// Fun to open modal
function openModal(){
    //console.log(123); to test the fun
    modal.style.display = 'block';   
}

// Fun to open modal
function closeModal(){
    modal.style.display = 'none';   
}

// Fun to open modal if outside click
function outsideclick(e){
    if(e.target == modal){
        modal.style.display = 'none';     
    }
}


//Get modal element
var modal1 = document.getElementById('simpleModal1');

//Get open modal button
var button2 = document.getElementById('modalBtn2');


//Get close modal button
var closeBtn1 = document.getElementsByClassName('closeBtn1')[0];

// Listen for open click
button2.addEventListener('click' , openModal1);

// Listen for close click
closeBtn1.addEventListener('click',closeModal1);

// Listen for outside click
window.addEventListener('click' , outsideclick1);

// Fun to open modal
function openModal1(){
    //console.log(123); to test the fun
    modal1.style.display = 'block';   
}

// Fun to open modal
function closeModal1(){
    modal1.style.display = 'none';   
}

// Fun to open modal if outside click
function outsideclick1(e){
    if(e.target == modal1){
        modal1.style.display = 'none';     
    }
}