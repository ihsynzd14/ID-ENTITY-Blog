<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
 usersOnly()
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
<?php  

$user_id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = $user_id";    // ..ottengo quel determinato utente

$result = mysqli_query($conn,$sql);


$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$username = $row["username"];
$utentenome = $row["nome"];
$amministratore = $row["admin"];
$utentemail = $row["email"];
$utentecognome = $row["cognome"];
$utentebio = $row["biografia"];
$datareg = $row["created_at"];
$utente = $row["id"];
// Associative array
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


$checksession=$_SESSION['id'];

if($checksession!=$utente && $_SESSION['admin'] != 1)

{
 header("Location: /blog/404.php");
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
        <link rel="stylesheet" href="../../assets/css/style.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../assets/css/admin.css">

        <title>Admin - Gestisci Utenti</title>
        <link rel="shortcut icon" type="image/jpg" href="https://i.ibb.co/HHw4Mv7/favicon.png"/>
    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>

            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big" style="background:#910477;">Aggiungi Utente</a>
                  <a class="btn btn-big" style="background:#910477;" href="/blog/admin/users/index.php?id=<?php echo $_SESSION['id']; ?> ">Gestisci Utente</a>
                </div>
                <div class="content">
                    <h2 class="page-title">Gestisci Utenti</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                        <table>
                        <thead>
                            <th>N°</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th colspan="2">Azione</th>
                        </thead>
                        <tbody>
                            <?php if($_SESSION['admin']==1): ?>
                            <?php foreach ($admin_users as $key => $user): ?>
                                    <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><a href="edit.php?id=<?php echo $user['id']; ?>" class="edit">modifica</a></td>
                                    <td><a onclick="myFunction()" value="save" class="delete">elimina</a></td>
                                </tr>                                         
                            <?php endforeach; ?>
                             <?php endif; ?>
                             
                                <?php foreach ($admin_users as $key => $user): ?>
                                    <?php if($_SESSION['admin'] ==0 && $_SESSION['admin'] != 1 && $_SESSION['username'] == $user['username']): ?>

                                <tr>
                                    <td></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><a href="edit.php?id=<?php echo $user['id']; ?>" class="edit">modifica</a></td>
                                    <td><a onclick="myFunction()" value="save" class="delete">elimina</a></td>
                                </tr>  
                                <?php endif; ?>
                                <?php endforeach; ?>                                       
               
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- // Admin Content -->

        </div>
        <!-- // Page Wrapper -->



        <!-- JQuery -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Ckeditor -->
        <script
            src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
        <!-- Custom Script -->
        <script src="../../assets/js/scripts.js"></script>

        <!-- Alert di Confermazione -->
        <script> 
        function myFunction() {
        let text = "Sei sicuro di voler proseguire eliminare profilo?";
        if (confirm(text) == true) {
            window.location='index.php?delete_id=<?php echo $user['id']; ?>';  
        } else {   
            window.location='/blog/admin/users/index.php?id=<?php echo $_SESSION['id']; ?>';  
        }
        }
        </script>

    </body>

</html>