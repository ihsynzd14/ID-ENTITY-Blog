<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/database/db.php");  ?>
<?php 

$user_id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = $user_id";    // ..ottengo quel determinato utente

$result = mysqli_query($conn,$sql);


$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$username = $row["username"];
$utentenome = $row["nome"];
$utentemail = $row["email"];
$utentecognome = $row["cognome"];
$utentebio = $row["biografia"];
$datareg = $row["created_at"];
$utente = $row["id"];
// Associative array
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<?php 

$posts = array();
$postsTitle = 'Post Recenti';

if (isset($_GET['t_id'])) {
  $postsTitle = "Hai cercato  '" . $_GET['name'] . "'";
} else if (isset($_POST['search-term'])) {
  $postsTitle = "Hai cercato '" . $_POST['search-term'] . "'";
  $posts = searchPosts($_POST['search-term']);
} else {
  $posts = getPublishedPosts();
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Font Awesome -->
        <link rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
            crossorigin="anonymous">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Candal|Lora"
            rel="stylesheet">

        <!-- Custom Styling -->
        <link rel="stylesheet" href="assets/css/userprofile.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
        <title>Profilo Personale</title>
  <link rel="shortcut icon" type="image/jpg" href="https://i.ibb.co/HHw4Mv7/favicon.png"/>
    </head>
    <body>
        
  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
  <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

    <div class="page-content page-container " id="page-content">
    <div class="col-12  padding d-flex justify-content-center">
        <div class="row container d-flex justify-content-center">
<div class="col-xl-8 col-md-10 ">
                                                <div class="mt-10 card user-card-full">
                                                    <div class="row m-l-0 m-r-0">
                                                        <div class="col-sm-4 bg-c-lite-green user-profile">
                                                            <div class="card-block text-center text-white">
                                                                <div class="m-b-25">
                                                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" width="150px" class=" col-12 img-radius" alt="User-Profile-Image">
                                                                </div>
                                                                <h6 class="f-w-600 h3"> <?php echo $username?></h6>
                                                            </div>
                                                               
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="card-block">
                                                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informazione di Utente</h6>
                                                                <div class="row">
                                                                    <div class="col-sm-10">
                                                                        <p class="m-b-10 f-w-600">Email</p>
                                                                        <h6 class="text-muted f-w-400"><?php echo $utentemail?></h6>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p class="m-b-10 f-w-600">Nome e Cognome</p>
                                                                        <h6 class="text-muted f-w-400"><?php echo $utentenome?> <?php echo $utentecognome?></h6>
                                                                    </div>
                                                                </div>
                                                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Biografia</h6>
                                                                <div class="row">
                                                                <div class="col-sm-10">
                                                                        <p class="m-b-10 f-w-600"><?php echo $utentebio ?></p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <h6 class="text-muted f-w-400" style="font-size: 14px;">Registrato: <br><?php echo $datareg ?></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                             </div> 
                                                </div>
                                            </div>

                                            
<!-- // Page Wrapper -->

<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Slick Carousel -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- Custom Script -->
<script src="assets/js/scripts.js"></script>
</body>
<footer>  <a style="font-weight:bold; font-size:20px; padding:20px; background: #D413B1; border:#D413B1; margin-top: -1rem; margin-left: 48rem;" class="btn btn-primary" href="profileblogs.php?id=<?php echo $utente; ?>">VEDI TUTTI I BLOG</a> </footer>
</html>