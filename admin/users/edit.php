<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
  usersOnly()
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
$dataNasc = $row["dataNascita"];
$utente = $row["id"];
// Associative array
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


$checksession=$_SESSION['id'];

if($checksession!=$utente && $_SESSION['admin'] != 1)

{
 header("Location: index.php");
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

        <title>Admin - Modifica Utente</title>
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
                    <a href="create.php" class="btn btn-big"style="background:#910477;">Aggiungi Utente</a>
                    <a href="index.php" class="btn btn-big"style="background:#910477;">Modifica Utenti</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Modifica Utente</h2>

                    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                    <form action="edit.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <div>
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Nome</label>
                            <input type="text" name="nome" value="<?php echo $utentenome; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Cognome</label>
                            <input type="text" name="cognome" value="<?php echo $utentecognome; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Biografia</label>
                            <textarea  maxlength="500" type="text" name="biografia" value="<?php echo $utentebio; ?>" class="text-input"></textarea>
                        </div>
                        <div>
                            <label>Data di Nascita</label>
                            <input type="date" name="dataNascita" value="<?php echo $dataNasc; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Conferma Password</label>
                            <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
                        </div>
                        <div>
                            <?php if (isset($admin) && $admin == 1): ?>
                                <label>
                                    <input type="checkbox" name="admin" checked>
                                    Admin
                                </label>
                            <?php else: ?>
                                <label>
                                    <input type="checkbox" name="user" checked>
                                   User
                                </label>
                            <?php endif; ?>
                            
                        </div>

                        <div>
                            <button type="submit" name="update-user" class="btn btn-big"style="background:#910477;">Aggiorna Utente</button>
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