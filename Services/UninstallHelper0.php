<?php
namespace JkTheme\Services;

use Shopware\Models\Shop\Shop;
use Shopware\Models\Shop\Template;

class UninstallHelper{


  /**
  *@params int $shopId
  *@params int $responsiveThemeId
  */
  public static function setResponsiveTheme()
  {
    // Reset preview template
    $responsiveThemeId = self::getResponsiveThemeId();

    //find the id from the 'JkTheme' in Model Template.
    $jkThemeId = self::getJkThemeId();

    //must iterates through all shops which, even were directed assigned the template 'JkTheme' or its childs.
    //find all shops with the direct assignment in the Shop Model with the row 'template_id'.
    //lock up for themes that has the parent from 'Jktheme' in Template model and find the shops that have this template
    //assigned.

    $shopsIds = self::getAllShopsIds($jkThemeId);

echo "<pre>"; var_dump($shopsIds);exit;
    $this->resetPreviewSessionAction($shopId);

    $this->getContainer()->get('theme_service')->assignShopTemplate(
      $shopId,
      $responsiveThemeId
    );

  }

  private static function getAllShopsIds($jkThemeId){

    $repository = self::getShopRepository();
    $result = $repository->findBy(['template' => $jkThemeId]);

echo "<pre>"; var_dump($result);exit;



  }

  /**
   * @returns int
   * retrieves the id of the 'JkTheme' theme
   */
  protected static function getJkThemeId(){

    $repository = self::getTemplateRepository();
    $result = $repository->findBy(['template' => 'JkTheme']);

    return $result[0]->getId();

  }

  /**
   * @returns int
   * retrieves the id of the 'Responsive' theme
   */
  protected static function getResponsiveThemeId(){

  $repository = self::getTemplateRepository();
  $result = $repository->findBy(['template' => 'Responsive']);

  return $result[0]->getId();


  }

  private static function getTemplateRepository(){

    return Shopware()->Models()->getRepository(Template::class);

  }

  private static function getShopRepository(){

    return Shopware()->Models()->getRepository(Shop::class);

  }

  /**
  * Resets the template variable within the shop session
  * for the passed shop id.
  */
  public function resetPreviewSessionAction($shopId)
  {

    if (empty($shopId)) {
      return;
    }

    // /** @var Shop $shop */
    // Shop::class->getActiveById(
    //   $shopId
    // );

    if (!$shop instanceof Shop) {
      return;
    }

    $this->getContainer()->get('shopware.components.shop_registration_service')->registerShop($shop);

    Shopware()->Session()->offsetSet('template', null);
  }

  /**
  * @return container
  */
  private function getContainer(){

    return Shopware()->Container();


  }


}





?>
