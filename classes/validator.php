<?php

class ArticleValidator {

    private $data;
    private $errors = [];
    private static $fields = ['headline', 'brief_headline', 'synopsis', 'article', 'published_date'];

    public function __construct($post_data) {
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
        return $this->errors;
    }

    private function validateHeadline() {

        $val = trim($this->data['headline']);

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

        $val = trim($this->data['brief_headline']);

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

        $val = trim($this->data['synopsis']);

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

        $val = trim($this->data['article']);

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

        $val = trim($this->data['article']);

        if(empty($val)) {
            $this->addError('article', 'article cannot be empty');
        }
        else {
            if(!preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $val)) {
                $this->addError('article', 'date must be valid');
            }
        }
    }

    private function addError($key, $val) {
        $this->errors[$key] =$val;
    }
}


?>