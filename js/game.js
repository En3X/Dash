function goToTournament(gameId) {
  idInput = document.querySelector("#gameid");
  submitBtn = document.querySelector("#go");
  idInput.value = gameId;
  submitBtn.click();
}
