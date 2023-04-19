<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/blogs.php");
  usersOnly();
?>


<?php 
// per vedere autore
$blogs = array();

if (isset($_GET['t_id'])) {
  $blogs = getBlogsByTopicId($_GET['t_id']);
} else {
  $blogs = getPublishedBlogs();
}
?>

<?php 
$table = 'collaborators';
$uscuid = $_SESSION['id'];
$sql = "SELECT * FROM $table WHERE coautore_id = $uscuid";    // ..ottengo quel determinato utente

$result = mysqli_query($conn,$sql);

$collabs = mysqli_fetch_array($result, MYSQLI_ASSOC);
$col_id = $collabs["coautore_id"];
$col_blog_id = $collabs["blog_id"];

// Associative array
$collabs = mysqli_fetch_array($result, MYSQLI_ASSOC);

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

        <title>Admin - Gestisci Blog</title>
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
                    <a href="create.php" class="btn btn-big" style="background:#910477;">Aggiungi Blog</a>
                    <a href="index.php" class="btn btn-big"  style="background:#910477;">Gestisci Blog</a>
                    <a href="coautore.php" class="btn btn-big"  style="background:#910477;">Aggiungi Coautore</a>
                    <a href="archives.php" class="btn btn-big" style="background:#910477;">Blog Archiviati</a>
                </div>



                <div class="content">                            
                    <h2 class="page-title">Gestisci Blog</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <table>
                        <thead>
                            <th>N°</th>
                            <th>Titolo</th>
                            <th>Autore</th>
                            <th colspan="3">Azione</th>
                        </thead>
                        <tbody>

                <?php if( $_SESSION['admin'] == 1): ?>
                <?php foreach ($blogs as $key => $blog): ?>
                                    <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $blog['title'] ?></td>
                                    <td><?php echo $blog['username']  ?></td>
                                    <td><a href="edit.php?id=<?php echo $blog['id']; ?>" class="edit">modifica</a></td>
                                    <td><a onclick="myFunction()" value="save" class="delete">elimina</a></td>

                                    <?php if ($blog['published']): ?>
                                        <td><a href="edit.php?published=0&p_id=<?php echo $blog['id'] ?>" class="unpublish">archivia</a></td>
                                    <?php else: ?>
                                        <td><a href="edit.php?published=1&p_id=<?php echo $blog['id'] ?>" class="publish">pubblica</a></td>
                                    <?php endif; ?> 
                                </tr>

                                 <?php endforeach; ?>
                                 <?php endif; ?>


                                 <?php foreach ($blogs as $key => $blog): ?>
                                <?php if(($col_id == $_SESSION['id'] && $col_blog_id == $blog['id'] && $_SESSION['admin'] != 1 && $_SESSION['admin'] == 0 )|| $blog['user_id'] == $_SESSION['id']): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $blog['title'] ?></td>
                                    <td><?php echo $blog['username']  ?></td>
                                    <td><a href="edit.php?id=<?php echo $blog['id']; ?>" class="edit">modifica</a></td>
                                    <td><a href="edit.php?delete_id=<?php if ($blog['user_id'] == $_SESSION['id'] || $_SESSION['admin'] == 1) {echo $blog['id'];} else{ header("Location: /admin/blogs/index.php");}  ?>" class="delete">elimina</a></td>
                                    
                                    

                                    <?php if ($blog['published']): ?>
                                        <td><a href="edit.php?published=0&p_id=<?php echo $blog['id'] ?>" class="unpublish">archivia</a></td>
                                    <?php else: ?>
                                        <td><a href="edit.php?published=1&p_id=<?php echo $blog['id'] ?>" class="publish">pubblica</a></td>
                                    <?php endif; ?>
                                    
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
    </body>

</html>