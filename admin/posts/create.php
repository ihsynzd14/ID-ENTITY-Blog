<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php"); 
  usersOnly();

if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $blog = selectOne('blogs', ['id' => $_GET['id']]);
  }
  $topics = selectAll('topics');
  $posts = selectAll('posts', ['published' => 1]);#
  $blogs = selectAll('blogs', ['published' => 1]);
  
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

        <title>Admin - Aggiungi Post</title>
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
                    <a href="create.php" class="btn btn-big"style="background:#910477;">Aggiungi Post</a>
                    <a href="index.php" class="btn btn-big"style="background:#910477;">Gestisci Post</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Aggiungi Post</h2>

                    <?php include(ROOT_PATH . '/app/helpers/formErrors.php'); ?>

                    <form action="create.php" method="post" enctype="multipart/form-data">
                        <div>
                            <label>Titolo</label>
                            <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                        </div>
                        <div>
                            <label>Contenuto</label>
                            <textarea name="body" id="body"><?php echo $body ?></textarea>
                        </div>
                        <div>
                            <label>Foto</label>
                            <input type="file" name="image" class="text-input">
                        </div>
                        <div>
                            <label>Blog</label>
                            <select name="blog_id" class="text-input">
                                <option value=""></option>
                                <?php foreach ($blogs as $key => $blog): ?>
                                    <?php if($blog['user_id'] == $_SESSION['id']):?>
                                    <option selected value="<?php echo $blog['id'] ?>"><?php echo $blog['title']  ?></option>
                                    <?php endif ?>
                                    <?php endforeach; ?>

                            </select>
                        </div>
                        <div>
                            <?php if (empty($published)): ?>
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
                            <button type="submit" name="add-post" class="btn btn-big"style="background:#910477;">Aggiungi Post</button>
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