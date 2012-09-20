<?php
    namespace core;

    require_once "yaml/Parser.php";
    require_once "yaml/Inline.php";

    use Symfony\Component\Yaml\Parser;
    use Symfony\Component\Yaml\Inline;
    use core\library\client\Client;
    use core\library\session\Session;
    use core\library\request\Request;
    use core\library\browser\Browser;
        

    class Core extends Provider {
        
        private static $config;
        
        public static $client;
        
        public static $app;
        
        static function init($core_config) {
            
            /*self::setModules(
                array(
                    'yaml'=>
                        '{
                            namespace:"\\", 
                            deps:["yaml/Parser", "yaml/Inline"],
                            class: "Parser"
                         }'
                );
            */
            
            self::addClass("yaml", new Parser());
            
# Core load

            self::$config = new Configurator($core_config, 'yaml');
 
            
            //self::config = $this->provider->factory('configurator');

# Client Load

            $client_config = self::$config->find('clientconfig');            
            self::$client = new Client($client_config);
            
# Session load

            $session = new Session();

# Request Load
            
            $request = new Request($_SERVER, $_POST, $_FILES);
            $request->load();
            
# Browser load
            
            $browser = new Browser($_SERVER);
            $browser->attachRequest($request);
            
# Attach everything to client
            
            self::$client->attachSession($session);            
            self::$client->attachBrowser($browser);

# Application load
            
            self::$app = new Application(getcwd());
            $app_configurator = new Configurator(self::$app->configPath(), 'yaml');
            $uri_path = self::$client->browserRequestPaths();
            $app_configurator->addValue('solution', array_shift($uri_path));
            self::$app->attachConfigurator($app_configurator);
            
# Load Tal

            $tal_dir = self::$config->find('vendor/phptaldir');
            $tal = new TalLoader($tal_dir);
            
# Solutioner load

            $solutioner = new Solutioner(self::$app);
            $solutioner_configurator = new Configurator($solutioner->configFile(), 'yaml');
            $solutioner->attachConfigurator($solutioner_configurator);
            $solutioner->attachView($tal);
            $solutioner->dispatch();
            
            self::$client->send($solutioner->result());
        }
        
        static function run() {
        }
    }

?>