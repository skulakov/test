<section class="articles">
  <div class="container">
    <div class="row">
      <div class="left-column">
        <h1><?php echo $title ?></h1>
        <div class="pagination">
          <?php
//            if(!$pageNum)$pageNum=1;
            if ($pageNum > 1) {
              echo ' <a class="link-prev" href="/page/' . ($pageNum - 1) . '"> Preview </a> ';
            }
          ?>

          <?php if ($pageCount > 1): ?>

            <?php for ($i = 1; $i <= $pageCount; $i++): ?>
              <a <?php echo ($pageNum == $i) ? 'class="link-pgn-active"' : '' ?>
                  href="/page/<?php echo $i ?>"> <?php echo $i ?> </a>
            <?php endfor ?>
          <?php endif; ?>

          <?php if ($pageNum < $pageCount) {
            echo ' <a class="link-next" href="/page/' . ($pageNum + 1) . '"> Next </a> ';
          }
          ?>
        </div>
        <?php if ($posts): ?>
          <?php foreach ($posts as $post): ?>
            <article>
              <h2><?php echo $post['title'] ?></h2>
              <figure>
                <img src="/img/upload/tmb/<?php echo $post['file'] ?>" alt="" class="img-posts">
              </figure>
              <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...</p>

              <p class="t-a-r f-st-i small">
                Posted on
                <time datetime="<?php echo $post['date'] ?>"><?php echo dmyDateFormat($post['date'])?></time>
                by <?php echo $post['author'] ?>.
              </p>
              <a href="/post/<?php echo $post['id'] ?>" class="link">More</a>

            </article>
          <?php endforeach; ?>
        <?php else: ?>
        <?php endif ?>


        <div class="pagination">
          <?php
            if ($pageNum > 1) {
              echo ' <a class="link-prev" href="/page/' . ($pageNum - 1) . '"> Preview </a> ';
            }
          ?>

          <?php if ($pageCount > 1): ?>

            <?php for ($i = 1; $i <= $pageCount; $i++): ?>
              <a <?php echo ($pageNum == $i) ? 'class="link-pgn-active"' : '' ?>
                  href="/page/<?php echo $i ?>"> <?php echo $i ?> </a>
            <?php endfor ?>
          <?php endif; ?>

          <?php if ($pageNum < $pageCount) {
            echo ' <a class="link-next" href="/page/' . ($pageNum + 1) . '"> Next </a> ';
          }
          ?>
        </div>

      </div>
      <?php require_once VIEWS . '/pages/posts/right_aside_page.php' ?>
    </div>
  </div>
</section>