<?php
declare(strict_types=1);

namespace Usyme\MenuBuilder;

interface MenuBuilderInterface
{
    /**
     * @return Menu
     */
    public function build(): Menu;
}
