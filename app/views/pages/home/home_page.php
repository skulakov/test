<section class="home">
  <div class="banner">
    <h1><?php echo $home['title'] ?></h1>
    <p><?php echo $home['desc'] ?> </p>
    <a href="/login" class="btn btn-default">Sign in</a>
  </div>
  <div class="photos">
    <div class="container">
      <div class="row">
        <?php if (isset($posts) && !empty($posts)): ?>
          <?php foreach ($posts as $post): ?>
            <figure>
              <a href="/post/<?php echo $post['id'] ?>"><img src="/img/upload/<?php echo $post['file'] ?>" alt="<?php echo $post['title'] ?>""></a>
              <figcaption><span><?php echo $post['title'] ?></span> <span><?php echo dmyDateFormat($post['date']) ?></span></figcaption>
            </figure>
          <?php endforeach ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="description">
    <div class="container">
      <p><?php echo $post['text'] ?> </p>
    </div>
  </div>
  <div class="social">
    <ul>
      <li><a href="#" class="fa fa-facebook"></a></li>
      <li><a href="#" class="fa fa-instagram"></a></li>
      <li><a href="#" class="fa fa-linkedin"></a></li>
      <li><a href="#" class="fa fa-vk"></a></li>
      <li><a href="#" class="fa fa-odnoklassniki"></a></li>
    </ul>
  </div>
</section>
