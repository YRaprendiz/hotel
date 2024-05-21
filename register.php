<!DOCTYPE html>
<html>
	<head>
   	 	<meta charset="utf-8" />
   	 	<title>Register</title>
    	<link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <?php
          include("./header.php");
          include("./connexion.php");
        ?>
        <div class= "Register-Page">
          <div class="form">
            <form class="register-form"  method="POST" action="#">
                <input type="text" name="prenom" placeholder="Prénom"/>
                <input type="text" name="nom" placeholder="Nom"/>
                <input type="text" name="email" placeholder="Email"/>
                <input type="password" name="password" placeholder="Password"/>
                <button type="submit" name="inscription">Sign Up</button>
                <i class="message">Already registered? <a href="login.php">Sign In</a></i>
            </form>
        </div>
        <?php
        ///////////////////////////
        //Gestion inscription/////
        //////////////////////////
        if(isset($_POST["inscription"])){
            if(empty($_POST["prenom"])
                ||empty($_POST["nom"])
                ||empty($_POST["email"])
                ||empty($_POST["password"])){
                echo "<div class='mssg'><p style='color:yellow'><q>Tous les champs sont obligatoires!</q></p></div>";
            }else{
                try{
                    $stmt = $connexion->prepare("INSERT INTO `user`
                                                (`prenom`, `nom`, `email`, `password`)
                                                VALUES (:prenom, :nom, :email, :password);"); 
                    $stmt->execute(array("prenom"=> $_POST["prenom"],
                                            "nom"=>$_POST["nom"],
                                            "email"=>$_POST["email"],
                                            "password"=>password_hash($_POST["password"], PASSWORD_DEFAULT))); 
                }
                catch(PDOException $e){
                    printf("Erreur lors de l'inscription : %s\n", $e->getMessage());
                    exit();
                }finally{
                    echo "<div class='mssg'><p style='color:palegreen'>Inscription réussite!</p></div>";
                }
            }
        }
        
        include("./footer.php");
        
        ?>
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
    </body>
</html>
