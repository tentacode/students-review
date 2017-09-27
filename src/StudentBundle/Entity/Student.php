<?php

namespace StudentBundle\Entity;

class Student
{
    private $id;
    private $firstname;
    private $lastname;
    
    public function __construct(array $options)
    {
        $this->id = $options['id'];
        $this->firstname = $options['firstname'] ?? 'Aucun prénom';
        $this->lastname = $options['lastname'] ?? 'Aucun nom';
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    
    public function getLastname(): string
    {
        return $this->lastname;
    }
    
    public function getImage(): string
    {
        $normalizedLastname = strtoupper($this->lastname);
        $normalizedLastname = str_replace(' ', '_', $normalizedLastname);
        
        return sprintf(
            'bundles/student/img/%s_%s.jpg',
            $normalizedLastname,
            $this->firstname
        );
    }
}
