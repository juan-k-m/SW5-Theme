<?php

namespace Shopware\Themes\JkTheme;

use Shopware\Components\Form as Form;

class Theme extends \Shopware\Components\Theme
{
    protected $extend = 'Responsive';

    protected $name = <<<'SHOPWARE_EOD'
Jk Theme
SHOPWARE_EOD;

    protected $description = <<<'SHOPWARE_EOD'
Jk Theme
SHOPWARE_EOD;

    protected $author = <<<'SHOPWARE_EOD'
Jk Theme
SHOPWARE_EOD;

    protected $license = <<<'SHOPWARE_EOD'
MIT
SHOPWARE_EOD;


protected $javascript = [
    'src/js/main.js',
    'src/js/collapseCart.js',
];

    public function createConfig(Form\Container\TabContainer $container)
    {
    }
}
