<?php

namespace StudentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="StudentBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Student", mappedBy="team")
     */
    private $students;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="githubRepository", type="string", length=255)
     */
    private $githubRepository;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set studentIds
     *
     * @param array $students
     *
     * @return Team
     */
    public function setStudents($students)
    {
        $this->students = $students;

        return $this;
    }

    /**
     * Get students
     *
     * @return array
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set githubRepository
     *
     * @param string $githubRepository
     *
     * @return Team
     */
    public function setGithubRepository($githubRepository)
    {
        $this->githubRepository = $githubRepository;

        return $this;
    }

    /**
     * Get githubRepository
     *
     * @return string
     */
    public function getGithubRepository()
    {
        return $this->githubRepository;
    }
}
