<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Loader\Configurator;

use Symfony\Component\Routing\RouteCollection;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class ImportConfigurator
{
    use Traits\PrefixTrait;
    use Traits\RouteTrait;

    private $parent;

    public function __construct(RouteCollection $parent, RouteCollection $route)
    {
        $this->parent = $parent;
        $this->route = $route;
    }

    public function __destruct()
    {
        $this->parent->addCollection($this->route);
    }

    /**
     * Sets the prefix to add to the path of all child routes.
     *
     * @param string|array $prefix the prefix, or the localized prefixes
     *
     * @return $this
     */
    final public function prefix($prefix, bool $trailingSlashOnRoot = true): self
    {
        $this->addPrefix($this->route, $prefix, $trailingSlashOnRoot);

        return $this;
    }

    /**
     * Sets the prefix to add to the name of all child routes.
     *
     * @return $this
     */
    final public function namePrefix(string $namePrefix): self
    {
        $this->route->addNamePrefix($namePrefix);

        return $this;
    }
}
