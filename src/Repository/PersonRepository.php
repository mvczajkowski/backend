<?php

namespace App\Repository;

use App\Entity\Person;
use App\Model\PersonFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Person $entity, bool $flush = true): void
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
    public function remove(Person $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findFilteredPersonListQuery(PersonFilter $personFilter): Query
    {
        $qb = $this->createQueryBuilder('pe');

        $qb
            ->where('pe.login LIKE :login')
            ->andWhere('pe.fName LIKE :fName')
            ->andWhere('pe.lName LIKE :lName')
            ->setParameters([
                'login' => "%" . $personFilter->getLogin() . "%",
                'fName' => "%" . $personFilter->getFName() . "%",
                'lName' => "%" . $personFilter->getLname() . "%"
            ]);

        if ($personFilter->getState() !== 0) {
            $qb
                ->andWhere('pe.state = :state')
                ->setParameter('state', $personFilter->getState());
        }

        return $qb->getQuery();
    }

    public function findPeopleForLikeSelect(string $query): array
    {
        $qb = $this->createQueryBuilder('pe');

        return $qb
            ->where('
                pe.fName LIKE :query
                OR pe.lName LIKE :query
                OR pe.login LIKE :query
            ')
            ->setParameter('query', "%" . $query . "%")
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }
}
