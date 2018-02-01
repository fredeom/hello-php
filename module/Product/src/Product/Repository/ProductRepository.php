<?php
namespace Product\Repository;

use Product\Entity\Product;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository {
    public function findProducts($filterOptions) {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')->from(Product::class, 'p');
        if (empty($filterOptions)) {
            $queryBuilder->orderBy('p.regdate', 'DESC');
        } else {
            $items = ["name", 'producer', 'type'];
            for ($i = 0; $i < count($items); ++$i) {
                if (!empty($filterOptions[$items[$i]])) {
                    $queryBuilder->andWhere('p.' . $items[$i] . ' LIKE ?' . ($i + 1));
                    $queryBuilder->setParameter("" . ($i + 1), "%" . $filterOptions[$items[$i]] . "%");
                }
            }
            if (!empty($filterOptions["pricefrom"])) {
                $queryBuilder->andWhere('p.price >= ?20');
                $queryBuilder->setParameter('20', $filterOptions["pricefrom"]);
            }
            if (!empty($filterOptions["priceto"])) {
                $queryBuilder->andWhere('p.price <= ?21');
                $queryBuilder->setParameter('21', $filterOptions["priceto"]);
            }
            if (!empty($filterOptions["datefrom"])) {
                $queryBuilder->andWhere('p.regdate >= ?22');
                $queryBuilder->setParameter('22', $filterOptions["datefrom"]);
            }
            if (!empty($filterOptions["dateto"])) {
                $queryBuilder->andWhere('p.regdate < ?23');
                $queryBuilder->setParameter('23', date('Y-m-d', strtotime('+1 day', strtotime($filterOptions["dateto"]))));
            }
            if (!empty($filterOptions["sortby"])) {
                $queryBuilder->orderBy("p." . $filterOptions["sortby"], $filterOptions["sortorder"]);
            }
        }
        return $queryBuilder->getQuery();
    }
}