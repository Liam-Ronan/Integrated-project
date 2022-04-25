  <?php
  require_once 'classes/DBConnector.php';

      try {
        
        $data = [
            'headline' => $_POST['headline'],
            'brief_headline' => $_POST['brief_headline'],
            'synopsis' => $_POST['synopsis'],
            'article' => $_POST['article'],
            'published_date' => $_POST['published_date'],
            'journalist_id' => $_POST['journalist_id'],
            'type_id' => $_POST['type_id']
          ];
          
          Post::create('articles', $data);

          header("Location: index.php");
        
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
    <title>Lightspeed News</title>
</head>
<body>
    
</body>
</html>