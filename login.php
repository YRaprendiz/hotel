<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include("./header.php");// Incluir o arquivo cabeçalho e menu
    include("./connexion.php");// Incluir o arquivo de conexão com o banco de dados
    ?>

    <div class="login-page">
        <div class="form">
        <form class="login-form"   method="POST" action="#">
            <input type="text" name="email" placeholder="Email"/>
            <input type="password" name="password" placeholder="Password"/>
            <button type="submit" name="connexion">sign in</button>
            <i class="message">Not registered? <a href="register.php">Create an account</a></i>
        </form>
        </div>
    </div>
    <?php
    
    ///////////////////////////
    //Gestion connexion   /////
    //////////////////////////
    if(isset($_POST["connexion"])){
        if(empty($_POST["email"]) 
            ||empty($_POST["password"])){
            echo "<div class='msg'><p style='color:yellow'><q>Tous les champs sont obligatoires!</q></p></div>";
        }else{
            $stmt = $connexion->prepare("SELECT * FROM user WHERE email=:email"); 
            $stmt->execute(array("email"=>$_POST['email'])); 
            $row = $stmt->fetch();
            if(password_verify($_POST['password'], $row["password"])){
                $_SESSION["user"]= $row;
                header("Location: index.php");
                
            }else{
                echo "<div class='msg'><p style='color:yellow'>Identifiants incorrect!</p></div>";
            }
        }
    }
    
    include("./footer.php");
    ?>
</body>
<style>
    body { 
        width: 100%;
        height:100%;
        font-family: 'Open Sans', sans-serif;
        background: #092756;
        background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
        background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
        background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
    }
</style>
</html>
