<?php

namespace JkTheme\Services;
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

use JkTheme\Models\Theme;

class ConfigReader{

    private function getRepository(){

      return Shopware()->Models()->getRepository(Theme::class);

    }

/**
 *
 * @param $shopId int
 * @param $themeId int
 *
 * @return Array
 *
 */
    public function readThemeConfig($shopId,$themeId){

      $return = $this->getRepository()->loadRowWithShopIdAndThemeId($shopId,$themeId);

      return $return;
    }





}



?>
