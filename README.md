CypressTreeBundle
=================

A Symfony2 bundle to manage those f***ing tree structures!

The Basics
----------

You have a php class (an entity, a document, or anything else) and you want it to be a part of a tree structure.

* Add the TreeInterface to the class

```php
namespace Cypress\MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cypress\TreeBundle\Interfaces\TreeInterface;

/**
 * MenuItem Document
 *
 * @ORM\Entity(repositoryClass="Vivacom\CmsBundle\Repositories\ORM\MenuItemRepository")
 * @Gedmo\Tree(type="nested")
 */
class MenuItem implements TreeInterface {
    // your class methods
}
```

