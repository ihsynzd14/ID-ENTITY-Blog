<?php include('path.php'); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
guestsOnly();
?>
<?php include(ROOT_PATH . "/app/includes/headerS.php"); ?>


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

  <title>ACCEDI</title>
  <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
</head>
 
<body>


<main>



<div class="login-page vh-100 bg-image"
  style="background-image: url('img/vapor2.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 offset-lg-1">
              <h3 class="mb-3" style="color:white;">ACCEDI</h3>
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <form action="login.php" method="post" class="row g-4">
                                        <div class="col-12">
                                            <label>Username<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Scrivi Username">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" name="password" value="<?php echo $password; ?>" placeholder="Password..." class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                <label class="form-check-label" for="inlineFormCheck">Ricordami</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6" style="left: 16%;">
                                            <a class="float-end text-primary" href="<?php echo BASE_URL . '/register.php' ?>">Non hai un account?</a></p>
                                        </div>

                                        <div class="col-12">
                                        <button type="submit" name="login-btn" class="btn btn-primary px-4 float-end mt-4">INVIA</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 ps-0 d-none d-md-block">
                            <div class="form-right h-100 text-white text-center pt-5" style="background-color:#C704A3;">
                                <i class="bi bi-bootstrap"></i>
                                <h2 class="fs-1 text-white" style="line-height:50px;">Bentornato/a su <br> Id-Entity</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

</body>

</html>