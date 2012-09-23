<?php

namespace core\library\request;

use core\library\Core;
use Exception;

class Request extends Core {
    
    const REQUEST_URI   = 'REQUEST_URI';
    const PATH_INFO     = 'PATH_INFO';
    const QUERY_STRING  = 'QUERY_STRING';

    
    public function __construct(
		 \core\Globals $globals, 
		 \core\library\request\requestAtomFactory $raf) {

		$this->globals 				= $globals;
		$this->request_atom_factory	= $raf;    
	}
    
	private function loadGet() {
		$this->loadQueryParams();
		$this->get = $this->request_atom_factory->get($this->query_parts);
	}
	
	
	private function loadPost() {	
		$this->post = $this->request_atom_factory->get($this->globals->post);
	}

	/**
	 *   Build post or get values on first call. 
	 */
	public function __call($cmd, $args) {
		try {
			return parent::__call($cmd, $args);
		} catch (Exception $e) {
			$full_command = 'load' . ucfirst($this->lastCommand());
			if (!method_exists($this, $full_command)) {
				throw new Exception('Inexistent call:'.$cmd);
			}
			call_user_func_array(array($this, $full_command), $args );	
			return parent::__call($cmd, $args);			
		}	
	}
	
  
    /**
     * Parse the QUERY_STRING from the SERVER global
     */
    private function loadQueryParams() {
		$this->query_parts = array();
		$query_string = $this->globals->getServerData(self::QUERY_STRING);
        $query_part_pairs = explode('&',  $query_string);
        
        if (!count($query_part_pairs)) {
            return;
        }

        foreach ($query_part_pairs as $qpp) {
            $qp_item = explode('=', $qpp);
            if (count($qp_item) !== 2) {
                continue;
            }
            $this->query_parts[$qp_item[0]] = $qp_item[1];
        }
    }
    

    /**
     * load and explode the URI parts
     */
    private function loadUriPathParts() {
        $this->uri_path_parts = array();
        $uri_path_parts = 
            explode('/', $this->globals->getServerData(self::PATH_INFO));
        foreach ($uri_path_parts as $upp) {
            if ($upp) {
                $this->uri_path_parts[] = $upp;
            }
        }
    }

	public function checkAndLoadUriPathParts() {
        if (!property_exists($this, 'uri_path_parts')) {
            $this->loadUriPathParts();
        }		
	}
    
    /**
     * returns the first part of current URI
     */
    public function getFirstUriPart() {

#if already created just return the value
		
        if (property_exists($this, 'first_uri_part')) {
            return $this->first_uri_part;
        }

# check if uri path part is loaded

		$this->checkAndLoadUriPathParts();

# check if uri path parts is an array and has at least one value

        if (is_array($this->uri_path_parts) && 
			isset($this->uri_path_parts[0])) {
            $this->first_uri_part = $this->uri_path_parts[0];
        } else {
            $this->first_uri_part = '';
        }

        return $this->first_uri_part;
    }
    

	/**
	 *  Parse the PATH_INFO from the SERVER global
	 *  Created an array $uri_path_parts that will contain separated
	 *  path information
	 */
    private function loadUriPathPairs() {
        $this->uri_param_pairs = array();

		$this->checkAndLoadUriPathParts();	    
      
        $uri_path_parts_count = count($this->uri_path_parts);
        $uri_path_pair_num = intval($uri_path_parts_count / 2);
        
        for ($i = 0; $i < $uri_path_pair_num; $i += 2) {
            $this->uri_path_pairs[$uri_path_parts[$i]] = $uri_path_parts[$i + 1];
        }
        
    }

}

?>