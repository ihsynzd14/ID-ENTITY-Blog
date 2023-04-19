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

    <div class="container">
   
   <div class="post-preview">
  
   </div>
  </div>


      <!-- Main Content -->
      <div class="main-content">
        <br />
      <h1 style="margin-left:2.2%;">Ricerca dei Post</h1><br />
     <input style="margin-left:2.5%;" type="text" name="search_text" id="search_text" placeholder="Cerchi Post" class="form-control" />
   <br />
          <div class="post clearfix">
          <div id="result"></div>
          </div>    
 
        
      </div>
      <!-- // Main Content -->

      <div class="sidebar">
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

  <script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

</body>

</html>