<?php
  require_once 'classes/DBConnector.php';

    function changeDate($string) {
        $formatDate = strtotime($string);
        return date('jS F Y', $formatDate);
    }


    try {
        
        $allTypes= Get::all('articles', 7, 3);

        $story = get::byId('articles', $_GET['id']);
        $category = Get::byId('types', $story->type_id);
        $journalist = Get::byId('journalists', $story->journalist_id);

        $smallTechStories = Get::byCategoryOrderBy('health', 'published_date DESC', 3);
        $smallCultureStories = Get::byCategoryOrderBy('business', 'published_date DESC', 3);
        
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

    <title>Liam's News Site</title>
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
                    <li><a class="typeBtn"href="article.php?id=<?= $alltype->id ?>"><?= $type->name?></a></li>

                    <?php
                        }
                    ?>
                    <hr>
                </ul>
            <div class="containerTwo">
                <hr>
            </div>
</header>

<div class="container">
        <!-- Main Article Start -->
        <div class="leftSide width-8">
            <div class="topStory width-8">
                <div class="tag">
                <p><a href="typeView.php?id=<?= $category->id ?>"><?= $category->name ?></a></p>
                </div>

                <div class="width-12">
                    <hr>
                </div>

                <div class="width-8">
                    <h1><?= $story->headline?></h1>
                    <h5><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name ?> <?=$journalist->last_name?></a>
                     - </span><?= changeDate($story->published_date) ?></h5>
                </div>

                <div class="width-6">
                    <p><?= nl2br($story->article) ?></p>
                </div>

                <div class="width-12">
                    <hr>
                </div>

                <div class="links flex width-6">
                <a class="typeBtn" href="addStoryForm.php">Create A Story</a>
                <a class="typeBtn" href="updateStoryForm.php?id=<?= $story->id ?>">Update This Story</a>
                </div>
            </div>
        </div>

                <!-- Small Articles -->
                <div class="rightSide width-2">
            <?php

                foreach($smallTechStories as $smallTechStory){

                    $type = Get::byId('types', $smallTechStory->type_id);
                    $journalist = Get::byId('journalists', $smallTechStory->journalist_id);

            ?>

            <div class="smallStory">
                <div class="tag">
                <p><a href="typeView.php?id=<?= $type->id ?>"><?= $type->name ?></a></p>
                </div>

                <div class="hr">
                    <hr>
                </div>

                <div class="author">
                    <h6><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name?> <?=$journalist->last_name?></a>
                     - </span><?= changeDate($smallTechStory->published_date) ?></h6>
                </div>

                <div class="heading">
                    <h2><a href="article.php?id=<?= $smallTechStory->id ?>"><?= $smallTechStory->brief_headline ?></a></h2>
                </div>

                <div class="summary">
                    <p><?= $smallTechStory->synopsis ?>
                    </p>
                </div>
            </div>

            <?php } ?>
        </div>

        <div class="rightSide width-2">
            <?php

                foreach($smallCultureStories as $smallCultureStory){

                    $type = Get::byId('types', $smallCultureStory->type_id);
                    $journalist = Get::byId('journalists', $smallCultureStory->journalist_id);

            ?>

            <div class="smallStory">
                <div class="tag">
                    <p><?= $type->name ?></p>
                </div>

                <div class="hr">
                    <hr>
                </div>

                <div class="author">
                    <h6><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name ?> <?=$journalist->last_name?></a>
                     - </span><?= changeDate($smallCultureStory->published_date) ?></h6>
                </div>

                <div class="heading">
                    <h2><a href="article.php?id=<?= $smallCultureStory->id ?>"><?= $smallCultureStory->brief_headline ?></a></h2>
                </div>

                <div class="summary">
                    <p><?= $smallCultureStory->synopsis ?>
                    </p>
                </div>
            </div>

            <?php } ?>
        </div>
</div>
<footer>
    <div class="containerTwo">
                <hr>
            </div>
                <ul class="types containerTwo flex f-between">

                    <?php
                        foreach($allTypes as $alltype) {
                            $type = Get::byId('types', $alltype->type_id);
                    ?>

                    <hr>
                    <li><a class="typeBtn"href="article.php?id=<?= $alltype->id ?>"><?= $type->name?></a></li>

                    <?php
                        }
                    ?>
                    <hr>
                </ul>
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
</body>
</html>