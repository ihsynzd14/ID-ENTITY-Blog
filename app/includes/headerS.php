<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="shortcut icon" type="image/jpg" href="https://i.ibb.co/HHw4Mv7/favicon.png"/>
    <link rel="stylesheet" href="assets/css/welcomestyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/7ebc9f21e5.js" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
    crossorigin="anonymous"></script>
    <script>
    $(function() {
    $(".toggle").on("click", function() {
        if ($(".item").hasClass("active")) {
            $(".item").removeClass("active");
        } else {
            $(".item").addClass("active");
        }
    });
});
    </script>
    
</head>
<body>
    <nav>
        <ul class="menu">
            <li class="logo"><a href="welcome.php">CREA IL TUO BLOG</a></li>
<div>
<?php
                        if (isset($_SESSION['userId'])) {
                            echo '<form action="includes/logout.inc.php" method="post">
                                <button type="submit" name="logout-submit">Logout</button>
                            </form>'; 
                        }
                    ?>
                    </div>
            </li>
            <li class="item button secondary" ><a href="login.php" >ACCEDI</a></li>
            <li class="item button secondary"><a href="register.php">REGISTRATI</a></li>
            <li class="toggle"><span class="bars"></span></li>
        </ul>
    </nav>

                  
</body>
</html>
                    