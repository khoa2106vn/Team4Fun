function TestsFunction($id) {
    var T = document.getElementById($id);
    if (T.style.display === "none") {
    T.style.display = "block";
  } else {
    T.style.display = "none";
    }
}

$("body").keypress(function (e) {
    if(e.which === 13 && !e.shiftKey) {
        e.preventDefault();
    
        $(this).closest("form").submit();
    }
});

function HidePost($id) {
    var T = document.getElementById($id);
    if (T.style.display === "none") {
    T.style.display = "block";
  } else {
    T.style.display = "none";
    }
}