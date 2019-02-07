<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700i|Permanent+Marker&amp;subset=cyrillic"
        rel="stylesheet">
  <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css">
</head>
<body>
<header>
  <div class="logo w3-container w3-center opacity">
    <span><?php echo $site['site_name'] ?></span>
  </div>

  <nav id="navbar">
    <div class="container" id="nav">
      <span class="toggle"></span>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/posts">Posts</a></li>
        <li><a href="/gallery">Gallery</a></li>
      </ul>

      <?php if (isset($_SESSION['user'])): ?>
        <ul>
          <li><a href="/account">Account</a></li>
          <li><a href="/logout">Logout</a></li>
        </ul>
      <? else: ?>
        <ul>
          <li><a href="/registry">Registry</a></li>
          <li><a href="/login">Login</a></li>
        </ul>
      <?php endif; ?>
    </div>
  </nav>
</header>
<main>
  <?php require_once $this->page ?>
</main>
<footer>
  <span class="copy"> &copy; <?php echo date('Y') ?></span>
</footer>
<?php if (isset($post['file'])): ?>
  <div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img src="" class="modal-content" id="img01">
    <div id="caption"></div>
  </div>
<?php endif ?>
<script src="/js/js.js"></script>
</body>
</html>