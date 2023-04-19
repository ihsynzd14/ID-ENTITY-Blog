<?php

// php code to Insert data into mysql database from input text
if(isset($_POST['insert']))
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "blog";
    
    // get values form input text and number

    $coautore_id = $_POST['coautore_id'];
    $blog_id = $_POST['blog_id'];
    
    // connect to mysql database using mysqli

    $connect = mysqli_connect($hostname, $username, $password, $databaseName);
    
    // mysql query to insert data

    $query = "INSERT INTO `collaborators`(`coautore_id`, `blog_id`) VALUES ('$coautore_id','$blog_id')";
    
    $result = mysqli_query($connect,$query);
    
    // check if mysql query successful

    if($result)
    {
        header("Location: /blog/admin/blogs/index.php");
    }
    
    else{
        header("Location: /blog/405.php");
    }
    
    mysqli_close($connect);
}

?>

<?php include("../../path.php"); ?>

<?php include(ROOT_PATH . "/app/controllers/blogs.php"); 
  usersOnly()
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

        <title>Admin - Aggiungi Blog</title>
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
                    <a href="create.php" class="btn btn-big"style="background:#910477;">Aggiungi Blog</a>
                    <a href="index.php" class="btn btn-big"style="background:#910477;">Gestisci Blog</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Aggiungi Coautore</h2>

                    <?php include(ROOT_PATH . '/app/helpers/formErrors.php'); ?>                   

                    <form action="coautore.php" method="post">

                    <label>Coautore</label>
                            <select name="coautore_id" class="text-input">
                                <option value=""></option>
                                <?php foreach ($users as $key => $user): ?>
                                    <option selected value="<?php echo $user['id'] ?>"><?php echo $user['username']  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                

                                <label>Blog</label>
                            <select name="blog_id" class="text-input">
                                <option value=""></option>
                                <?php foreach ($blogs as $key => $blog): ?>
                                    <option selected value="<?php echo $blog['id'] ?>"><?php echo $blog['title']  ?></option>
                                    <?php endforeach; ?>

                            </select>

                    <input type="submit" class="btn btn-big" style="background:#910477;" name="insert" value="INVIA">

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