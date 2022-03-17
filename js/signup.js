function togglePwd(self) {
  pwd = document.querySelector("#password");
  self = document.querySelector("#togglepwd");
  if (pwd.type == "password") {
    pwd.type = "text";
    self.classList = "fa fa-eye pointer";
  } else {
    pwd.type = "password";
    self.classList = "fa fa-eye-slash pointer";
  }
}
