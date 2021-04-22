
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
    $("#dataelements").owlCarousel({
        items: 1,
        autoplay: false,
        smartSpeed: 700,
        loop: false,
        nav: false,
        dots: true,
        margin: 10,
        dotsData: true,
        navText: ['<img src="./images/Admin_images/images/left-arrow.png">', '<img src="./images/Admin_images/images/right-arrow.png">']
    });
});*/