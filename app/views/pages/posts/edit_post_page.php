<section class="create-post">
  <div class="container">
    <div class="row">
      <?php require_once VIEWS . '/pages/acc/left_aside.php' ?>
      <div class="left-column">
        <div class="title">
          <span class="open-aside" onclick="rightColumn()">&#9776;</span>
          <h1><?php echo $title ?> Edit</h1>
        </div>

        <div class="forms mt-3">

          <form method="post" enctype="multipart/form-data">
            <span class="error"><?php echo isset($errorInfo)?$errorInfo:''  ?></span>
            <input type="text" name="title" value="<?php if (isset($_POST['title']) && !empty($_POST['title'])){
              echo $_POST['title'];
            }else {
              echo $post['title'];
            } ?>" placeholder="Title">
            <span class="error"><?php echo isset($errorTitle) ? $errorTitle : '' ?></span>
            <textarea rows="6" name="text" placeholder="Short description"><?php if (isset($_POST['text']) && !empty($_POST['text'])){echo $_POST['text'];}
              else{echo $post['text'];
                } ?></textarea>
            <span class="error"><?php echo isset($errorText) ? $errorText : '' ?></span>
            <input class="btn btn-default" type="submit">
            <input type="hidden" name="id" value="<? echo $post['id'] ?>">
          </form>
        </div>

      </div>
    </div>
  </div>
</section>