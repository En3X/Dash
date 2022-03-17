    <div class="formSection">
        <form autocomplete="off" action="#" method="post">
            <div class="form-group">
                <div class="input-group">
                    <input name="name" placeholder="Name" type="text" class="form-input">
                    <i class="fa fa-user"></i>
                </div>
                <div class="input-group">
                    <input name="username" placeholder="Email address" type="text" class="form-input">
                    <i class="fa fa-at"></i>
                </div>
                <div class="input-group">
                    <input name="password" id="password" placeholder="Password" type="password" class="form-input">
                    <i onclick="togglePwd()" id="togglepwd" class="fa fa-eye-slash pointer"></i>
                </div>
                <input type="hidden" name="formSubmitted" value="1">
                <div class="input-group">
                    <input class="pointer" name="signup" type="submit" value="Create account">
                    <i class="fa fa-arrow-right"></i>
                </div>
            </div>
        </form>
    </div>