<?php

namespace StudentBundle\Entity;

class Team
{
    private $id;
    private $name;
    private $students;
    private $gitRepository;
    
    public function __construct(array $options)
    {
        $this->id = $options['id'];
        $this->name = $options['name'] ?? 'Aucun nom';
        $this->students = $options['students'] ?? [];
        $this->gitRepository = $options['gitRepository'] ?? null;
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getStudents(): array
    {
        return $this->students;
    }
    
    public function getGitRepository(): ?string
    {
        return $this->gitRepository;
    }
}
