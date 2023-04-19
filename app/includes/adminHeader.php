<header style="background-color:#C704A3;">
    <a class="logo" href="<?php echo BASE_URL . '/index.php'; ?>">
        <h1 class="logo-text"><span>ID-</span>ENTITY</h1>
    </a>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
        <?php if (isset($_SESSION['username'])): ?>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                <?php if($_SESSION['admin']): ?>
              <li><a style="color:blue"class="navProfile"href="/blog/admin/users/index.php?id=<?php echo md5($_SESSION['id']); ?>"class="navUser">Gestione Admin</a></li>
              <li><a style="color:blue"class="navProfile" href="/blog/profiles.php?id=<?php echo $_SESSION['id']; ?>"class="navUser">Profilo</a></li>
              <li><a style="color:red" class="navLogout" href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Log Out</a></li>
            <?php endif; ?>
            <?php if(!$_SESSION['admin']): ?>
              <li><a style="color:blue"class="navProfile" href="/blog/admin/users/index.php?id=<?php echo md5($_SESSION['id']); ?>"class="navUser">Gestione</a></li>
              <li><a style="color:blue"class="navProfile" href="/blog/profiles.php?id=<?php echo $_SESSION['id']; ?>"class="navUser">Profilo</a></li>
              <li><a style="color:red" class="navLogout" href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Log Out</a></li>
            <?php endif; ?>

                </ul>
            </li>
        <?php endif; ?>
    </ul>
</header>