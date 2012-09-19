<?php 

define('ROOT_PATH'  , './../../../');
define('CORE_PATH'  , ROOT_PATH . 'core/');
define('VENDOR_PATH', ROOT_PATH . 'vendor/');
define('CORE_CONFIG', CORE_PATH . 'config/core.yml');
define('TAL_PATH', VENDOR_PATH . 'phptal/');

set_include_path(
    implode(PATH_SEPARATOR,
    array(
        get_include_path(),
        VENDOR_PATH,
        ROOT_PATH,
        TAL_PATH
    ))
);

spl_autoload_register(function ($class) {
    $file = str_replace(array('\\', '_'), '/', $class).'.php';

	if (!include $file) {
		throw new Exception("Can't load:".$file);
	};

});


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load('config/core.yml');


$request = $container->get('core.library.request.request');
echo $request->getOne('alma');
echo $request->getOne('korte');
