<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BCF - Client</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Courgette&family=Pacifico&display=swap" rel="stylesheet">
</head>
<header>
    <div class="header-bar">
        <a href="index.html"><img class="logo" src="../static/images/BCF_transparent.png" ></a>
    </div>
</header>

<?php
		 $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = '';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
		 $conn ->select_db('bcf');
		
		
?>
<body class="container">
	<div class="felicitation">
		<p>Vous êtes bien connecté sur le compte <?php $_SESSION['email'] ?> </p>
	</div>
  
   <div>
		<form method="post" enctype="multipart/form-data" class="depot">
			<div class="annonce">
				<label for="file">Sélectionner le fichier contenant la mamographie que vous aimeriez faire vérifier</label>
				<input type="file" id="file" name="file" multiple>
			</div>
			<div class="but">
				<button class='verif' name="verif">Faire vérifier </button>
			</div>
		</form>
  </div>
</body>


<footer class="spe">
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
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		

		// Check if image file is a actual image or fake image
		if(isset($_POST["verif"])) {
		
			$check = getimagesize($_FILES["file"]["tmp_name"]);
			if($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				//echo "File is not an image.";
				$uploadOk = 0;
			}
			
			//$moui = shell_exec('C:\wamp64\www\temp-master\templates\test.py');
			//print($moui);
			
			header("Content-type: image/png");
			$stuff = exec('python test.py', $output);
			foreach($output as $key=>$value){
				if($key==1)
					print chr(0x0D); //Newline feed after PNG declaration
				if($key>0)
					print "\n";
				print $value;
			}

			
			
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				//echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
			} else {
				//echo "Sorry, there was an error uploading your file.";
			}
		}
		
		
	?>
</html>