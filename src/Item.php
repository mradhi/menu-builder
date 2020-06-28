<?php
declare(strict_types=1);

namespace Usyme\MenuBuilder;

class Item
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $routes;

    /**
     * Item constructor.
     *
     * @param string $name
     * @param array  $options
     */
    public function __construct(string $name, array $options = [])
    {
        $this->name    = $name;
        $this->options = $options;
    }

    /**
     * @param string $currentRoute
     *
     * @return bool
     */
    public function isActive(string $currentRoute): bool
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            if (strpos($route, '*') !== false) {
                $partName = str_replace('*', '', $route);

                if (substr($currentRoute, 0, strlen($partName)) === $partName) {
                    return true;
                }
            }
        }

        foreach ($this->getChildren() as $child) {
            $routes = array_merge($routes, $child->getRoutes());
        }

        return in_array($currentRoute, $routes, true);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getIcon(): ?string
    {
        return $this->getOption('icon');
    }

    /**
     * @return string[]
     */
    public function getRoutes(): array
    {
        if (null === $this->routes) {
            $this->routes = $this->getOption('routes', []);
        }

        return $this->routes;
    }

    /**
     * @return string|null
     */
    public function getFirstRoute(): ?string
    {
        if (!empty($routes = $this->getRoutes())) {
            return $routes[0];
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasDivider(): bool
    {
        return $this->getOption('divider', false);
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return !empty($this->getChildren());
    }

    /**
     * @return Item[]
     */
    public function getChildren(): array
    {
        return $this->getOption('children', []);
    }

    /**
     * @param string $group
     *
     * @return bool
     */
    public function belongsTo(string $group): bool
    {
        return $group === $this->getGroup();
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->getOption('group', 'default');
    }

    /**
     * @param string $key
     * @param        $default
     *
     * @return mixed
     */
    public function getOption(string $key, $default = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }

        return $default;
    }
}
