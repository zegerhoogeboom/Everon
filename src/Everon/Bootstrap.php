<?php
/**
 * This file is part of the Everon framework.
 *
 * (c) Oliwier Ptak <oliwierptak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon;

class Bootstrap
{
    /**
     * @var \Everon\Interfaces\Environment
     */
    protected $Environment = null;

    /**
     * @var \Everon\Interfaces\ClassLoader
     */
    protected $ClassLoader = null;
    
    protected $os_name = null;
    
    protected $application_ini = null;
    
    
    public function __construct($Environment, $os=PHP_OS)
    {
        $this->Environment = $Environment;
        $os = substr($os, 0, 3);
        $this->os_name = $os === 'WIN' ? 'win' : 'unix';
    }
    
    public function getClassLoader()
    {
        return $this->ClassLoader;
    }
    
    public function getEnvironment()
    {
        return $this->Environment;
    }
    
    public function getOsName()
    {
        return $this->os_name;
    }
    
    protected function setupClassLoader()
    {
        require_once($this->Environment->getEveronInterface().'ClassLoader.php');
        require_once($this->Environment->getEveronRoot().'ClassLoader.php');

        $ini = $this->getApplicationIni();
        $use_cache = (bool) @$ini['cache']['autoloader'];

        $ClassMap = null;
        if ($use_cache) {
            require_once($this->Environment->getEveronRoot().'ClassLoaderCache.php');
            require_once($this->Environment->getEveronInterface().'ClassMap.php');
            require_once($this->Environment->getEveronRoot().'ClassMap.php');

            $classmap_filename = $this->Environment->getCache().'everon_classmap_'.$this->getOsName().'.php';
            $ClassMap = new ClassMap($classmap_filename);
            $ClassLoader = new ClassLoaderCache($ClassMap);
        }
        else {
            $ClassLoader = new ClassLoader();
        }
        
        $this->ClassLoader = $ClassLoader;
    }
    
    protected function getApplicationIni()
    {
        if ($this->application_ini === null) {
            $this->application_ini = @parse_ini_file($this->Environment->getConfig().'application.ini', true);
        }
        return $this->application_ini;
    }
    
    protected function registerClassLoader($prepend_autoloader)
    {
        $this->setupClassLoader($prepend_autoloader);
        
        if ($this->useEveronAutoload()) {
            $this->getClassLoader()->add('Everon', $this->getEnvironment()->getEveronRoot());
            $this->getClassLoader()->register($prepend_autoloader);
        }
    }
    
    public function useEveronAutoload()
    {
        $ini = $this->getApplicationIni();
        return strcasecmp(@$ini['env']['autoload'], 'everon') === 0;
    }
    
    public function run($prepend_autoloader = true)
    {
        $this->registerClassLoader($prepend_autoloader);
        
        require_once($this->getEnvironment()->getEveronHelper().'ToString.php');
        require_once($this->getEnvironment()->getEveronRoot().'Exception.php');

        /**
         * @var Interfaces\DependencyContainer $Container
         * @var Interfaces\Factory $Factory
         */
        $Container = new Dependency\Container();
        return new Factory($Container);
    }

    public static function setupExceptionHandler($guid_value, $app_root, $log_filename)
    {
        $log_directory = implode(DIRECTORY_SEPARATOR, [$app_root, 'Tmp', 'logs']);
        $log_filename = $log_directory.DIRECTORY_SEPARATOR.$log_filename;

        set_exception_handler(function ($Exception) use ($log_filename, $guid_value) {
            $timestamp = date('c', time());
            $id = substr($guid_value, 0, 6);
            $message = "$timestamp ${id} \n$Exception \n\n";
            error_log($message, 3, $log_filename);
            
            if (php_sapi_name() !== 'cli' || headers_sent() === false) {
                header("HTTP/1.1 500 Internal Server Error. EVRID: $guid_value"); //xxx
            }
        });
    }
}   