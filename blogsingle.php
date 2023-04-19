<?php include("path.php"); ?>
<?php include(ROOT_PATH . '/app/controllers/blogs.php');

if (isset($_GET['id'])) {
  $post = selectOne('posts', ['id' => $_GET['id']]);
  $blog = selectOne('blogs', ['id' => $_GET['id']]);
}
$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);
$blogs = selectAll('blogs', ['published' => 1]);

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

  <title><?php echo $blog['title']; ?> | IdEntity</title>
</head>

<body>
  <!-- Facebook Page Plugin SDK -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=285071545181837&autoLogAppEvents=1">
  </script>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content Wrapper -->
      <div class="main-content-wrapper">
        <div class="main-content single">
          <h1 class="post-title"><?php echo $blog['title']; ?></h1>

          <div class="post-content">
            <?php echo html_entity_decode($blog['body']); ?>
          </div>

          <div class="blog-content">
          <?php foreach ($posts as $post): ?>
            <?php if($post['blog_id'] == $blog['id']): ?>
          <div class="post clearfix">
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="post-image">
            <div class="post-preview">
              <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
              <p class="preview-text">
                <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
              </p>
              <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more" style="a.btn.read-more:hover:color:black">Leggi Tutto</a>
            </div>
          </div>    
          <?php endif ?>
        <?php endforeach; ?>
          </div>

        </div>
      </div>

      <!-- // Main Content -->

      <!-- Sidebar -->
      <div class="sidebar single">

        <div class="fb-page" data-href="" data-small-header="false"
          data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        </div>


        <div class="section popular">
          <h2 class="section-title">Blog Recenti</h2>

          <?php foreach ($blogs as $b): ?>
            <div class="post clearfix">
              <img src="<?php echo BASE_URL . '/assets/images/' . $b['image']; ?>" alt="">
              <a href="" class="title">
                <h4><?php echo $b['title'] ?></h4>
              </a>
            </div>
          <?php endforeach; ?>
          

        </div>

        <div class="section topics">
          <h2 class="section-title">Argomenti</h2>
          <ul>
            <?php foreach ($topics as $topic): ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>

          </ul>
        </div>
      </div>
      <!-- // Sidebar -->

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