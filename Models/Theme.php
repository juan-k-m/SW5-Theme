<?php

namespace JkTheme\Models;

use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="s_plugin_jk_theme")
 * @ORM\Entity(repositoryClass="Repository")
 */
class Theme extends ModelEntity
{
    /**
     * Primary Key - autoincrement value
     *
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $navigation
     *
     * @ORM\Column(name="navigation", type="integer", nullable=false)
     */
    private $navigation;

    /**
     * @var integer $shop
     *
     * @ORM\Column(name="shop", type="integer", nullable=false)
     */
    private $shop;

    /**
     * @var integer $theme
     *
     * @ORM\Column(name="theme", type="integer", nullable=false)
     */
    private $theme;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * @param $navigation int
     */
    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * @return int
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param $navigation int
     */
    public function setShop($shop)
    {
        $this->shop = $shop;
    }

    /**
     * @return int
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param $navigation int
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }
}
