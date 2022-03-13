<?php

namespace App\Entity;

use App\Repository\MajorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MajorRepository::class)]
class Major
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $majorid;

    #[ORM\Column(type: 'string', length: 255)]
    private $majorname;

    #[ORM\Column(type: 'integer')]
    private $trainingtime;

    #[ORM\Column(type: 'string', length: 255)]
    private $trainingsystem;

    #[ORM\OneToMany(mappedBy: 'major', targetEntity: Studentmanager::class)]
    private $studentmanagers;

    public function __construct()
    {
        $this->studentmanagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMajorid(): ?string
    {
        return $this->majorid;
    }

    public function setMajorid(string $majorid): self
    {
        $this->majorid = $majorid;

        return $this;
    }

    public function getMajorname(): ?string
    {
        return $this->majorname;
    }

    public function setMajorname(string $majorname): self
    {
        $this->majorname = $majorname;

        return $this;
    }

    public function getTrainingtime(): ?int
    {
        return $this->trainingtime;
    }

    public function setTrainingtime(int $trainingtime): self
    {
        $this->trainingtime = $trainingtime;

        return $this;
    }

    public function getTrainingsystem(): ?string
    {
        return $this->trainingsystem;
    }

    public function setTrainingsystem(string $trainingsystem): self
    {
        $this->trainingsystem = $trainingsystem;

        return $this;
    }

    /**
     * @return Collection<int, Studentmanager>
     */
    public function getStudentmanagers(): Collection
    {
        return $this->studentmanagers;
    }

    public function addStudentmanager(Studentmanager $studentmanager): self
    {
        if (!$this->studentmanagers->contains($studentmanager)) {
            $this->studentmanagers[] = $studentmanager;
            $studentmanager->setMajor($this);
        }

        return $this;
    }

    public function removeStudentmanager(Studentmanager $studentmanager): self
    {
        if ($this->studentmanagers->removeElement($studentmanager)) {
            // set the owning side to null (unless already changed)
            if ($studentmanager->getMajor() === $this) {
                $studentmanager->setMajor(null);
            }
        }

        return $this;
    }
}
