<?php


namespace App\Repository;

namespace App\Repository;
use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends \Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry){
        parent::__construct($registry, Produit::class);
    }
}
