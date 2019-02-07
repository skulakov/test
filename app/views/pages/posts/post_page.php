<section class="post">
  <div class="container">
    <div class="row">
      <!--   Left column     -->
      <div class="left-column">

        <article>
          <h1 class="mb-2"><?php echo $title ?></h1>

          <figure>
            <img src="/img/upload/<?php echo $post['file'] ?>" alt="<?php echo $post['title'] ?>" id="myImg">

            <span id="zoom"><i class="fa fa-search-plus"></i></span>
          </figure>
          <p class="mt-1"><?php echo $post['text'] ?></p>
          <p class="t-a-r f-st-i small">
            Author <?php echo $post['author'] ?>
            <time datetime="<?php echo $post['date'] ?>"><?php echo dmyDateFormat($post['date'])?></time>
          </p>
        </article>
        <!--        <div class="pgn-post">
                  <a href="#" class="link-prev"> Preview</a><a href="#" class="link-next">Next </a>
                </div>-->
      </div>

      <!--  Right Column    -->
      <?php require_once VIEWS.'/pages/posts/right_aside_page.php'?>

    </div>
</section>