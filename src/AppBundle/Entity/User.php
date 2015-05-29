<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"diver" = "dive\LogbookBundle\Entity\Diver", "club" = "dive\ClubBundle\Entity\Club"})
 * 
 */
abstract class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}