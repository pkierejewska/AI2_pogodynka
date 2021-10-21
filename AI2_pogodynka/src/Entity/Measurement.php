<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeasurementRepository::class)
 */
class Measurement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $temperature;

    /**
     * @ORM\Column(type="integer")
     */
    private $chance_of_precipitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $wind;

    /**
     * @ORM\Column(type="integer")
     */
    private $humidity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cloudiness;

    /**
     * @ORM\ManyToOne(targetEntity=City::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getChanceOfPrecipitation(): ?int
    {
        return $this->chance_of_precipitation;
    }

    public function setChanceOfPrecipitation(int $chance_of_precipitation): self
    {
        $this->chance_of_precipitation = $chance_of_precipitation;

        return $this;
    }

    public function getWind(): ?int
    {
        return $this->wind;
    }

    public function setWind(int $wind): self
    {
        $this->wind = $wind;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getCloudiness(): ?string
    {
        return $this->cloudiness;
    }

    public function setCloudiness(string $cloudiness): self
    {
        $this->cloudiness = $cloudiness;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

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
}
