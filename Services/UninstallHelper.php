<?php
namespace JkTheme\Services;

use Shopware\Models\Shop\Shop;
use Shopware\Models\Shop\Template;

class UninstallHelper{


  /**
  *@params int $shopId
  *@params int $responsiveThemeId
  */
  public  function setResponsiveTheme()
  {

    // Reset preview template
    $responsiveThemeId = $this->getResponsiveThemeId();

    //find the id from the 'JkTheme' in Model Template.
    $jkThemeId = $this->getJkThemeId();

    //must iterates through all shops which, even were directed assigned the template 'JkTheme' or its childs.
    //find all shops with the direct assignment in the Shop Model with the row 'template_id'.
    //lock up for themes that has the parent from 'Jktheme' in Template model and find the shops that have this template
    //assigned.

    $shopsIds = $this->getAllShopsIds($jkThemeId);


    if (!empty($shopsIds)) {
      // code...

      foreach ($shopsIds as $key => $shopId) {

        $this->resetPreviewSessionAction($shopId);

        Shopware()->Container()->get('theme_service')->assignShopTemplate(
          $shopId,
          $responsiveThemeId
        );


      }
    }


  }

  /**
  * Functions uses raw SQl statement in order to obtain in one call all the Shop's ids
  * @param int $jkThemeId
  * @return Array
  */
  private  function getAllShopsIds($jkThemeId){

    $sql = "SELECT s.id FROM s_core_shops AS s WHERE s.template_id=$jkThemeId OR s.template_id IN
    (SELECT t.id FROM s_core_templates AS t WHERE t.parent_id=$jkThemeId);";

    $result = Shopware()->Db()->query($sql)->fetchAll();
    return $result;
  }

  /**
  * @returns int
  * Funtion retrieves the id of the 'JkTheme' theme
  */
  protected  function getJkThemeId(){

    $repository = $this->getTemplateRepository();
    $result = $repository->findBy(['template' => 'JkTheme']);

    return $result[0]->getId();

  }

  /**
  * @returns int
  * Funtion retrieves the id of the 'Responsive' theme
  */
  protected  function getResponsiveThemeId(){

    $repository = $this->getTemplateRepository();
    $result = $repository->findBy(['template' => 'Responsive']);

    return $result[0]->getId();


  }

  /**
  * Function retrieves the Repository of the Template Entity
  */
  private  function getTemplateRepository(){

    return Shopware()->Models()->getRepository(Template::class);

  }

  /**
  * Function retrieves the Repository of the Shop Entity
  */
  private  function getShopRepository(){

    return Shopware()->Models()->getRepository(Shop::class);

  }

  /**
  * Function resets the template variable within the shop session
  * for the passed shop id.
  */
  public function resetPreviewSessionAction($shopId)
  {

    if (empty($shopId)) {
      return;
    }

    /** @var $shop \Shopware\Models\Shop\Shop */
    $shop = $this->getShopRepository()->getActiveById(
      $shopId['id']
    );

    if (!$shop instanceof Shop) {
      return;
    }

    $shop->registerResources();

    Shopware()->Session()->template = null;
  }


  /**
  * @return container
  */
  private function getContainer(){

    return Shopware()->Container();


  }


}





?>
