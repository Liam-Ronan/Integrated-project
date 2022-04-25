<?php
  require_once 'classes/DBConnector.php';

  //Change Date Format
  function changeDate($string) {
    $formatDate = strtotime($string);
    return date('jS F Y', $formatDate);
}

  try {
      
    //Small Side Stories
    $smallTechStories = Get::byCategoryOrderBy('tech', 'published_date DESC', 3);
    $smallCultureStories = Get::byCategoryOrderBy('culture', 'published_date DESC', 3);

    //All Articles
    $allTypes= Get::all('articles', 7, 3);

    //Main Story
    $mainStories = Get::all('articles', 1, 5);

    //Medium Stories
    $medStories = Get::allOrderBy('articles', 'published_date DESC', 6, 6);

    //Bottom Stories
    $bottomScienceStories = Get::byCategoryOrderBy('science', 'published_date ASC', 4);
    $bottomHealthStories = Get::byCategoryOrderBy('health', 'published_date ASC', 4);
    $bottomPoliticsStories = Get::byCategoryOrderBy('politics', 'published_date ASC', 4);
    $bottomBusinessStories = Get::byCategoryOrderBy('business', 'published_date ASC', 4);

    //Bottom Stories Categories
    $bottomScienceCategory = Get::byID('types', 5);
    $bottomHealthCategory = Get::byID('types', 7);
    $bottomPoliticsCategory = Get::byID('types', 6);
    $bottomBusinessCategory = Get::byID('types', 2);

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

    <div class="container">
        <!-- Main Article Start -->
        <div class="leftSide width-8">
            <?php
                foreach($mainStories as $mainStory) {

                    $type = Get::byId('types', $mainStory->type_id);
                    $journalist = Get::byId('journalists', $mainStory->journalist_id);
            ?>

            <div class="topStory width-8 nested">
                <div class="tag">
                    <p><a href="typeView.php?id=<?= $type->id ?>"><?= $type->name ?></a></p>
                </div>

                <div class="width-12">
                    <hr>
                </div>

                <div class="width-6">
                    <h1><a href="article.php?id=<?= $mainStory->id ?>"><?= $mainStory->headline?></a></h1>
                    <h5><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name ?> <?=$journalist->last_name?></a> - </span>
                    <?=changeDate($mainStory->published_date) ?></h5>
                </div>

                <div class="width-6">
                    <p><?= $mainStory->synopsis ?></p>

                    <p><?= $mainStory->synopsis ?></p>
                </div>

                <div class="width-12">
                    <hr>
                </div>
            </div>

            <?php
                }
            ?>
            <!-- Main Article End -->


            <!-- Medium Article Start -->
            <?php
                foreach($medStories as $medStory) {

                    $type = Get::byId('types', $medStory->type_id);
                    $journalist = Get::byId('journalists', $medStory->journalist_id);
            ?>

            <div class="width-8">
                <div class="tag">
                    <p><a href="typeView.php?id=<?= $type->id ?>"><?= $type->name ?></a></p>
                </div>

                <div class="hr">
                    <hr>
                </div>

                <div class="medAuthor">
                    <h5><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name?> <?=$journalist->last_name?></a></span> 
                    - </span><?= changeDate($medStory->published_date) ?></h5>
                </div>

                <div class="headline">
                    <h2><a href="article.php?id=<?= $medStory->id ?>"><?= $medStory->headline?></a></h2>
                </div>
            </div>
            
            <?php
                }
            ?>
        </div>
        <!-- Medium Article End -->

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
                    <p><a href="typeView.php?id=<?= $type->id ?>"><?= $type->name ?></a></p>
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
                    <p><?= $smallCultureStory->synopsis ?></p>
                </div>
            </div>

            <?php } ?> 
        </div>
        <!-- Small Articles End -->

        <!-- Start Bottom Stories - FIRST Section -->
        <div class="bottomStories width-12 nested">
            <div class="width-12">
                    <div class="tag">
                    <p><a href="typeView.php?id=<?= $bottomScienceCategory->id ?>"><?= $bottomScienceCategory->name ?></a></p>
                    </div>

                    <div class="hr">
                        <hr>
                    </div>
            </div>

            <?php

                foreach ($bottomScienceStories as $bottomScienceStory) {
                    $type = Get::byId('types', $bottomScienceStory->type_id);
                    $journalist = Get::byId('journalists', $bottomScienceStory->journalist_id);
            ?>
            
                <div class="smallStory width-3">

                    <div class="author">
                        <h6><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name ?> <?=$journalist->last_name?></a>
                        - </span><?= changeDate($bottomScienceStory->published_date) ?></h6>
                    </div>

                    <div class="heading">
                        <h2><a href="article.php?id=<?= $bottomScienceStory->id ?>"><?= $bottomScienceStory->brief_headline ?></a></h2>
                    </div>

                    <div class="summary">
                        <p><?= $bottomScienceStory->synopsis ?></p>
                    </div>  
                </div>              
            <?php
                }
            ?>
        </div>  
        <!-- End Bottom Stories - FIRST Section -->

        <!-- Start Bottom Stories - SECOND Section -->
        <div class="bottomStories width-12 nested">
            <div class="width-12">
                    <div class="tag">
                        <p><a href="typeView.php?id=<?= $bottomHealthCategory->id ?>"><?= $bottomHealthCategory->name ?></a></p>
                    </div>

                    <div class="hr">
                        <hr>
                    </div>
            </div>

            <?php
                foreach ($bottomHealthStories as $bottomHealthStory) {
                    $type = Get::byId('types', $bottomHealthStory->type_id);
                    $journalist = Get::byId('journalists', $bottomHealthStory->journalist_id);
            ?>
            
                <div class="smallStory width-3">

                    <div class="author">
                        <h6><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name ?> <?=$journalist->last_name?></a>
                        - </span><?= changeDate($bottomHealthStory->published_date) ?></h6>
                    </div>

                    <div class="heading">
                        <h2><a href="article.php?id=<?= $bottomHealthStory->id ?>"><?= $bottomHealthStory->brief_headline ?></a></h2>
                    </div>

                    <div class="summary">
                        <p><?= $bottomHealthStory->synopsis ?></p>
                    </div>  
                </div>             
            <?php
                }
            ?>
        </div>
        <!-- End Bottom Stories - SECOND Section -->
  
        <!-- Start Bottom Stories - THIRD Section -->
        <div class="bottomStories width-12 nested">
            <div class="width-12">
                    <div class="tag">
                        <p><a href="typeView.php?id=<?= $bottomPoliticsCategory->id ?>"><?= $bottomPoliticsCategory->name ?></a></p>
                    </div>

                    <div class="hr">
                        <hr>
                    </div>
            </div>

            <?php
                foreach ($bottomPoliticsStories as $bottomPoliticsStory) {
                    $type = Get::byId('types', $bottomPoliticsStory->type_id);
                    $journalist = Get::byId('journalists', $bottomPoliticsStory->journalist_id);
            ?>
            
                <div class="smallStory width-3">

                    <div class="author">
                        <h6><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name ?> <?=$journalist->last_name?></a>
                        - </span><?= changeDate($bottomPoliticsStory->published_date) ?></h6>
                    </div>

                    <div class="heading">
                        <h2><a href="article.php?id=<?= $bottomPoliticsStory->id ?>"><?= $bottomPoliticsStory->brief_headline ?></a></h2>
                    </div>

                    <div class="summary">
                        <p><?= $bottomPoliticsStory->synopsis ?></p>
                    </div>  
                </div>             
            <?php
                }
            ?>
        </div>
        <!-- End Bottom Stories - THIRD Section -->

        <!-- Start Bottom Stories - FOURTH Section -->
        <div class="bottomStories width-12 nested">
            <div class="width-12">
                    <div class="tag">
                        <p><a href="typeView.php?id=<?= $bottomBusinessCategory->id ?>"><?= $bottomBusinessCategory->name ?></a></p>
                    </div>

                    <div class="hr">
                        <hr>
                    </div>
            </div>

            <?php
                foreach ($bottomBusinessStories as $bottomBusinessStory) {
                    $type = Get::byId('types', $bottomBusinessStory->type_id);
                    $journalist = Get::byId('journalists', $bottomBusinessStory->journalist_id);
            ?>
            
                <div class="smallStory width-3">

                    <div class="author">
                        <h6><span><a href="authorView.php?id=<?= $journalist->id ?>"><?= $journalist->first_name ?> <?=$journalist->last_name?></a>
                        - </span><?= changeDate($bottomBusinessStory->published_date) ?></h6>
                    </div>

                    <div class="heading">
                        <h2><a href="article.php?id=<?= $bottomBusinessStory->id ?>"><?= $bottomBusinessStory->brief_headline ?></a></h2>
                    </div>

                    <div class="summary">
                        <p><?= $bottomBusinessStory->synopsis ?></p>
                    </div>  
                </div>             
            <?php
                }
            ?>
        </div>
        <!-- End Bottom Stories - FOURTH Section -->

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