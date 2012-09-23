<?php

namespace core;

use Exception;

class Solutioner {

    private $solution;

    private $view;
    
    private $result;
    
    
    public function  __construct($app) {
        $this->app = $app;
    }

    public function attachView($view) {
        $this->view = $view;
    }
    
    public function getSolutionFile() {
        if (!property_exists($this, 'solution_file')) {
	        $this->solution_file = 
				$this->app->getSolutionPath() 	. '/' . 
				$this->app->getSolutionName() 	. '.php';  
		}      								 
        return $this->solution_file;
    }
    
    public function dispatch() {
		$solution_file = $this->getSolutionFile();
		if (!file_exists($solution_file)) {
			throw new Exception("Solution doesn't exists:" . $solution_file);
		}
		
        require_once $solution_file;

        $solution_class = ucfirst(strtolower($this->app->getSolutionName()));
		if (!class_exists($solution_class)) {
			throw new Exception("Class doesn't exists:" . $solution_class);
		}
		
        $solution_obj = new $solution_class;
        $solution_obj->view = $this->view->getRenderer();
        $solution_obj->index();
	
		$this->view->attachTemplate($this->app->getView());
        $this->result = $this->view->render();
    }
    
    public function getResult() {
        return $this->result;
    }
   
}

?>