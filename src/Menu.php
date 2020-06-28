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
     * @param string $group
     *
     * @return Item[]
     */
    public function getItems(string $group = 'default'): array
    {
        return array_filter($this->items, function (Item $item) use ($group) {
            return $item->belongsTo($group);
        });
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
