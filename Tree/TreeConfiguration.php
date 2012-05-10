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
     * @var string
     */
    private $labelTemplate;

    /**
     * @var string
     */
    private $assetsManager;

    /**
     * @var string
     */
    private $theme;

    /**
     * Class constructor
     *
     * @param string $name    tree name
     * @param array  $configs dependency injection configuration
     */
    public function __construct($name, $configs)
    {
        $this->name = $name;
        $this->labelTemplate = $configs['label_template'];
        $this->assetsManager = $configs['assets_manager'];
        $this->theme = $configs['theme'];
    }

    /**
     * AssetsManager getter
     *
     * @return string
     */
    public function getAssetsManager()
    {
        return $this->assetsManager;
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
     * Theme getter
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * LabelTemplate getter
     *
     * @return string
     */
    public function getLabelTemplate()
    {
        return $this->labelTemplate;
    }
}
