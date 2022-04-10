function showPopup(status, msg) {
  popupbox = document.querySelector("#successpopup");
  pstatus = document.querySelector("#purchasestatus");
  pstatus.textContent = status;
  pmsg = document.querySelector("#pmsg");
  pmsg.textContent = msg;
  popupbox.style.display = "block";
}
