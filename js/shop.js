// default items and shop at the start
var allItems = $(".shoppingcard");
var items = $(".itemname");

var shop = $("#shopsection");

$("#search").on("input", function () {
  term = $("#search").val();
  if (term == "") {
    shop.empty();
    shop.append(items.parent().parent().parent().parent());
  } else {
    shop.empty();
    items.each(function () {
      itemname = $(this).text().toLowerCase();
      if (itemname.indexOf(term) > 0) {
        console.log("Hello");
        shop.append($(this).parent().parent().parent().parent());
      }
    });
  }
});
