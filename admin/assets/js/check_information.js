var password=document.getElementById("password");
var conpassword=document.getElementById("conpassword");
var message=document.getElementById("message_pass");
var messagecon=document.getElementById("message_con");


password.onkeydown=function(){

    "use strict";
    if(password.value.length<6)
    {
    message.innerHTML="كلمة مرور قصيرة جدا";
    
    }
    else 
    message.innerHTML="";
    
};
conpassword.onkeyup=function()
{
    "use strict";
    if(password.value!=conpassword.value)
    messagecon.innerHTML="كلمة المرور غير مطابقة";
    else
    {
    messagecon.innerHTML=" ";
    }
};

password.onmouseout=function()
{
    "use strict";
    if(password.value!=conpassword.value)
        messagecon.innerHTML="كلمة المرور غير مطابقة";
    else 
    messagecon.innerHTML="";
};