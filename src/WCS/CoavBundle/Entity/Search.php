<?php
/**
 * Created by PhpStorm.
 * User: severine
 * Date: 09/09/18
 * Time: 21:31
 */

namespace WCS\CoavBundle\Entity;


class Search
{
    private $query;
    private $sort;

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }
}