<div class="right-column">
  <h3>Last posts</h3>
  <?php if ($lastPosts): ?>
    <?php foreach ($lastPosts as $post): ?>
      <div class="item">
        <h4><?php echo $post['title'] ?></h4>
        <figure>
          <img src="/img/upload/<?php echo $post['file'] ?>" alt="" class="w3-container w3-center w3-animate-opacity">
          <figcaption>
            <span><?php echo mb_substr($post['text'], 0, 20) ?>...</span>
            <span><?php echo dmyDateFormat($post['date']) ?></span>
          </figcaption>
        </figure>
        <a href="/post/<?php echo $post['id'] ?>" class="link">More</a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
  <?php endif ?>
</div>