var tprivary, tname, tdes, tgame;
var thour, tmin, tsec, tday, tmonth;

// Fields
var privacyField = document.querySelector("#privacyStatus");
var nameField = document.querySelector("#tourniename");
var gameField = document.querySelector("#gameid");
var desField = document.querySelector("#des");
var dayField = document.querySelector("#day");
var monthField = document.querySelector("#month");
var hourField = document.querySelector("#hour");
var minField = document.querySelector("#min");
var secField = document.querySelector("#sec");
var userId = document.querySelector("#userId");
document.body.onload = () => {
  tprivacy = "open";
};
function changePrivacy(elem) {
  if (privacyField.textContent == "Open") {
    privacyField.textContent = "Private";
  } else {
    privacyField.textContent = "Open";
  }
}

$("#host").on("click", function () {
  postData = getPostData();
  $.post("./db/post_tournament.php", postData).done((data) => {
    alert(data);
    window.location.href = "./index.php";
  });
});

function getPostData() {
  data = {
    privacy: privacyField.innerText,
    name: nameField.innerText,
    des: desField.innerText,
    day: dayField.innerText,
    month: monthField.innerText,
    hour: hourField.innerText,
    min: minField.innerText,
    sec: secField.innerText,
    game: gameField.innerText,
    uid: userId.innerText,
    ended: 0,
  };
  return data;
}
