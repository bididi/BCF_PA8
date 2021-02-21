<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BCF - Connexion</title>
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
        <h1>Connexion</h1>
        <div class="form">
            <form method="post" class="ins">

                <label for="email">Enter your email : </label>
                <input name="email" type="email" required>

                <label for="password">Enter your password : </label>
                <input name="password" type="password" required>

                <button class='espace' name="espace">submit </button>
            </form>
            <p>Vous n'avez pas encore de compte ? <a href="inscription.php">s'inscrire</a></p>
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
            <p> <a href="https://www.facebook.com/BreastCancerFinder/?notif_id=1605289323338281&notif_t=page_fan&ref=notif" target="_blank" rel="nofollow">Instagram</a></p>
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
			
			$hashed = hash('sha512', $_POST['password']);
			
			$query = $conn->prepare("SELECT * FROM connexion WHERE EMAIL = ? AND MDP = ?");
			if ($query === false) {
					printf("Message d'erreur :");
					die();
				}
			$query->bind_param('ss', $email, $hashed);
			$query->execute();
			$result = $query->get_result();
			$compt=0;

			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$compt ++;
				$_SESSION['email'] = $row["EMAIL"];
				
			}
			
			if ($compt >0){
			

						header ('Location: client.php');
						
						
				
					
				
				
				
			}else{
				//echo"error t null";
			}
		}
		
		$bdd=NULL;
		mysqli_close($conn);
?>
</html>
