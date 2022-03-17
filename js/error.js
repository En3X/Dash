function showErrorInPage(err) {
  console.log(err);
  var errorSection = document.querySelector("#error");
  document.querySelector("#err").textContent = err;
  errorSection.classList.remove("hidden");
}
