
<section class="account">
  <div class="container">
    <div class="row">
      <?php require_once VIEWS.'pages/acc/left_aside.php' ?>
      <div class="left-column">
        <span class="open-aside" onclick="rightColumn()">&#9776;</span>
        <h1><?php echo @$title?> </h1>
        <?php echo isset($_SESSION['user'])?'<span>'.$_SESSION['user']['userName'].'</span>':''?>
        <div class="add-post mtb-3"><a href="/add_post" class="btn btn-blue"> Добавить &raquo;</a> </div>
        <table>
          <caption>My posts</caption>
          <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Date added</th>
            <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>
          <?php if ($posts): ?>
          <?php foreach ($posts as $post): ?>
          <tr>
            <td data-label="Title"><i class="fa fa-image"></i> <?php echo $post['title'] ?></td>
            <td data-label="Author"><?php echo $post['author'] ?></td>
            <td data-label="Date added"><?php echo $post['date'] ?></td>
            <td data-label="Action"><a href="/edit_post/<?php echo $post['id'] ?>" class="btn-sm btn-yellow mr-1">Edit</a> <a href="/delete_post/<?php echo $post['id'] ?>" class="btn-sm btn-red">Delete</a></td>
          </tr>
            <?php endforeach; ?>
          <?php else: ?>
          <?php endif ?>
          </tbody>
        </table>
      </div>
    </div>
</section>
