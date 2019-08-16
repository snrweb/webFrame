<?php 
    use Core\CSRF;
    $this->setSiteTitle('Registration') ?>

<?php $this->start('body') ?>

    <form class="RegisterFormWrapper" action="<?=PROOT?>register" method="post">
        <?= CSRF::input($this->csrf_token_error); ?>
        
        <div class="FormTitle">
            <small class="errorDisplay"><?=$this->registrationError?></small>
            <span>Create Your Account</span>
        </div>

        <div class="RegisterFormInputWrapper">
            <small class="errorDisplay"><?=$this->email_error?></small>
            <input type="email" placeholder="Email" name="email" value="<?=$this->email?>"/>
        </div>

        <div class="RegisterFormInputWrapper">
            <small class="errorDisplay"><?=$this->username_error?></small>
            <input type="text" placeholder="Username" name="username" value="<?=$this->username?>"/>
        </div>

        <div class="RegisterFormInputWrapper">
            <small class="errorDisplay"><?=$this->password_error?></small>
            <input type="password" placeholder="Password" name="password"/>
        </div>

        <div class="RegisterFormInputWrapper">
            <input type="password" placeholder="Confirm password" name="confirm_password"/>
        </div>

        <div class="RegisterFormButtonWrapper">
            <button type="submit" class="RegisterFormButton">Register</button>
        </div>

        <div class="RegisterFormLoginWrapper">
            <a href="<?=PROOT?>login">Click here to login</a>
        </div>
    </form>

<?php $this->end() ?>