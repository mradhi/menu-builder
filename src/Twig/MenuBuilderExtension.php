<?php
declare(strict_types=1);

namespace Usyme\MenuBuilder\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Usyme\MenuBuilder\Menu;
use Usyme\MenuBuilder\MenuBuilderInterface;

class MenuBuilderExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('build_menu', [$this, 'build'])
        ];
    }

    /**
     * @param MenuBuilderInterface $menuBuilder
     *
     * @return Menu
     */
    public function build(MenuBuilderInterface $menuBuilder): Menu
    {
        return $menuBuilder->build();
    }
}
