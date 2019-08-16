<?php
    use Core\CSRF;
?>
<?php $this->setSiteTitle('Forgot Password') ?>

    <?php $this->start('body') ?>

    <form class="form" method="post" action="<?=PROOT?>password/forgot/<?= $this->urlParams ?>">
        <?= $this->errorMsg() ?>
        <?= $this->successMsg() ?>
        <p class="formTitle">Enter Email Address For Reset Link</p>
        <div style="margin-bottom: 10px;">
            <input type="email" placeholder="Enter your email address" name="email">
        </div>
        <button class="submitbtn btn" type="submit">Submit</button>
    </form>

    <?php $this->end() ?>