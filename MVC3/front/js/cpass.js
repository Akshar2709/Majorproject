function validateform(){  
var password1=document.changepasswordform.npassword.value; 
var password2=document.changepasswordform.cpassword.value;
  
if(password1.length<6){  
  alert("Password must be at least 6 characters long.");  
  return false;  
  }  
    
else if (password1 != password2){
    alert("password not match");
    return false;
}
    
}  
