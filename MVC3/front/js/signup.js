function validateform(){  
    var password1=document.signupform.password1.value; 
    var password2=document.signupform.password2.value; 
    var email = document.signupform.email.value;

    if(password1.length<6){  
      /*alert("Password must be at least 6 characters long."); */
        document.getElementById("passerror").innerHTML="Password should more than 6 charactar";
        return false;  
    }  

    else if(password1 != password2){
        /*alert("password not match");*/
        return false;
    }

    else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)){
        return (true);
    }

    else{
        /*alert("You have entered an invalid email address!");*/
        return false;
    }
    
}  


$(function () {
    $('#successnote').hide();
    $('#signupbtn').click(function(){
       $('#successnote').show(); 
    });
});