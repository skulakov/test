<section class="registry">
  <div class="container">
    <div class="row">
      <div class="forms">
        <h1 class="mb-4">Registry</h1>
        <form method="post">
          <span class="error"><?php echo isset($errorInfo)?$errorInfo:''  ?></span>
          <input type="text" name="name"
              <?php if (isset($_POST['name'])): ?> value="<?= $_POST['name'] ?>"<?php endif ?>>
          <span class="error"><?php echo isset($errorName) ? $errorName : '' ?></span>
          <input type="email" name="email"
              <?php if (isset($_POST['email'])): ?> value="<?= $_POST['email'] ?>"<?php endif ?>>
          <span class="error"><?php echo isset($errorEmail) ? $errorEmail : '' ?></span>
          <input type="password" name="pass">
          <span class="error"><?php echo isset($errorPass) ? $errorPass : '' ?></span>
          <input class="btn btn-default" type="submit" value="Submin">
          <div class="link-form">
            <a class="link" href="/login">Login</a> <a class="link" href="/remind">Remind</a>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>