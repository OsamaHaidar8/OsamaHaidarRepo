var password=document.getElementById("password");
var conpassword=document.getElementById("conpassword");
var message=document.getElementById("message");


password.onkeydown=function(){

    "use strict";
    if(password.value.length<6)
    message.innerHTML="كلمة مرور قصيرة جدا";
    else 
    message.innerHTML="";
    
};
conpassword.onkeyup=function()
{
    "use strict";
    if(password.value!=conpassword.value)
    message.innerHTML="كلمة المرور غير مطابقة";
    else 
    message.innerHTML="";
};

password.onmouseout=function()
{
    "use strict";
    if(password.value!=conpassword.value)
    message.innerHTML="كلمة المرور غير مطابقة";
    else 
    message.innerHTML="";
};