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

          <form method="post">
            <span class="error"><?php echo isset($errorInfo)?$errorInfo:''  ?></span>
            <input type="text" name="siteName" value="<?php if (isset($_POST['site_name']) && !empty($_POST['site_name'])){
              echo $_POST['site_name'];
            }else {
              echo $home['site_name'];
            } ?>" placeholder="Site name">
            <span class="error"><?php echo isset($errorTitle) ? $errorTitle : '' ?></span>

            <input type="text" name="title" value="<?php if (isset($_POST['title']) && !empty($_POST['title'])){
              echo $_POST['title'];
            }else {
              echo $home['title'];
            } ?>" placeholder="Title">
            <span class="error"><?php echo isset($errorTitle) ? $errorTitle : '' ?></span>

            <textarea rows="2" name="desc" placeholder="Short description"><?php if (isset($_POST['desc']) && !empty($_POST['desc'])){echo $_POST['desc'];}
              else{echo $home['desc'];
              } ?></textarea>

            <textarea rows="6" name="text" placeholder="Text"><?php if (isset($_POST['text']) && !empty($_POST['text'])){echo $_POST['text'];}
              else{echo $home['text'];
              } ?></textarea>
            <span class="error"><?php echo isset($errorText) ? $errorText : '' ?></span>
            <input type="text" name="copy" value="<?php if (isset($_POST['copy']) && !empty($_POST['copy'])){
              echo $_POST['copy'];
            }else {
              echo $home['copyright'];
            } ?>" placeholder="Copyright">
            <input class="btn btn-default" type="submit">
            <input type="hidden" name="id" value="<? echo $post['id'] ?>">
          </form>
        </div>

      </div>
    </div>
  </div>
</section>