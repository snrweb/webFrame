<?php $this->setSiteTitle('Login') ?>

<?php $this->start('body') ?>

    <form class="LoginFormWrapper" action="<?=PROOT?>login" method="post">
        
        <div class="LoginFormInputWrapper">
            <small class="errorDisplay"><?=$this->username_error?></small>
            <input type="text" placeholder="Username" name="username" value="<?=$this->username?>"/>
        </div>

        <div class="LoginFormInputWrapper">
            <small class="errorDisplay"><?=$this->password_error?></small>
            <input type="password" placeholder="Password" name="password"/>
        </div>

        <div class="LoginFormCB-FPWrapper">
            <div class="LoginFormCheckboxWrapper">
                <label>Remember me</label>
                <input type="checkbox" value="true" name="remember_me"/>
            </div>
            <div class="LoginFormForgotPwdWrapper">
                <a href="<?=PROOT?>password/forgot">Forgot Password?</a>
            </div>
            <div class="Clear-Float"></div>
        </div>

        <div class="LoginFormButtonWrapper">
            <button type="submit" class="LoginFormSubmitButton">Login</button>
        </div>

        <div class="LoginFormRegisterWrapper">
            <a href="<?=PROOT?>register">Click here to register</a>
        </div>
    </form>

<?php $this->end() ?>