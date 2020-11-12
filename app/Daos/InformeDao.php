<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Informe;

use Doctrine\ORM\Query\ResultSetMapping;  
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class InformeDao extends EntityRepository 
{

    protected $em;
 
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Informe $informe)
    {
       $this->em->persist($informe);
       $this->em->flush();
    }

    public function update(Informe $informe)
    {
        $this->em->merge($informe);
        $this->em->flush();
    }


}
