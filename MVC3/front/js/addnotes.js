function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

/*$(function () {
    var menu=document.getElementById('type');
    menu.onchange=function(){
        var useroption=this.options(this.selectedIndex);
        window.open(useroption,"_top");
    }
    
});*/

$(function () {
    $('.sellprice').hide();
    $('#sellwithpaid').click(function(){
       $('.sellprice').show(); 
    });
    $('#sellwithfree').click(function(){
       $('.sellprice').hide(); 
    });
    
});