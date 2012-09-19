<?php
namespace core\library\request;

use core\library\Core;

class requestAtomFactory {
	public function get($data) {
		return new requestAtom($data);
	}
}

?>