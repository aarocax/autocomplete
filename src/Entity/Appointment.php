<?php

namespace App\Entity;

use App\Entity\Customer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Appointment
 *
 * @ORM\Table(name="appointment")
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
 */
class Appointment
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
     * @var string
     *
     * @ORM\Column(name="customer_alias", type="string", length=255, nullable=true)
     */
    private $customerAlias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="appointment_date", type="datetime")
     */
    private $appointmentDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="appointments")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * Constructor
     */
    public function __construct()
    {
      $this->creationDate = new \DateTime();
    }

    public function __toString()
    {
        return 'cadena de texto'.'-'.$this->getId();
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

    public function getCustomerAlias(): ?string
    {
        return $this->customerAlias;
    }

    public function setCustomerAlias(?string $customerAlias): self
    {
        $this->customerAlias = $customerAlias;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getAppointmentDate(): ?\DateTimeInterface
    {
        return $this->appointmentDate;
    }

    public function setAppointmentDate(\DateTimeInterface $appointmentDate): self
    {
        $this->appointmentDate = $appointmentDate;

        return $this;
    }

    /**
     * Set customer
     *
     * @param  \App\Entity\Customer $customer
     * @return Appointment
     */
    public function setCustomer(\App\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \App\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

   
}
