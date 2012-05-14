<?php
/**
 * User: matteo
 * Date: 10/05/12
 * Time: 22.34
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Tree;

/**
 * A class representing a single tree as defined in dependency injection parameters
 */
class TreeConfiguration
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $configs;

    /**
     * Class constructor
     *
     * @param string $name    tree name
     * @param array  $configs dependency injection configuration
     */
    public function __construct($name, $configs)
    {
        $this->name = $name;
        $this->configs = $configs;
    }

    /**
     * universal configuration property getter
     *
     * @param string $name property name
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        if (!array_key_exists($name, $this->configs)) {
            throw new \InvalidArgumentException(sprintf('TreeConfiguration do not have a %s configuration', $name));
        }
        return $this->configs[$name];
    }

    /**
     * universal method caller
     *
     * @param string $method method name
     * @param array  $args   method arguments
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->$method;
    }

    /**
     * Name getter
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * check if the controller implements the TreeControllerSortableInterface interface
     *
     * @return bool
     */
    public function isSortable()
    {
        $reflection = new \ReflectionClass($this->controller);
        return in_array('Cypress\TreeBundle\Interfaces\TreeControllerSortableInterface', $reflection->getInterfaceNames());
    }
}
