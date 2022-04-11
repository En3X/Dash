var id = $("#tournamentId").val();
msgdiv = document.createElement("div");
msgdiv.classList.add("message");
setInterval(() => {
  $("#chats").empty();
  getChats();
}, 3000);

function getChats() {
  $.post("../db/getChats.php", getData()).done((data) => {
    $("#chats").html(data);
  });
}

function getData() {
  return {
    tournamentId: id,
  };
}
$("#chatnow").on("keypress", function (e) {
  if (e.which == 13) {
    chatText = $("#chatnow").val();
    postChat(chatText);
  }
});
var user = $("#username").val();
function postChat(chatText) {
  if (chatText == "") {
    return;
  } else {
    $.post("../db/getChats.php", {
      chatSent: 1,
      chattext: chatText,
      sender: user,
      tid: id,
    }).done((data) => {
      console.log(data);
      $("#chatnow").val("");
      getChats();
    });
  }
}
