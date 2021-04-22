function validateform(){  
    var password=document.loginform.password.value;  
    var email = document.loginform.email.value;

    if(password.length<6){  
      /*alert("Password must be at least 6 characters long.");*/
        document.getElementById("passerror").innerHTML="Password should more than 6 charactar";
        return false;  
    }  

    else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)){
        return (true)
    }

    else{
        alert("You have entered an invalid email address!")
        return false;
    }
    
}  
