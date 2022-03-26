photo = document.querySelector("#photo");
adminName = document.querySelector("#adminname");
initial = adminName.innerText.charAt(0);
photo.innerText = initial;

$("#addArticle").on("click", function () {
  $("#articleModal").toggleClass("hide");
  $("articleModal").fadeIn();
});
$("#closeModal").on("click", function () {
  $("#articleModal").addClass("hide");
});

$("#add").on("click", function () {
  title = $("#title").val();
  des = $("#article").val();
  if (
    title === undefined ||
    title === null ||
    title == "" ||
    des == undefined ||
    (des == null) | (des == "")
  ) {
    alert("Required field not filled");
    return;
  }
  $("#articleModal").addClass("hide");

  $.post("./addArticle.php", {
    title: title,
    des: des,
  }).done(function (data) {
    alert(data);
  });
});
