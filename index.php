<?php

if(isset($_GET["redirect"]) && isset($_GET["delay"])){
    header("Refresh: ".$_GET["delay"]."; url=https://".$_GET["redirect"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body <?php if(isset($_GET["Secret"])){ echo 'style=background-color:'.$_GET["Secret"].';"'; } ?> >
    <div class="container">
       <div class="forms">
          <div class="form login">
              <h3 class="text-center" style="color:blacksmoke"><?php if(isset($_GET["response"])){ echo $_GET["response"]; } ?></h3>
             <span class="title">Login</span> 
             <form method="post" action="login.php">
                <div class="input-field">
                    <input type="email" name="uname" placeholder="Username">
                    <i class="uil uil-envelope-edit icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" required="" placeholder="Password" name="passwd">
                    <i class="uil uil-keyhole-circle icon"></i>
                 </div>
                 <div class="input-field button">
                    <input type="submit" value="Login"  >
                </div>
             </form>
         </div>
        </div>  
       </div> 
    </div>
</body>
</html>




