<?php 
include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");
$postsTitle = 'TUTTI I BLOG';

  $posts = getPublishedPosts();
  $blogs = getPublishedBlogs();

?>
<?php 
$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $user_id";    // ..ottengo quel determinato utente
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$utente = $row["id"];
// Associative array
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content -->
      <div class="main-content">
        <h1 class="recent-post-title"><?php echo $postsTitle ?></h1>
    
        <?php foreach ($blogs as $blog): ?>
          <?php if($blog['user_id'] == $utente ):?>
          <div class="post clearfix">
            <img src="<?php echo BASE_URL . '/assets/images/' . $blog['image']; ?>" alt="" class="post-image">
            <div class="post-preview">
              <h2><a href="blogsingle.php?id=<?php echo $blog['id']; ?>"><?php echo $blog['title']; ?></a></h2>
              <i class="far fa-user"> <?php echo $blog['username']; ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($blog['created_at'])); ?></i>
              <p class="preview-text">
                <?php echo html_entity_decode(substr($blog['body'], 0, 150) . '...'); ?>
              </p>
              <a href="blogsingle.php?id=<?php echo $blog['id']; ?>" class="btn read-more" style="a.btn.read-more:hover:color:black">Leggi Tutto</a>
            </div>
          </div> 
        <?php endif ?>
        <?php endforeach; ?>
        


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