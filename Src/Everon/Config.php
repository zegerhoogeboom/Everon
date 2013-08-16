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

use Everon\Helper;
use Everon\Exception;


class Config implements Interfaces\Config, Interfaces\Arrayable
{
    use Dependency\Injection\Factory;
    
    use Helper\Asserts;
    use Helper\Asserts\IsArrayKey;    
    use Helper\ArrayMergeDefault;
    use Helper\ToArray;

    /**
     * @var array
     */
    protected $data = [];
    
    protected $name = null;

    protected $filename = '';

    /**
     * @var array
     */
    protected $go_path = [];
    
    protected $data_processed = false;

    /**
     * @var mixed
     */
    protected $DefaultItem = null;

    /**
     * @var array
     */
    protected $items = null;
    

    /**
     * @param $name
     * @param $filename
     * @param \Closure|\Array $data
     */
    public function __construct($name, $filename, $data)
    {
        if (is_array($data) === false && is_callable($data) === false) {
            throw new Exception\Config('Invalid data type for: "%s@%s"', [$name, $filename]);
        }
        
        $this->name = $name;
        $this->filename = $filename;
        $this->data = $data;
    }

    protected function processData()
    {
        if ($this->data_processed === true) {
            return;
        }

        $this->data_processed = true;
        $HasInheritance = function($value) {
            return strpos($value, '<') !== false;
        };

        $use_inheritance = false;
        foreach ($this->data as $name => $data) {
            if ($HasInheritance($name) === true) {
                $use_inheritance = true;
                break;
            }
        }
        
        if ($use_inheritance === false) {
            return;
        }

        $inheritance_list = [];
        $data_processed = [];
        foreach ($this->data as $name => $data) {
            if ($HasInheritance($name) === true) {
                list($for, $from) = explode('<', $name);
                $for = trim($for);
                $from = trim($from);
                $inheritance_list[$for] = $from;
                $data_processed[$for] = $data;
            }
            else {
                $data_processed[$name] = $data;
            }
        }

        if (empty($inheritance_list) === false) {
            foreach ($inheritance_list as $for => $from) {
                $data_processed[$for] = $this->arrayMergeDefault($data_processed[$from], $data_processed[$for]);
            }

            //make sure everything has default
            $default = reset($data_processed);
            foreach ($data_processed as $name => $data) {
                $data_processed[$name] = $this->arrayMergeDefault($default, $data_processed[$name]);
            }
        }
        
        $this->data = $data_processed;
    }

    protected function initItems()
    {
        $default_or_first_item = null;
        foreach ($this->getData() as $item_name => $config_data) {
            $RouteItem = $this->buildItem($item_name, $config_data);
            $this->items[$item_name] = $RouteItem;

            $default_or_first_item = (is_null($default_or_first_item)) ? $RouteItem : $default_or_first_item;
            if ($RouteItem->isDefault()) {
                $this->setDefaultItem($RouteItem);
            }
        }
        
        if (is_null($this->DefaultItem)) {
            $this->setDefaultItem($default_or_first_item);
        }
    }

    /**
     * @param $name
     * @param array $config_data
     * @return Interfaces\ConfigItem
     */
    protected function buildItem($name, array $config_data)
    {
        return $this->getFactory()->buildConfigItem($name, $config_data);
    }

    /**
     * @return array
     */
    protected function getToArray()
    {
        return $this->getData();
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param mixed $Default
     */
    public function setDefaultItem($Default)
    {
        $this->DefaultItem = $Default;
    }

    /**
     * @return mixed
     */
    public function getDefaultItem()
    {
        if (is_null($this->DefaultItem)) {
            $this->initItems();
        }
        
        return $this->DefaultItem;
    }
    
    /**
     * @return array
     */
    public function getData()
    {
        if ($this->data instanceof \Closure) {
            $this->data = $this->data->__invoke();
        }

        $this->processData();
        return $this->data;
    }

    /**
     * @return array|null
     */
    public function getItems()
    {
        if (is_null($this->items)) {
            $this->initItems();
        }

        return $this->items;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getItemByName($name)
    {
        if (is_null($this->items)) {
            $this->initItems();
        }

        $this->assertIsArrayKey($name, $this->items, 'Invalid config item name: "%s"');
        return $this->items[$name];
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function get($name, $default=null)
    {
        $data = $this->getData();
        
        if (empty($this->go_path) === false) {
            foreach ($this->go_path as $index) {
                if (isset($data[$index]) === false) {
                    $this->go_path = [];
                    return $default;
                }
                else {
                    $data = $data[$index];
                }
            }
        }
        
        $this->go_path = [];
        return isset($data[$name]) ? $data[$name] : $default;
    }

    /**
     * @param $where
     * @return Interfaces\Config
     */
    public function go($where)
    {
        $this->go_path[] = $where; 
        return $this;
    }
    
}