CypressTreeBundle
=================

A Symfony2 bundle to manage those f***ing tree structures!

The Basics
----------

You have a php class (an entity, a document, or anything else) and you want it to be a part of a tree structure.
For this example let's consider a Doctrine ORM entity with the Tree extension enabled from the awesome [gedmo repository](https://github.com/l3pp4rd/DoctrineExtensions). Here is a [full configuration tutorial](http://gediminasm.org/article/tree-nestedset-behavior-extension-for-doctrine-2)

* Add the TreeInterface to the class

```php
<?php
namespace Cypress\MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Cypress\TreeBundle\Interfaces\TreeInterface;

/**
 * MenuItem Document
 *
 * @ORM\Entity(repositoryClass="Vivacom\CmsBundle\Repositories\ORM\MenuItemRepository")
 * @Gedmo\Tree(type="nested")
 */
class MenuItem implements TreeInterface {
    /**
     * @var MenuItem
     *
     * @ORM\ManyToOne(targetEntity="MenuItem", inversedBy="children")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Gedmo\TreeParent
     */
    private $parent;

    /**
     * var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="parent", cascade={"all"})
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * add a MenuItem as children
     *
     * @param MenuItem $menuItem the children page
     */
    public function addChildren(MenuItem $menuItem)
    {
        $menuItem->setParent($this);
        $this->children[] = $menuItem;
    }

    /**
     * Children setter
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $children la variabile children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * Children getter
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Parent setter
     *
     * @param \Vivacom\CmsBundle\Document\MenuItem $parent the parent property
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * Parent getter
     *
     * @return \Vivacom\CmsBundle\Document\MenuItem
     */
    public function getParent()
    {
        return $this->parent;
    }
}
```

**TreeInterface** define one method that you MUST define **getChildren()**

```php
<?php
namespace Cypress\TreeBundle\Interfaces;

/**
 * Interface for trees
 */
interface TreeInterface
{
    /**
     * returns a in iteratable object of children
     *
     * @abstract
     * @return mixed
     */
    function getChildren();
}
```

We already have it in the class as a getter for the *children* property.
You could use any class, as far as you implement TreeInterface, and define the *getChildren* method.

