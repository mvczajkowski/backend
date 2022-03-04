<?php

namespace App\Repository;

use App\Entity\PersonProductLike;
use App\Model\PersonProductLike\PersonProductLikeFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonProductLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonProductLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonProductLike[]    findAll()
 * @method PersonProductLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonProductLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonProductLike::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PersonProductLike $entity, bool $flush = true): void
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
    public function remove(PersonProductLike $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findFilteredPersonProductLikeList(PersonProductLikeFilter $personProductLikeFilter): array
    {
        $qb = $this->createQueryBuilder('ppl');

        return $qb
            ->join('ppl.person', 'pe')
            ->join('ppl.product', 'pr')
            ->where('
                pe.fName LIKE :person
                OR pe.lName LIKE :person
                OR pe.login LIKE :person
            ')
            ->andWhere('pr.name LIKE :product')
            ->setParameters([
                'person' => "%" . $personProductLikeFilter->getPerson() . "%",
                'product' => "%" . $personProductLikeFilter->getProduct() . "%"
            ])
            ->getQuery()
            ->getResult();
    }
}
