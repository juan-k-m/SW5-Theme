<?php
/**
*   Shopware Theme - Simple Shopware theme with backend configurations options
*   Copyright (C) 2020, JuanK
*
*   This program is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This program is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details.
*
*   You should have received a copy of the GNU General Public License
*   along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

namespace JkTheme\Subscriber;


use Enlight\Event\SubscriberInterface;
use JkTheme\Services\ConfigReader;

class EventsRegister implements SubscriberInterface
{

    /**
     * @var ConfigReader
     */
    private $configReader;

    /**
     * @var string
     */
    private $pluginName;

    /**
     * @param ConfigReader $configReader
     * @param $pluginName
     */
    public function __construct(ConfigReader $configReader, $pluginName)
    {
        $this->configReader = $configReader;
        $this->pluginName = $pluginName;
    }

    public static function getSubscribedEvents()
    {
        return [

            'Enlight_Controller_Action_PostDispatch_Frontend'            => 'onFrontend',

        ];
    }


    /**
     * The Html elements classes are here set in order to
     * make the css changes. The configuration for the current
     * shop and theme are called to check which configurations 
     * have been set
     *
     *
     */
    public function onFrontend(\Enlight_Event_EventArgs $args)
    {
      /** @var \Shopware_Controllers_Frontend_Detail $subject */
        $subject = $args->get('subject');
        $view     = $subject->View();


        //get the current shop and theme
        $shopId = Shopware()->Shop()->getId();
        $themeId = Shopware()->Shop()->getTemplate();
        $themeConfiguration = $this->configReader->readThemeConfig($shopId,$themeId);
        $themeConfiguration = $themeConfiguration[0];


        //variable for assign values
        //array
        $assignedValues = [];

        $fixNavigation = (bool)$themeConfiguration['navigation'];
        if ($fixNavigation) {

          $assignedValues['fixNavigation'] = true;


        }

        $view->assign('JkTheme', $assignedValues);




    }




}
