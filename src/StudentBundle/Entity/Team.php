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
     * @ORM\Column(name="studentIds", type="simple_array")
     */
    private $studentIds;

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
     * @param array $studentIds
     *
     * @return Team
     */
    public function setStudentIds($studentIds)
    {
        $this->studentIds = $studentIds;

        return $this;
    }

    /**
     * Get studentIds
     *
     * @return array
     */
    public function getStudentIds()
    {
        return $this->studentIds;
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

