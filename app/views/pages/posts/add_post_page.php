<section class="create-post">
  <div class="container">
    <div class="row">
      <?php require_once VIEWS . '/pages/acc/left_aside.php' ?>

      <div class="left-column">
        <div class="title">
          <span class="open-aside" onclick="rightColumn()">&#9776;</span>
          <h1><?php echo $title ?> </h1>
        </div>

        <div class="forms mt-3">
          <form method="post" enctype="multipart/form-data">

            <input type="text" name="title"
                <?php if (isset($_POST['title']) && !empty($_POST['title'])): ?>
                  value="<?php echo $_POST['title'] ?>"
                <?php endif; ?>
                   placeholder="Title">
            <span class="error"><?php echo isset($errorTitle) ? $errorTitle : '' ?></span>
            <input type="file" name="file">
            <span class="error"><?php echo isset($errorFile) ? $errorFile : '' ?></span>
            <textarea rows="6" name="text"
                      placeholder="Short description"><?php if (isset($_POST['text']) && !empty($_POST['text'])) {
                echo $_POST['text'];
              }?></textarea>
            <span class="error"><?php echo isset($errorText) ? $errorText : '' ?></span>
            <input class="btn btn-default" type="submit" name="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
