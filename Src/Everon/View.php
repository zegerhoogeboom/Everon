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

abstract class View implements Interfaces\View, Interfaces\Arrayable
{
    use Dependency\Injection\Factory;

    use Helper\ToArray;


    protected $name = null;
    protected $template_directory = null;

    /**
     * @var Interfaces\TemplateContainer
     */
    protected $Output = null;
    
    protected $TemplateCompiler = null;
    

    /**
     * @param $template_directory
     * @param callable $TemplateCompiler
     */
    public function __construct($template_directory, \Closure $TemplateCompiler)
    {
        $this->name = get_class($this);

        $this->template_directory = $template_directory;
        $this->TemplateCompiler = $TemplateCompiler;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $filename
     * @return string
     */
    public function getTemplateFilename($filename)
    {
        return $this->getTemplateDirectory().$filename.'.htm';
    }

    public function getTemplateDirectory()
    {
        return $this->template_directory;
    }

    /**
     * @param $directory
     */
    public function setTemplateDirectory($directory)
    {
        $this->template_directory = $directory;
    }

    /**
     * @return Interfaces\TemplateContainer
     */
    public function getOutput()
    {
        if (is_null($this->Output)) {
            $this->setOutput('');
        }
        
        if ($this->Output->getCompiledContent() === null) {
            $this->compileOutput();
        }

        return $this->Output;
    }

    /**
     * @param mixed $Output
     * @throws Exception\Template
     */
    public function setOutput($Output)
    {
        $this->Output = null;

        if ($Output instanceof Interfaces\TemplateContainer) {
            $this->Output = $Output;
        }
        else if (is_string($Output)) {
            $this->Output = $this->getFactory()->buildTemplateContainer($Output, []);
        }
        else if (is_array($Output)) {
            $this->Output = $this->getFactory()->buildTemplateContainer('', $Output);
        }

        if (is_null($this->Output)) {
            throw new Exception\Template('Invalid Output type');
        }

        foreach ($this->getData() as $name => $value) {
            $this->Output->set($name, $value);
        }
    }

    protected function compileOutput()
    {
        $Compile = $this->TemplateCompiler;
        $Compile($this->Output);
    }

    /**
     * @param $name
     * @param $data
     * @return Interfaces\TemplateContainer
     */
    public function getTemplate($name, $data)
    {
        return $this->getFactory()->buildTemplate($this, $name, $data);
    }

    /**
     * @param $name
     * @param mixed $data
     */
    public function set($name, $data)
    {
        $this->data[$name] = $data;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $action
     * @param array $data
     */
    public function setTemplateFromAction($action, array $data)
    {
        $filename = $this->getTemplateFilename($action);
        if ($this->Output === null && is_file($filename)) {
            $this->Output = $this->getTemplate($action, $data);
        }
    }
    
}
