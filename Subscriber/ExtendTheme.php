<?php

namespace JkTheme\Subscriber;

use Enlight\Event\SubscriberInterface;

class ExtendTheme implements SubscriberInterface
{
    /**
     * @var string
     */
    private $pluginDirectory;

    /**
     * @param $pluginDirectory
     */
    public function __construct($pluginDirectory)
    {
        $this->pluginDirectory = $pluginDirectory;
    }
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
           'Enlight_Controller_Action_PostDispatchSecure_Backend_Theme' => 'onBackendThemePostDispatch',
        ];
    }

    public function onBackendThemePostDispatch(\Enlight_Event_EventArgs $args)
    {

        /** @var \Shopware_Controllers_Backend_Theme $controller */
        $controller = $args->getSubject();

        $view = $controller->View();
        $request = $controller->Request();

        $view->addTemplateDir($this->pluginDirectory . '/Resources/views');



        if ($request->getActionName() == 'index') {
            $view->extendsTemplate('backend/jk_theme/app.js');
        }

        if ($request->getActionName() == 'load') {
            $view->extendsTemplate('backend/jk_theme/view/detail/juank.js');
            }
    }
}
