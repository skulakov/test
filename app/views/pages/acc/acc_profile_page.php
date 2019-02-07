
<section class="profile">
  <div class="container">
    <div class="row">
      <?php require_once VIEWS . '/pages/acc/left_aside.php' ?>

      <div class="left-column">
        <div class="title">
          <span class="open-aside" onclick="rightColumn()">&#9776;</span>
          <h1><?php echo $title ?></h1>
        </div>

        <div class="forms mt-3">
          <form method="post">
            <span class="user-info"><?php echo isset($info) ? $info : '' ?></span>
            <h3>Edit name</h3>
            <input type="text" name="name"
                <?php if (isset($_POST['name']) && !empty($_POST['name'])): ?>
                  value="<?php echo $_POST['name'] ?>"
                <?php else: ?>
                   value="<?php echo $user['userName'] ?>">
            <?php endif; ?>

            <span class="error"><?php echo isset($errorName) ? $errorName : '' ?></span>
            <input class="btn btn-default" type="submit" name="Отправить">
            <input type="hidden" name="edit" value="name">
          </form>

          <form method="post">
            <h3>Edit pass</h3>
            <input type="password" name="pass"
                <?php if (isset($_POST['pass']) && !empty($_POST['pass'])): ?>
                  value="<?php echo $_POST['pass'] ?>"
                <?php endif; ?>
            >
            <span class="error"><?php echo isset($errorPass) ? $errorPass : '' ?></span>
            <input type="password" name="confirm">
            <span class="error"><?php echo isset($errorConfirm) ? $errorConfirm : '' ?></span>
            <input class="btn btn-default" type="submit" name="Отправить">
            <input type="hidden" name="edit" value="pass">
          </form>
        </div>

      </div>
    </div>
  </div>
</section>
