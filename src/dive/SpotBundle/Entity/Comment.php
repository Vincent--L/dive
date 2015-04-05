<?php

namespace dive\SpotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="dive\SpotBundle\Entity\CommentRepository")
 */
class Comment
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
     * @ORM\ManyToOne(targetEntity="dive\SpotBundle\Entity\Spot")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spot;
    
    /**
     * @ORM\ManyToOne(targetEntity="dive\LogbookBundle\Entity\Diver")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diver;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="smallint")
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;


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
     * Set score
     *
     * @param integer $score
     * @return Comment
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }
}
