<?php 
include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");

$blogs = array();
$posts = array();
$postsTitle = 'Post Recenti';

if (isset($_GET['t_id'])) {
  $blogs = getBlogsByTopicId($_GET['t_id']);
  $postsTitle = "Hai cercato  '" . $_GET['name'] . "'";
} else if (isset($_POST['search-term'])) {
  $postsTitle = "Hai cercato '" . $_POST['search-term'] . "'";
  $posts = searchPosts($_POST['search-term']);
} else {
  $posts = getPublishedPosts();
  $blogs = getPublishedBlogs();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="assets/css/style.css">

  <title>Blog</title>
  <link rel="shortcut icon" type="image/jpg" href="https://i.ibb.co/HHw4Mv7/favicon.png"/>
</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
  <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>



  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Post Slider -->
    <div class="post-slider">
      <h1 class="slider-title">Blog Recenti</h1>
      <i class="fas fa-chevron-left prev"></i>
      <i class="fas fa-chevron-right next"></i>

      <div class="post-wrapper">

        <?php foreach ($blogs as $blog): ?>
          <div class="post">
            <img src="<?php echo BASE_URL . '/assets/images/' . $blog['image']; ?>" alt="" class="slider-image">
            <div class="post-info">
              <h4><a href="blogsingle.php?id=<?php echo $blog['id']; ?>"><?php echo $blog['title']; ?></a></h4>
              <i class="far fa-user"> <a href="profiles.php?id=<?php echo $blog['user_id']; ?>"><?php echo $blog['username']; ?></a> </i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($blog['created_at'])); ?></i>
            </div>
          </div>
        <?php endforeach; ?>


      </div>

    </div>
    <!-- // Post Slider -->

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content -->
      <div class="main-content">
        <h1 class="recent-post-title"><?php echo $postsTitle ?></h1>

        <?php foreach ($posts as $post): ?>
          <div class="post clearfix">
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="post-image">
            <div class="post-preview">
              <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
              <i class="far fa-user"> <a href="profiles.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username']; ?></a></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
              <p class="preview-text">
                <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
              </p>
              <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more" style="a.btn.read-more:hover:color:black">Leggi Tutto</a>
            </div>
          </div>    
        <?php endforeach; ?>
        
      </div>
      <!-- // Main Content -->

      <div class="sidebar">

        <div class="section search">
          <a href="search.php"> <h2 class="section-title">Vuoi trovare un post?</h2></a>
        </div>


        <div class="section topics">
          <h2 class="section-title">Argomenti</h2>
          <ul>
            <?php foreach ($topics as $key => $topic): ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

      </div>

    </div>
    <!-- // Content -->

  </div>
  <!-- // Page Wrapper -->

  <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Slick Carousel -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

</body>

</html>