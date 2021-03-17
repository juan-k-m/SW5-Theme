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


/**
* Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components
*/
class Shopware_Controllers_Backend_JkTheme extends Shopware_Controllers_Backend_ExtJs
{
  protected $model = Theme::class;

  protected $alias = 'theme';

  /**
   * Endpoint to receive the reuests from the backend configuration theme form
   */
  public function readAction(){
    $result = [];

    $shopId = $this->request()->getParam('shopId');
    $themeId = $this->request()->getParam('themeId');
    try {

      $result = $this->getRepository()->loadRowWithShopIdAndThemeId($shopId,$themeId);

    } catch (\Exception $error) {
    }

    if(!empty($result)){


      $toReturn = [
        'success' => true,
        'config' => [
          $result[0]
        ],
      ];



    }else{

      $toReturn = array(
        'success' => true,
        'data' => 'no config available'

      );

    }

    $this->view()->assign($toReturn);

  }

  /**
   * Endpoint to receive the reuests from the backend configuration theme form
   */
  public function updateAction(){

    //get the 'Theme' repository in order to obtain the table row id
    //create an array to facilitate the update the Object
    $shopId = $this->request()->getParam('shop');
    $themeId = $this->request()->getParam('theme');
    $existConfig = [];
    //get helper

    try {
      $helper = $this->getBackendHelper();

      $resquestData = $this->request();
      $resquestData = $helper->prepareData($resquestData);
      $existConfig = $helper->configShop($shopId, $themeId);

    } catch (\Exception $error) {
    }



    if(empty($existConfig)){
      //create a config record in table
      try {

        $helper->insertData($resquestData);

      } catch (\Exception $error) {
      }

    }else{
      //update config record

      $update = $helper->updateData($existConfig, $resquestData);
      if($update){

        $this->view()->assign(['success'=> true, 'update' => $update]);

      }

    }



  }


  private function getBackendHelper(){

    return Shopware()->Container()->get('jk_theme.services.helper');

  }


}
