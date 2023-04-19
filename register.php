<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
guestsOnly();
?>
  
<?php include(ROOT_PATH . "/app/includes/headerS.php"); ?>
<main>
  
<section class="vh-100 bg-image"
  style="background-image: url('img/vapor2.jpg');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Crea Account</h2>

              <form action="register.php" method="post">
              <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                <div class="form-outline mb-4">
                  <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username*" id="form3Example1cg" class="form-control form-control-lg" />
                
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="email"  value="<?php echo $email; ?>" placeholder="E-mail*" id="form3Example3cg" class="form-control form-control-lg" />
                  
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" name="nome" placeholder="Nome*" id="form3Example3cg" class="form-control form-control-lg" />
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" name="cognome" placeholder="Cognome*"id="form3Example3cg" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="password" minlength="8" value="<?php echo $password; ?>" placeholder="Password* (min. 8 caratteri)" id="form3Example4cg" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="passwordConf" minlength="8" value="<?php echo $passwordConf; ?>" placeholder="Conferma password*" id="form3Example4cdg" class="form-control form-control-lg" />
                </div>
                
                <div class="form-outline mb-4">
                  <input type="date" name="dataNascita" placeholder="Data di nascita" id="form3Example3cg" class="form-control form-control-lg" />
                </div>


                <div class="form-outline mb-4">
                  <textarea type="text" name="biografia" maxlength="500" placeholder="Biografia (max. 500 caratteri)" id="form3Example3cg" class="form-control form-control-lg" ></textarea>
                </div>


                <div class="d-flex justify-content-center">
                  <button type="submit" name="register-btn"
                    class="btn4 btn-danger btn-block btn-lg gradient-custom-6 text-body">INVIA</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Hai già un account? <a href="login.php"
                    class="fw-bold text-body"><u>Accedi</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main>

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>
