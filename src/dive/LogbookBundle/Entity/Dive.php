<?php

namespace dive\LogbookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dive
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="dive\LogbookBundle\Entity\DiveRepository")
 */
class Dive
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="dive\LogbookBundle\Entity\Diver")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diver;

    /**
     * @ORM\ManyToOne(targetEntity="dive\SpotBundle\Entity\Spot")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spot;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="smallint")
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="depth", type="smallint")
     */
    private $depth;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @ORM\ManyToMany(targetEntity="dive\LogbookBundle\Entity\Category", cascade={"persist"})
     */
    private $categories;
    
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setDiver(Diver $diver)
    {
        $this->diver = $diver;

        return $this;
    }

    public function getDiver()
    {
        return $this->diver;
    }

    public function setSpot(Spot $spot)
    {
        $this->spot = $spot;

        return $this;
    }

    public function getSpot()
    {
        return $this->spot;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Dive
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Dive
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set depth
     *
     * @param integer $depth
     * @return Dive
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return integer 
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Dive
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    public function addCategory(Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);
    }

    public function getCategories()
    {
      return $this->categories;
    }
}
