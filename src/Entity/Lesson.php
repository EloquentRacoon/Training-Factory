<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_persons;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Training", inversedBy="lesson")
     */
    private $training;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Registration", mappedBy="lesson")
     */
    private $registration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="lessons")
     */
    private $person;

    public function __construct()
    {
        $this->registration = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getMaxPersons(): ?int
    {
        return $this->max_persons;
    }

    public function setMaxPersons(int $max_persons): self
    {
        $this->max_persons = $max_persons;

        return $this;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }

    /**
     * @return Collection|registration[]
     */
    public function getRegistration(): Collection
    {
        return $this->registration;
    }

    public function addRegistration(registration $registration): self
    {
        if (!$this->registration->contains($registration)) {
            $this->registration[] = $registration;
            $registration->setLesson($this);
        }

        return $this;
    }

    public function removeRegistration(registration $registration): self
    {
        if ($this->registration->contains($registration)) {
            $this->registration->removeElement($registration);
            // set the owning side to null (unless already changed)
            if ($registration->getLesson() === $this) {
                $registration->setLesson(null);
            }
        }

        return $this;
    }

    public function getPerson(): ?person
    {
        return $this->person;
    }

    public function setPerson(?person $person): self
    {
        $this->person = $person;

        return $this;
    }
}
