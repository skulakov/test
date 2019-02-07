<div class="right-column" id="myNav">
  <span class="close-aside" onclick="rightColumn()">&#10006;</span>
  <h3>Left navigation</h3>

  <button class="accordion btn btn-default">Profile</button>
  <div class="panel">
    <span class="user-profile"><?php echo $user['userName'] ?></span>
    <span class="user-profile"><?php echo $user['email'] ?></span>
    <a class="link" href="/profile">Edit profile</a>
  </div>

  <button class="accordion btn btn-default">Links</button>
  <div class="panel">
    <ul class="left-nav">
      <li><a class="link" href="#">Link</a></li>
      <li><a class="link" href="#">Link</a></li>
      <li><a class="link" href="#">Link</a></li>
      <li><a class="link" href="#">Link</a></li>
      <li><a class="link" href="#">Link</a></li>
    </ul>
  </div>
<?php if($user['status_id'] == 1):?>
  <button class="accordion btn btn-default">Home page</button>
  <div class="panel">
    <span class="user-profile"><b>Brand: </b> <?php echo $home['site_name'] ?></span>
    <span class="user-profile"><b>Title: </b> <?php echo $home['title'] ?></span>
    <li><a class="link" href="/edit_home">Edit home page</a></li>
  </div>
  <?php endif;?>
  <button class="accordion btn btn-default">Other</button>
  <div class="panel">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
  </div>
</div>