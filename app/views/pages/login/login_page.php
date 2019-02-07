<section class="login">
  <div class="container">
    <div class="row">
      <h1>Login</h1>
      <div class="forms">
        <form method="post">
          <span class="error"><?php echo isset($errorInfo)?$errorInfo:''  ?></span>
          <input type="text" name="email"
              <?php if (isset($_POST['email'])): ?>
                value="<?php echo $_POST['email'] ?>"
              <?php endif; ?>
                 placeholder="Email" required>
          <span class="error"><?php echo isset($errorEmail) ? $errorEmail : '' ?></span>
          <input type="password" name="pass" placeholder="Password" required>
          <span class="error"><?php echo isset($errorPass) ? $errorPass : '' ?></span>
          <input class="btn btn-default" type="submit" value="Submin">
          <div class="link-form">
            <a class="link" href="">Registry</a> <a class="link" href="">Remind</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

