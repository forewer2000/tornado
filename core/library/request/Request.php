<?php

namespace core\library\request;

use core\library\Core;

class Request extends Core {
    
    const REQUEST_URI = 'REQUEST_URI';
    
    const PATH_INFO = 'PATH_INFO';
    
    const QUERY_STRING = 'QUERY_STRING';

    
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
		} catch (\Exception $e) {
			$full_command = 'load' . ucfirst($this->lastCommand());
			if (!method_exists($this, $full_command)) {
				throw new \Exception('Inexistent call:'.$cmd);
			}
			call_user_func_array(array($this, $full_command), $args );	
			return parent::__call($cmd, $args);			
		}	
	}
	
  
    /**
     * Parse the QUERY_STRING from the SERVER global
     */
    private function loadQueryParams() {
		$server = $this->globals->server();
        $this->query_parts = array();
        if (!array_key_exists(self::QUERY_STRING, $server)) {
            return;
        }

        $queryPartPairs = explode('&',  $server[self::QUERY_STRING]);
        
        if (!count($queryPartPairs)) {
            return;
        }
        foreach ($queryPartPairs as $qpp) {
            $qpItem = explode('=', $qpp);
            if (count($qpItem) !== 2) {
                continue;
            }
            $this->query_parts[$qpItem[0]] = $qpItem[1];
        }
    }
    
	/**
	 * Parse the PATH_INFO from the SERVER global
	 */
    private function loadPathParams() {
        $this->pathParts = array();
		$server = $this->globals->server();
        if (!array_key_exists(self::PATH_INFO, $server)) {
            return;
        }
        $pathParts = explode('/',  $server[self::PATH_INFO]);
        if (count($pathParts)) {
            foreach ($pathParts as $p) {
                if (trim($p)) {
                    $this->pathParts[] = $p;
                }
            }
        }
    }

}

?>