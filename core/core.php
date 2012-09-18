<?php
    namespace core;
    
    require_once "yaml/Parser.php";
    require_once "yaml/Inline.php";
    require_once "configurator.php";
    require_once "application.php";
    require_once "solutioner.php";
    require_once "library/client/client.php";
    require_once "library/session/session.php";
    require_once "library/request/request.php";
    require_once "library/browser/browser.php";

    use Symfony\Component\Yaml\Parser;
    use Symfony\Component\Yaml\Inline;
    use core\library\client\Client;
    use core\library\session\Session;
    use core\library\request\Request;
    use core\library\browser\Browser;
    
    class Core {
        
        private static $config;
        
        public static $client;
        
        public static $app;
        
        static function init($core_config) {
            $yaml = new Parser();
            self::$config = new Configurator($core_config);
            self::$config->addParser($yaml);
            $clientConfig = self::$config->find('client');
            
            self::$client = new Client($clientConfig);
            
            $session = new Session();
            self::$client->attachSession($session);
            
            $request = new Request($_SERVER, $_POST, $_FILES);
            $request->load();
            
            $browser = new Browser($_SERVER);
            $browser->attachRequest($request);
            
            self::$client->attachBrowser($browser);
            
            self::$app = new Application(getcwd());
            $app_configurator = new Configurator(self::$app->configPath());
            $app_configurator->addParser($yaml);
            $paths = self::$client->browserRequestPaths();
            $app_configurator->addValue('solution', array_shift($paths));
            self::$app->attachConfigurator($app_configurator);
            echo self::$app->solutionPath();
            
            
            $solutioner = new Solutioner(self::$app->solution(), self::$app->solutionPath());
            $solutioner_configurator = new Configurator($solutioner->configFile());
            $solutioner_configurator->addParser($yaml);
            $solutioner->attachConfigurator($solutioner_configurator);
            $solutioner->load();
        }
        
        static function run() {
        }
    }

?>