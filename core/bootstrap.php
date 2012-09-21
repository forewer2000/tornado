<?php 

define('ROOT_PATH'  , './../../../');
define('CORE_PATH'  , ROOT_PATH . 'core/');
define('VENDOR_PATH', ROOT_PATH . 'vendor/');
define('CORE_CONFIG', CORE_PATH . 'config/core.yml');
define('TAL_PATH', VENDOR_PATH . 'phptal/');
define('APP_PATH', getcwd() . '/../');

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

$core_container = new ContainerBuilder();
$core_loader = new YamlFileLoader($core_container, new FileLocator(__DIR__));
$core_loader->load('config/core.yml');

$site_container = new ContainerBuilder();
$site_loader = new YamlFileLoader($site_container, new FileLocator(__DIR__));
$site_loader->load(APP_PATH . 'config/site.yml');

$solutioner = $core_container->get('core.solutioner');
$solutioner->dispatch();
echo $solutioner->getResult();