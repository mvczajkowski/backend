<?php

namespace App\Repository;

use App\Entity\Product;
use App\Model\ProductFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Product $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Product $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findFilteredProductListQuery(ProductFilter $productFilter): Query
    {
        $qb = $this->createQueryBuilder('pr');

        return $qb
            ->where('pr.name LIKE :name')
            ->andWhere('pr.info LIKE :info')
            ->setParameters([
                'name' => "%" . $productFilter->getName() . "%",
                'info' => "%" . $productFilter->getInfo() . "%"
            ])
            ->getQuery();
    }

    public function findProductsForLikeSelect(string $query): array
    {
        $qb = $this->createQueryBuilder('pr');

        return $qb
            ->where('pr.name LIKE :query')
            ->setParameter('query', "%" . $query . "%")
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }
}
