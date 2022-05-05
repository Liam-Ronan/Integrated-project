<?php

require_once 'classes/DBConnector.php';

class ArticleValidator {

    public $data;
    public $errors = [];
    private $id;
    private static $fields = ['headline', 'brief_headline', 'synopsis', 'article', 'published_date'];

    public function __construct($post_data, $id = 0) {
        $this->data = $post_data;
    }

    public function validateForm() {
        foreach(self::$fields as $field) {
            if(!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
        }

        $this->validateHeadline();
        $this->validateBriefHeadline();
        $this->validateSynopsis();
        $this->validateArticle();
        $this->validateDate();

     
/*         echo "<pre>";
        print_r($this->errors);
        echo "</pre>";

        echo "<pre>";
        print_r($this->data);
        echo "</pre>"; */

        if(empty($this->errors)){
            self::save();
            return true;
        }

        return false;
    }

    private function sanitize_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
    
        return $data;
    }

    private function save() {
        try {
            Post::create('articles', $this->data);
            
        } catch (Exception $e) {
            die("Exception: " . $e->getMessage());
        }
    }

    private function validateHeadline() {

        $val = self::sanitize_input($this->data['headline']);

        if(empty($val)) {
            $this->addError('headline', 'headline cannot be empty');
        }
        else {
            if(!preg_match('/^[0-9a-zA-Z-.,"" ]*$/', $val)) {
                $this->addError('headline', 'headline must be letters or numbers');
            }
        }
    }

    private function validateBriefHeadline() {

        $val = self::sanitize_input($this->data['brief_headline']);

        if(empty($val)) {
            $this->addError('brief_headline', 'brief headline cannot be empty');
        }
        else {
            if(!preg_match('/^[0-9a-zA-Z-.,"" ]*$/', $val)) {
                $this->addError('brief_headline', 'brief headline must be letters or numbers');
            }
        }
    }

    private function validateSynopsis() {

        $val = self::sanitize_input($this->data['synopsis']);

        if(empty($val)) {
            $this->addError('synopsis', 'synopsis cannot be empty');
        }
        else {
            if(!preg_match('/^[0-9a-zA-Z-.,"" ]*$/', $val)) {
                $this->addError('synopsis', 'synopsis must be letters or numbers');
            }
        }
    }

    private function validateArticle() {

        $val = self::sanitize_input($this->data['article']);

        if(empty($val)) {
            $this->addError('article', 'article cannot be empty');
        }
        else {
            if(!preg_match('/^[0-9a-zA-Z-.,"" ]*$/', $val)) {
                $this->addError('article', 'article must be letters or numbers');
            }
        }
    }

    private function validateDate() {

        $val = self::sanitize_input($this->data['published_date']);

        if(empty($val)) {
            $this->addError('published_date', 'Date must be set');
        }
        else {
            if(!preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $val)) {
                $this->addError('published_date', 'Date must be valid');
            }
        }
    }

    private function addError($key, $val) {
        $this->errors[$key] =$val;
    }
}


?>