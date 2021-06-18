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

namespace JkTheme\Models;

use Shopware\Components\Model\ModelRepository;

class Repository extends ModelRepository
{

    /**
     * Returns an instance of the \Doctrine\ORM\Query object which selects a list of Test
     *
     * @param null $filter
     * @param null $orderBy
     * @param      $offset
     * @param      $limit
     * @return \Doctrine\ORM\Query
     */
    public function getListQuery($filter = null, $orderBy = null, $offset, $limit)
    {
        $builder = $this->getListQueryBuilder($filter, $orderBy);
        $builder->setFirstResult($offset)
            ->setMaxResults($limit);
        return $builder->getQuery();
    }

    /**
     * Helper function to create the query builder for the "getListQuery" function.
     * This function can be hooked to modify the query builder of the query object.
     *
     * @param null $filter
     * @param null $orderBy
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getListQueryBuilder($filter = null, $orderBy = null)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();

        $builder->select(array('theme'))
            ->from($this->getEntityName(), 'theme');

        $this->addFilter($builder, $filter);
        $this->addOrderBy($builder, $orderBy);

        return $builder;
    }


    /**
     * Helper function to retrieve data from one row with the variables given
     *
     * @param int $shopId
     * @param int $themeId
     * @return array results
     */
    public function loadRowWithShopIdAndThemeId($shopId, $themeId){
        $builder = $this->getEntityManager()->createQueryBuilder();
        return $builder->select('themeJk')
        ->from(Theme::class, 'themeJk')
        ->where('themeJk.shop = :shopId AND themeJk.theme = :themeId')
        ->setParameter('shopId', $shopId)
        ->setParameter('themeId', $themeId)
        ->getQuery()
        ->getArrayResult();
    }

    /**
     * Helper function to retrieve data from one row with the variable given
     *
     * @param int $shopId
     * @return array results
     */
    public function loadRowWithShopId($shopId){

        $builder = $this->getEntityManager()->createQueryBuilder();
        return $builder->select('themeJk')
        ->from(Theme::class, 'themeJk')
        ->where('themeJk.shop = :shopId')
        ->setParameter('shopId', $shopId)
        ->getQuery()
        ->getArrayResult();
    }


}
