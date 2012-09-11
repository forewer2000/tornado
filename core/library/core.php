<?php
namespace core\library;
require_once "exception/nonexistentCommandException.php";
require_once "exception/invalidCommandException.php";
require_once "exception/nonexistentSubcommandException.php";
require_once "exception/invalidSubcommandException.php";
require_once "exception/privateCommandException.php";

use core\library\exception\nonexistentCommandException;
use core\library\exception\invalidCommandException;
use core\library\exception\nonexistentSubcommandException;
use core\library\exception\invalidSubcommandException;
use core\library\exception\privateCommandException;

abstract class Core {

    /**
     * Make it possible to recursively call methods between object chains.
     * $cmd (string): A camel cased command with lowercase first letter. 
     */
    public function __call($cmd, $args) {

# get the first lowercase part of the command

        preg_match('/^([a-z]+[0-9]*)(.|$)/', $cmd, $res);
 
        if (!$res || !$res[1]) {
            throw new invalidCommandException();
        } 
        $mainCmd    = $res[1];
        $subCmd     = substr($cmd, strlen($mainCmd));


# main command could be a method or and object set as a property
        
        if (!$subCmd) {
            if (method_exists($this, $mainCmd)) {
                $reflection = new \ReflectionMethod($this, $mainCmd);
                if ($reflection->isPrivate()) {
                    throw new privateCommandException();
                }
                return call_user_func_array(array($this, $mainCmd), $args );
            } else {
                throw new nonexistentCommandException();
            }
        }
        
        if (!property_exists($this, $mainCmd) || !is_object($this->{$mainCmd})) {
            throw new nonexistentCommandException();
        }

# try to call the subcommand 

        $subCmd = lcfirst($subCmd);
        try {
            return call_user_func_array(array($this->$mainCmd, $subCmd), $args);
        } catch (invalidCommandException $e) {
            throw new invalidSubcommandException();
        } catch (nonexistentCommandException $e) {
            throw new nonexistentSubcommandException();
        }
    }

}

?>