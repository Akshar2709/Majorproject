
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

$(function () {
    
    var mybtn = document.getElementById("reviewbtn");
    
    var modal =document.getElementById("review-diaglogbox");
    
    mybtn.click(function(){
        alert("are you sure?");
    });
    
});

$(function () {
    
    //note id getter via data id
    $(document).on("click", "#add-review-star", function() {
    $('#noteid_for_review').val($(this).data('id'));
    $('#add-review-popup').modal('show');
    });
    
    //note title getter via data id
    $(document).on("click", "#inappropriate", function() {
        $("#title_for_inappropriate").text($(this).data('title'));
        $("#note_id_inappropriate").val($(this).data('noteid'));
        $("#note_seller_inappropriate").val($(this).data('seller_id'));
        $("#mark-as-inappropriate").modal('show');
    });
    
});

$("#review-popup-rating").jsRapStar({
        step: false,
        value: 0,
        length: 5,
        starHeight: 64,
        colorFront: '#d8d8d8',
        onClick: function(score) {
            this.StarF.css({
                color: '#ffff00',
                'text-shadow': '0 0 10px #13a2d1'
            });
            $("#starVal").val(score);
        },
        onMousemove: function(score) {
            $(this).attr('title', 'Rate ' + score);
        }
});



