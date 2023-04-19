<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/blogs.php");
  usersOnly();
  
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
$checksession=$_SESSION['id'];
if(($col_id != $checksession && $checksession!=$blog['user_id']) && $_SESSION['admin'] != 1)

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

        <title>Admin - Modifica Blog</title>
    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big"style="background:#910477;">Aggiungi Blog</a>
                    <a href="index.php" class="btn btn-big"style="background:#910477;">Gestisci Blog</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Modifica Blog</h2>

                    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div>
                            <label>Titolo</label>
                            <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                        </div>
                        <div>
                            <label>Descrizione</label>
                            <textarea name="body" id="body"><?php echo $body ?></textarea>
                        </div>
                        <div>
                            <label>Foto</label>
                            <input type="file" name="image" class="text-input">
                        </div>
                        <div>
                            <label>Argomento</label>
                            <select name="topic_id" class="text-input">
                                <option value=""></option>
                                <?php foreach ($topics as $key => $topic): ?>
                                    <?php if (!empty($topic_id) && $topic_id == $topic['id'] ): ?>
                                        <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        
                        <div>
                            <?php if (empty($published) && $published == 0): ?>
                                <label>
                                    <input type="checkbox" name="published">
                                    Pubblica
                                </label>
                            <?php else: ?>
                                <label>
                                    <input type="checkbox" name="published" checked>
                                    Pubblica
                                </label>
                            <?php endif; ?>
                           

                        </div>
                        <div>
                            <button type="submit" name="update-blog" class="btn btn-big"style="background:#910477;">Aggiorna Blog</button>
                        </div>
                    </form>

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

    </body>

</html>