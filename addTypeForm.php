<?php
  require_once 'classes/DBConnector.php';

  try {
      
    //All Articles
    $allTypes= Get::all('articles', 7, 3);


  } catch (Exception $e) {
    die("Exception: " . $e->getMessage());
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/8b98889217.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Liam's News site</title>
</head>
<body>
<header>
        <div class="containerTwo hr">
            <hr>
        </div>
            <div class="center containerTwo">
                    <h1 class="containerTwo flex"><a href ="index.php">Lightspeed News</a></h1>
                    <h3 class="h3 containerTwo flex">Bringing you news at the speed of light</h3>
                    <nav>
                        <ul class="links containerTwo flex gap">
                            
                            <li><a class="link-nav" href="addAuthorForm.php">Sign Up</a></li>                         
                            <li><a class="link-nav" href="addStoryForm.php">Create A Story</a></li>                        
                            <li><a class="link-nav" href="updateStoryForm.php">Update A Story</a></li>                          
                            <li><a class="link-nav" href="addTypeForm.php">Create A Category</a></li>                         
                            <li><a class="link-nav" href="logIn.php">Log In</a></li>         
                           
                        </ul>
                    </nav>
            </div>
            <div class="containerTwo">
                <hr>
            </div>
                <ul class="types containerTwo flex f-between">

                    <?php
                        foreach($allTypes as $alltype) {
                            $type = Get::byId('types', $alltype->type_id);
                    ?>

                    <hr>
                    <li><a class="typeBtn" href="article.php?id=<?= $alltype->id ?>"><?= $type->name?></a></li>

                    <?php
                        }
                    ?>
                    <hr>
                </ul>
            <div class="containerTwo">
                <hr>
            </div>
</header>     

<div class="container flex">
        <div class="formStyle">
            <form class="form" method="POST" action="addType.php">
                <h1>Add a new Category</h1>
                <div>
                    <label>Category Name</label><br>
                    <input id="type" type="text" name="name"/>
                    <div id="type_error" class="error"></div>
                </div>
                <div>
                    <label>Category Description</label><br>
                    <textarea id="description" name="description" cols="70" rows="10"></textarea>
                    <div id="description_error" class="error"></div>
                </div>
                <div class="formBtns flex gap">
                    <a class="typeBtn" href="index.php">Cancel</a>
                    <input id="submit_Btn" class="typeBtn" type="submit">
                </div>
            </form>
        </div>
</div>
<footer>
<div class="containerTwo">
    <hr>
</div>
    <div class="container flex">
  	 	<div class="row flex f-between gapTwo">
  	 		<div class="footer-col">
  	 			<h4>Lightspeed News</h4>
  	 			<ul>
  	 				<li><a class="link-nav" href="#">about us</a></li>
  	 				<li><a class="link-nav" href="#">our services</a></li>
  	 				<li><a class="link-nav" href="#">privacy policy</a></li>
  	 				<li><a class="link-nav" href="#">affiliate program</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>Contact Us</h4>
                <p>Please Contact us via Number or visit our <strong><a href="#">support page.</a></strong></p>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>follow us</h4>
  	 			<div class="social-links">
  	 				<a href="#"><i class="fab fa-facebook-f"></i></a>
  	 				<a href="#"><i class="fab fa-twitter"></i></a>
  	 				<a href="#"><i class="fab fa-instagram"></i></a>
  	 				<a href="#"><i class="fab fa-linkedin-in"></i></a>
  	 			</div>
  	 		</div>
  	 	</div>
  	 </div>
       <div class="containerTwo hr">
            <hr>
        </div>
    </footer>
    <script src="js/typeValidate.js"></script>
</body>
</html>