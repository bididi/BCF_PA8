<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BCF - Inscription</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Roboto&display=swap" rel="stylesheet">
</head>
<header>
    <div class="header-bar">
        <a href="index.html"><img class="logo" src="../static/images/BCF_transparent.png" ></a>
    </div>
</header>


<body>
    <div class="connexion">
        <h1>S'inscrire</h1>
        <div class="form">
            <form class="ins" method="post">

                <label for="email">Enter your email : </label>
                <input class ="inp" name="email" id="email" type="text" placeholder="email" required>
				

                <label for="password">Enter your password : </label>
                <input class="inp" type="password" name="password" placeholder="Mot de passe" id="password"   required>

                <label for="password">Confirm your password : </label>
                <input class ="inp" type="password" name="verif" required>
				
				<p>Erreur : mots de passes différents!</p>

              
                <button class='espace' name="espace">Register </button>

            </form>
            <p>Vous avez déjà un compte ? <a class="identification" href="connexion.php">Se connecter</a></p>
            
        </div>
    </div>

</body>
<footer>
        <div class="foot">
            <p><i>L'IA au service de la santé</i></p>
            <! -- Liens vers page qui sommes-nous  -->
        </div>
        <div class="foot">
              <p><i>Copyright © BCF - 2020</i></p>
              <p>Contactez nous au : 0616344513 </p>
        </div>
        <div class="foot">
            <p><a href="https://www.facebook.com/BreastCancerFinder/?notif_id=1605289323338281&notif_t=page_fan&ref=notif" target="_blank" rel="nofollow">Facebook</a></p>
            <p><a href="https://www.facebook.com/BreastCancerFinder/?notif_id=1605289323338281&notif_t=page_fan&ref=notif" target="_blank" rel="nofollow">Instagram</a></p>
            <! -- Liens vers nos réseaux sociaux  -->
        </div>

    </footer>

<?php
         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = '';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
		 $conn ->select_db('bcf');
      
         if(! $conn ) {
            die('Could not connect: ' . mysqli_connect_error());
         }else{
         
			//echo 'Connected successfully';
         
		 }
    
        
		if(isset($_POST['espace'])){
			extract($_POST);
			
			
			$query = $conn->prepare("SELECT * FROM connexion WHERE EMAIL = ? ");
			$query->bind_param('s', $email);
			$query->execute();
			$result = $query->get_result();
			
			if (mysqli_num_rows($result) > 0) {
				echo"compte existe déjà";
				$query->close();
				header ('Location: WrongMail.php');
				
			}elseif($verif != $password){
				header ('Location: WrongPassword.php');
			}				
			else{
				$query->close();
				$hashed = hash('sha512', $_POST['password']);
				$sql1 = $conn->prepare("INSERT INTO connexion (EMAIL,MDP) VALUES (?,?)");
				if ($sql1 === false) {
					printf("Message d'erreur :");
					die();
				}
				
				$sql1->bind_param('ss',$email,$hashed);
				$sql1->execute();	
				
				header ('Location: connexion.php');
				
				}
								
			}
		
		$bdd=NULL;
		mysqli_close($conn);
?>
</html>