<?php

namespace core;

interface ViewInterface {

    public function attachTemplate($template_file_name);
    public function render();
    
    
}

?>