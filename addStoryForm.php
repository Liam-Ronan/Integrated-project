<?php
  require_once 'classes/validator.php';
  require_once 'classes/DBConnector.php';


    session_start();
    if(isset($_SESSION["data"]) and isset($_SESSION["errors"])) {
        $data = $_SESSION["data"];
        $errors = $_SESSION["errors"];   
    }
    else {
        $data = [];
        $errors = [];
    }

  try {
      
    $types = Get::all('types');
    $journalists = Get::all('journalists');

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

    <title>Lightspeed News</title>
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
                            <li><a class="link-nav" href="addTypeForm.php">Create A Category</a></li>                         
                            <li><a class="link-nav" href="logIn.php">Log In</a></li>
                            <li><a class="link-nav" href="#"><i class="fas fa-search"></i></a></li>
                            <li><a class="link-nav" href="#"><i class="fa fa-bars"></i></a></li>         
                           
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

<div class="container flex" id="myForm">
        <div class="formStyle">
            <form class="form" method="POST" action="addStory.php">
            <h1>Create A Story</h1>
                <div class="styleForm">
                    <div>
                        <label>Headline</label><br>
                        <textarea id="headline" name="headline" value="<?php echo isset($_POST['headline']) ? $_POST['headline'] : '' ?>" cols="40" rows="3"></textarea>
                        <div id="headline_error" class="error"><?php if (isset($errors["headline"])) echo $errors["headline"]; ?></div>
                    </div>

                    <div>
                        <label>Brief Headline</label><br>
                        <textarea id="brief_headline" name="brief_headline" value="<?php if (isset($data["brief_headline"])) echo $data["brief_headline"]; ?>" cols="40" rows="3"></textarea>
                        <div id="brief_headline_error" class="error"><?php if (isset($errors["brief_headline"])) echo $errors["brief_headline"]; ?></div>
                    </div>

                    <div>
                        <label>Synopsis</label><br>
                        <textarea id="synopsis" name="synopsis" value="<?php if (isset($data["synopsis"])) echo $data["synopsis"]; ?>" cols="40" rows="10"></textarea>
                        <div id="synopsis_error" class="error"><?php if (isset($errors["synopsis"])) echo $errors["synopsis"]; ?></div>
                    </div>
                    
                    <div>
                        <label>Article</label><br>
                        <textarea id="article" name="article" value="<?php if (isset($data["article"])) echo $data["article"]; ?>" cols="40" rows="10"></textarea>
                        <div id="article_error" class="error"><?php if (isset($errors["article"])) echo $errors["article"]; ?></div>
                    </div>
                
                    <div>
                        <label>Published Date</label><br>
                        <input id="published_date" type="date" name="published_date" value="<?php if (isset($data["published_date"])) echo $data["published_date"]; ?>"/>
                        <div id="published_date_error" class="error"><?php if (isset($errors["published_date"])) echo $errors["published_date"]; ?></div>
                    </div>
                    
                    <div>
                        <label>Journalist</label><br>
                        <select id="journalist_id" name="journalist_id">
                        <?php
                            foreach($journalists as $journalist) {
                        ?>
                            <option value="<?= $journalist->id ?>"><?= $journalist->first_name ?> <?= $journalist->last_name ?></option>
                        <?php
                            }
                        ?>
                        </select>
                        <div id="journalist_error" class="error"></div>
                    </div>
        
                    <div>
                        <label>Category</label><br>
                        <select id="type_id" name="type_id">
                        <?php
                            foreach($types as $type) {
                        ?>
                            <option value="<?= $type->id ?>"><?= $type->name ?></option>
                        <?php
                            }
                        ?>
                        </select>
                        <div id="type_error" class="error"></div>
                    </div>
                </div>
                <div class="formBtns flex gap">
                    <a class="typeBtn" href="index.php">Cancel</a>
                    <input id="submit_Btn" class="typeBtn" name="submit" value="submit" type="submit">
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
    <script src="js/articleValidate.js"></script>
</body>
</html>
<?php 
if(isset($_SESSION["data"]) and isset($_SESSION["errors"])) {
    unset($_SESSION["data"]);
    unset($_SESSION["errors"]);
}
?>