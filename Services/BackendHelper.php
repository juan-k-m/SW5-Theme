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

namespace JkTheme\Services;

use JkTheme\Models\Theme;

class BackendHelper{

/**
 *
 * @param Request
 *
 * @return Array
 *
 */
    public function prepareData($requesData){

        $shopId = $requesData->getParam('shop');
        $navigation = $requesData->getParam('navigation');
        $themeId = $requesData->getParam('theme');
        $arrayToReturn = [];
        $arrayToReturn['shop'] = $shopId;
        $arrayToReturn['navigation'] = $navigation;
        $arrayToReturn['theme'] = $themeId;

        return $arrayToReturn;

    }

    public function configShop($shopId,$themeId){

      $existConfig = $this->getRepository()->findBy(['shop' => $shopId, 'theme' => $themeId]);

      return $existConfig;

    }

    public function insertData($arrayData){


      $theme = new Theme();

      foreach($arrayData as $key => $value){
        $set = 'set'.ucfirst($key);
        $theme->$set($value);
      }

      Shopware()->Models()->persist($theme);
      Shopware()->Models()->flush();


    }

    public function updateData($configRow,$arrayData){

      $toReturn = false;

      $config = $this->getRepository()->find($configRow[0]->getId());

      foreach($arrayData as $key => $value){
        $set = 'set'.ucfirst($key);
        $config->$set($value);
      }


      Shopware()->Models()->flush();

      if(is_object($config)){

        if((bool)$config->getId()){
          $toReturn = (bool)$config->getId();
        }

      }

      return $toReturn;


    }

    protected function getRepository()
    {

      return Shopware()->Models()->getRepository(Theme::class);

    }





}



?>
