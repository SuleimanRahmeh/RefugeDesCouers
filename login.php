<!DOCTYPE html>
<html>
    <head>
   	 	<meta charset="utf-8" />
   	 	<title>RefugeDesCœurs - Login</title>
    	<link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <?php
          include("./header.php");
          include("./connexion.php");
        ?>
        <?php
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
        ?>
        <div id="LoginForms">
            <form id="inscForm" method="POST" action="#" >
                <h3>S'inscrire</h3>
                <input type="text" name="lastname" placeholder="Nom"/><br />
                <input type="text" name="firstname" placeholder="Prénom"/><br />
                <input type="text" name="email" placeholder="Email"/><br />
                <input type="password" name="password" placeholder="mot de passe"/><br />
                <input type="submit" name="inscription" value="Valider">
            </form> 
            <form id="loginForm" method="POST" action="#">
                <h3>Se connecter</h3>
                <input type="text" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="mot de passe"/>
                <input type="submit" name="connexion" value="Valider">
            </form>
        </div>
        <?php
        ///////////////////////////
        //Gestion inscription/////
        //////////////////////////
        if(isset($_POST["inscription"])){
            if(empty($_POST["firstname"])
                ||empty($_POST["lastname"])
                ||empty($_POST["email"])
                ||empty($_POST["password"])){
                echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
            }else{
                try{
                    $stmt = $connexion->prepare("INSERT INTO `user`
                                                (`firstname`, `lastname`, `email`, `password`)
                                                VALUES (:firstname, :lastname, :email, :password);"); 
                    $stmt->execute(array("firstname"=> $_POST["firstname"],
                                            "lastname"=>$_POST["lastname"],
                                            "email"=>$_POST["email"],
                                            "password"=>password_hash($_POST["password"], PASSWORD_DEFAULT))); 
                }
                catch(PDOException $e){
                    printf("Erreur lors de l'inscription : %s\n", $e->getMessage());
                    exit();
                }finally{
                    echo "<p style='color:green'>Inscription réussite!</p>";
                }
            }
        }
        if(isset($_POST["connexion"])){
            if(empty($_POST["email"]) || empty($_POST["password"])){
                echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
            }else{
                $stmt = $connexion->prepare("SELECT * FROM user WHERE email=:email");
                $stmt->execute(array("email"=>$_POST['email']));
                $row = $stmt->fetch();
                if(password_verify($_POST['password'], $row["password"])){
                    
                    $_SESSION["user_id"] = $row['id'];
                    $_SESSION["type"] = $row['type'];
                    $_SESSION["user"] = $row;
                    $_SESSION["name"] =$row["firstname"];
                    $_SESSION["lastname"] =$row["lastname"];
                    $_SESSION["email"] =$row["email"];
                    
        
                    
                    if ($_SESSION['type'] == 1) {
                        header("Location: index.php");
                    } else {
                        header("Location: controlPanal.php");
                    }
                    exit;
                } else {
                    echo "<p style='color:red'>Identifiants incorrects!</p>";
                }
            }
        }
        
        
        ?>
        <?php
        include("./footer.php");
        ?>

    </body>
</html>

