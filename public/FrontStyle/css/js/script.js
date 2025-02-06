// list ul

var divButton = document.getElementById('clicked_pro');
if (divButton !== null) {
    var isClicked = false;

    divButton.addEventListener('click', function() {
        var ul = document.getElementById('ul-list');
        if (!isClicked) {
            ul.style.display = "block";
            isClicked = true;
        } else {
            ul.style.display = "none";
            isClicked = false;
        }
    });
}
function myFunction() {
  var element = document.getElementById("ul-list");
  element.classList.remove("d-none");
}
