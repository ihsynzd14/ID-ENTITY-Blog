<header style="background-color:#C704A3;">
<img src="https://i.ibb.co/bgsFQ76/THEPIXEL65624.png" alt="ID-Entity">
    <a href="<?php echo BASE_URL . '/index.php' ?>" class="logo" >
    </a>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav" style="font-weight:bold; font-family: Segoe UI Emoji;">
      <li><a href="<?php echo BASE_URL . '/index.php' ?>" class="item button secondary"><i class="fa fa-home"></i></a></li>
      <?php if (isset($_SESSION['id'])): ?>
        <li><a href="#foot"><i class="fas fa-question-circle"></i></a></li>
        <li>
          <style> .navUser{color:white} .navUser:hover{color:white; text-decoration: none;} .navProfile{color: blue;} .navProfile:hover{text-decoration: none}  .navLogout{color: red;} .navLogout:hover{color: red; text-decoration: none;} </style>
          <a href="#" class="navUser">
            <i class="fa fa-user"></i>
            <?php echo $_SESSION['username']; ?>
            <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
          </a>
          
          <ul>
            <?php if($_SESSION['admin']): ?>
              <li><a class="navProfile"href="/blog/admin/users/index.php?id=<?php echo $_SESSION['id']; ?>"class="navUser">Gestione Admin</a></li>
              <li><a class="navProfile" href="/blog/profiles.php?id=<?php echo $_SESSION['id']; ?>"class="navUser">Profilo</a></li>
              <li><a class="navLogout" href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Log Out</a></li>
            <?php endif; ?>
            <?php if(!$_SESSION['admin']): ?>
              <li><a class="navProfile" href="/blog/admin/users/index.php?id=<?php echo $_SESSION['id']; ?>"class="navUser">Gestione</a></li>
              <li><a class="navProfile" href="/blog/profiles.php?id=<?php echo $_SESSION['id']; ?>"class="navUser">Profilo</a></li>
              <li><a class="navLogout" href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Log Out</a></li>
            <?php endif; ?>
           
          </ul>
        </li>
      <?php else: ?>
        <li ><a style="color:white;" href="<?php echo BASE_URL . '/register.php' ?>" >Sign Up</a></li>
        <li ><a style="color:white;" href="<?php echo BASE_URL . '/login.php' ?>">Login</a></li>
      <?php endif; ?>
    </ul>
</header>