<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "customers")]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", unique: true, nullable: false)]
    private string $email;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private string $firstName;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private string $lastName;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private string $username;

    #[ORM\Column(type: "string", nullable: false)]
    private string $password;

    #[ORM\Column(type: "string", length: 10, nullable: false)]
    private string $gender;

    #[ORM\Column(type: "string", length: 100, nullable: false)]
    private string $country;

    #[ORM\Column(type: "string", length: 100, nullable: false)]
    private string $city;

    #[ORM\Column(type: "string", length: 20, nullable: false)]
    private string $phone;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}