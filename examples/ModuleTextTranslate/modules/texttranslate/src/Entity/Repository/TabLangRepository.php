<?php

namespace PrestaShop\Module\TextTranslate\Repository;

class TabLangRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllByArray(){

        return $this->createQueryBuilder('tabl')
            ->select('tabl.name, l.name lang, t.module, t.className')
            ->join('tabl.lang','l')
            ->join('tabl.tab','t')
            ->getQuery()
            ->getArrayResult();
    }
}
