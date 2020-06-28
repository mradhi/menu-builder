<?php
declare(strict_types=1);

namespace Usyme\MenuBuilder;

class Menu
{
    /**
     * @var Item[]
     */
    protected $items;

    /**
     * Menu constructor.
     *
     * @param Item[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param Item $item
     *
     * @return self
     */
    public function addItem(Item $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param string $name
     * @param        $options
     *
     * @return self
     */
    public function add(string $name, array $options = []): self
    {
        return $this->addItem(new Item($name, $options));
    }
}
