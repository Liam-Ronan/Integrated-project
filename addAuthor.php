<?php
  require_once 'classes/DBConnector.php';

  try {
    
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'link' => $_POST['link'],
        'bio' => $_POST['bio']
      ];
      
      Post::create('journalists', $data);

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
    <title>Document</title>
</head>
<body>
    
</body>
</html>