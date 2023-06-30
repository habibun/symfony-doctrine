<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function add(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllOrdered()
    {
        $qb = $this->createQueryBuilder('c')
            ->addOrderBy('c.name', Criteria::DESC);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function search(string $term)
    {
        $qb = $this->addOrderByCategoryName();

        return $this->addFortuneCookieJoinAndSelect($qb)
            ->andWhere('category.name LIKE :searchTerm OR category.iconKey LIKE :searchTerm OR fortuneCookie.fortune LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$term.'%')
            ->addOrderBy('category.name', Criteria::DESC)
            ->getQuery()
            ->getResult();
    }

    public function findWithFortunesJoin(int $id): ?Category
    {
        $qb = $this->addOrderByCategoryName();

        return $this->addFortuneCookieJoinAndSelect($qb)
            ->andWhere('category.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    private function addFortuneCookieJoinAndSelect(QueryBuilder $qb = null): QueryBuilder
    {
        return ($qb ?? $this->createQueryBuilder('category'))
            ->addSelect('fortuneCookie')
            ->leftJoin('category.fortuneCookies', 'fortuneCookie');
    }

    private function addOrderByCategoryName(QueryBuilder $qb = null): QueryBuilder
    {
        return ($qb ?? $this->createQueryBuilder('category'))
            ->addOrderBy('category.name', Criteria::DESC);
    }
}
