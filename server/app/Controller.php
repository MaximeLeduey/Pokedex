<?php

abstract class Controller {


    public function loadModel(string $model) {
        require_once __DIR__.'/../models/'.$model.'.php';
        $this->$model = new $model();
    }

    public function render(string $file, array $data = []) {
        extract($data);
        require_once ROOT.'front/'.strtolower($file).'.html';
    }


}