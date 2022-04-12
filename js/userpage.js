function showChangePopup() {
  document.querySelector("#updatemodal").style.display = "block";
}
function hideChangePopup() {
  document.querySelector("#updatemodal").style.display = "none";
}

function showDeactivateModal() {
  document.querySelector("#deactivatemodal").style.display = "block";
}
function hideDeactivateModal() {
  document.querySelector("#deactivatemodal").style.display = "none";
}
function showEndModal() {
  document.querySelector("#endpopup").style.display = "block";
}
function hideEndModal() {
  document.querySelector("#endpopup").style.display = "none";
}
setTimeout(() => {
  document.querySelector("#msg").textContent = "";
}, 5000);
