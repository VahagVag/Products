<?php

class UserValidator{
    private $data;
    private $errors = [];
    private $fields = ['username','password','image'];
    public function __construct($post_data){
        $this->data = $post_data;
    }

    public function validateForm(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field,$this->data)){
                trigger_error("field error");
                return;
            }
        }
        $this->validateUsername();
        return $this->errors;
    }
    private function validateUsername(){

        $val = trim($this->data['username']);
        if (empty($val)){
            $this->addError('username','username exist');
        }  else{
            if(filter_var($val,FILTER_VALIDATE_EMAIL)){
                $this->addError('username','Username must be valid emil ');
            }

        }
    }
    private function addError($key,$val){
        $this->errors[$key] = $val;
    }





}
?>;