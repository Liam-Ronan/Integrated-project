<?php
//////////////////////////////////////////////////////
////////////CHANGE THESE SETTINGS ONLY////////////////
define('DATABASE_NAME', 'news_db');
define('STORIES_TABLE_NAME', 'articles');
define('CATEGORIES_TABLE_NAME', 'types');
define('CATEGORIES_FOREIGN_KEY', 'type_id');
define('AUTHORS_TABLE_NAME', 'journalists');
define('AUTHORS_FOREIGN_KEY', 'journalist_id');
//////////////////////////////////////////////////////
/////////////////END SETTINGS/////////////////////////
//////////////////////////////////////////////////////
class Connection
{
    private static $instance = null;


    public static function getInstance()
    {
        $host = "localhost";
        $database = DATABASE_NAME;
        $username = "root";
        $password = "";

        $dsn = "mysql:dbname=" . $database . ";host=" . $host;

        if (self::$instance === null) {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            self::$instance = $pdo;
        }

        return self::$instance;
    }
}

class Post
{
    public static function create($tableName, $data)
    {
       $sql = "INSERT INTO " . $tableName . "(" . implode(", ", array_keys($data)) . ") VALUES ('" . implode("', '", array_values($data)) . "')";
       
       var_dump($sql);
        $conn = Connection::getInstance();
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute();
        // $success = $conn->exec($sql);
        if (!$success) {
            throw new Exception("Failed to save data");
        } else {
            $rowCount = $stmt->rowCount();
            if ($rowCount !== 1) {
                throw new Exception("Error saving data");
            }
            // $this->id = $conn->lastInsertId('Story');
        }
    }
    public static function edit($tableName, $id, $data)
    {
      $sql = "UPDATE " . $tableName . " SET ";
      $count = 0;
      foreach($data as $key => $value) {
        $sql .= $key . ' = \'' . addslashes($value) . ' \'';
        $count++;
        if($count != sizeof($data)) {
          $sql .= ", ";
        }
      }
      $sql .= " WHERE id = " . $id;
      // var_dump($sql);
      
      $conn = Connection::getInstance();
      $stmt = $conn->prepare($sql);
      $success = $stmt->execute();
      
      // $conn = Connection::getInstance();
      // $success = $conn->exec($sql);
      if (!$success) {
          throw new Exception("Failed to save data");
      } else {
          $rowCount = $stmt->rowCount();
          /* if ($rowCount !== 0) {
              throw new Exception("Error saving data");
          } */
      }
    }
}

class Get
{
  
    public static function all($tableName, $limit = 0, $skip = 0)
    {
        return self::allOrderBy($tableName, 0, $limit, $skip);
    }

    public static function allOrderBy($tableName, $orderBy, $limit = 0, $skip = 0)
    {
        $sql = 'SELECT * FROM ' . $tableName;

        if ($orderBy !== 0) {
          $sql .= ' ORDER BY ' . $orderBy;
        }

        if ($limit > 0) {
          $sql .= ' LIMIT ' . $limit;
        }

        if ($skip > 0) {
          $sql .= ' OFFSET ' . $skip;
        }

        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve " . $tableName);
        } else {
            $data = $stmt->fetchAll();
            return $data;
        }
    }

    public static function byId($tableName, $id)
    {
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id = ' . $id;

        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve " . $tableName . " by id: " . $id);
        } else {
            $data = $stmt->fetch();
            return $data;
        }
    }

    public static function byCategory($category, $limit = 0, $skip = 0)
    {
      return self::byCategoryOrderBy($category, 0, $limit, $skip);
    }

    public static function byCategoryOrderBy($category, $orderBy, $limit = 0, $skip = 0)
    {

        $sql = "SELECT id FROM " . CATEGORIES_TABLE_NAME . " WHERE name = '" . $category . "' LIMIT 1";
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve category");
        } else {
            $category_id = $stmt->fetch()->id;
            
            // var_dump($stmt->fetch()->id);

            $sql = 'SELECT * FROM '. STORIES_TABLE_NAME;
            
            $sql .= ' WHERE ' . CATEGORIES_FOREIGN_KEY . ' = ' . $category_id;
            
            if ($orderBy !== 0) {
              $sql .= ' ORDER BY ' . $orderBy;
            }

            if ($limit > 0) {
              $sql .= ' LIMIT ' . $limit;
            }

            if ($skip > 0) {
              $sql .= ' OFFSET ' . $skip;
            }
            
            

            $connection = Connection::getInstance();
            $stmt = $connection->prepare($sql);
            $success = $stmt->execute();
            if (!$success) {
                throw new Exception("Failed to retrieve stories");
            } else {
                $stories = $stmt->fetchAll();
                return $stories;
            }
        }
    }

    ////////////////////////////////////
    ///////////////////////////////////
    ////////////////////////////////
    //////////////////////////////
    /////////////////////////////


    public static function columnById($tableName, $columnName, $id)
    {
        $sql = 'SELECT ' . $columnName . ' FROM ' . $tableName . ' WHERE id = ' . $id;

        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve " . $columnName . " from " . $tableName . " by id: " . $id);
        } else {
            $data = $stmt->fetch();
            return $data;
        }
    }

    public static function column($tableName, $columnName, $limit = 0, $skip = 0)
    {
        return self::columnOrderBy($tableName, $columnName, 0, $limit, $skip);
    }

    public static function columnOrderBy($tableName, $columnName, $orderBy, $limit = 0, $skip = 0)
    {
        $sql = 'SELECT ' . $columnName . ' FROM ' . $tableName;

        if ($orderBy !== 0) {
          $sql .= ' ORDER BY ' . $orderBy;
        }

        if ($limit > 0) {
          $sql .= ' LIMIT ' . $limit;
        }

        if ($skip > 0) {
          $sql .= ' OFFSET ' . $skip;
        }

        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve " . $columnName . " from " . $tableName);
        } else {
            $data = $stmt->fetchAll();
            return $data;
        }
    }



    // public static function byAuthor($author, $limit = 0, $skip = 0)
    // {
    //   return byAuthorOrderBy($author, 0, $limit, $skip)
    // }
    //
    // public static function byAuthorOrderBy($author, $orderBy, $limit = 0, $skip = 0)
    // {
    //
    //     $sql = "SELECT id FROM ". AUTHORS_TABLE_NAME ." WHERE last_name = '" . $author . "' LIMIT 1";
    //     $connection = Connection::getInstance();
    //     $stmt = $connection->prepare($sql);
    //     $success = $stmt->execute();
    //     if (!$success) {
    //         throw new Exception("Failed to retrieve author");
    //     } else {
    //       $author_id = $stmt->fetch()[0];
    //
    //         $sql = 'SELECT * FROM '. STORIES_TABLE_NAME .' WHERE ' . AUTHORS_FOREIGN_KEY . ' = ' . $author_id;
    //
    //         if ($orderBy !== 0) {
    //           $sql .= ' ORDER BY ' . $orderBy;
    //         }
    //
    //         if ($limit > 0) {
    //           $sql .= ' LIMIT ' . $limit;
    //         }
    //
    //         if ($skip > 0) {
    //           $sql .= ' OFFSET ' . $skip;
    //         }
    //
    //         $connection = Connection::getInstance();
    //         $stmt = $connection->prepare($sql);
    //         $success = $stmt->execute();
    //         if (!$success) {
    //             throw new Exception("Failed to retrieve stories");
    //         } else {
    //             $stories = $stmt->fetchAll();
    //             return $stories;
    //         }
    //     }
    // }
}
