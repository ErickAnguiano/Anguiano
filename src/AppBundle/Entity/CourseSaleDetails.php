<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CourseSaleDetails
 *
 * @ORM\Table(name="course_sale_details", indexes={@ORM\Index(name="sale", columns={"sale"}), @ORM\Index(name="course", columns={"course"}), @ORM\Index(name="student", columns={"student"})})
 * @ORM\Entity
 */
class CourseSaleDetails
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registered", type="datetime", nullable=false)
     */
    private $registered;

    /**
     * @var \Course
     *
     * @ORM\ManyToOne(targetEntity="Course")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="course", referencedColumnName="id")
     * })
     */
    private $course;

    /**
     * @var \CourseSale
     *
     * @ORM\ManyToOne(targetEntity="CourseSale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale", referencedColumnName="id")
     * })
     */
    private $sale;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="student", referencedColumnName="id")
     * })
     */
    private $student;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return CourseSaleDetails
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set registered
     *
     * @param \DateTime $registered
     *
     * @return CourseSaleDetails
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;

        return $this;
    }

    /**
     * Get registered
     *
     * @return \DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return CourseSaleDetails
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set sale
     *
     * @param \AppBundle\Entity\CourseSale $sale
     *
     * @return CourseSaleDetails
     */
    public function setSale(\AppBundle\Entity\CourseSale $sale = null)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return \AppBundle\Entity\CourseSale
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * Set student
     *
     * @param \AppBundle\Entity\User $student
     *
     * @return CourseSaleDetails
     */
    public function setStudent(\AppBundle\Entity\User $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \AppBundle\Entity\User
     */
    public function getStudent()
    {
        return $this->student;
    }
}
