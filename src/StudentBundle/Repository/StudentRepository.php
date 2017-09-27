<?php

namespace StudentBundle\Repository;

use Symfony\Component\Finder\Finder;
use StudentBundle\Entity\Student;
use StudentBundle\Entity\Team;

class StudentRepository
{
    public function findById(int $studentId): ?Student
    {
        $teamRepository = new TeamRepository();
        $teams = $teamRepository->findAllTeams();
        foreach($teams as $team) {
            foreach ($team->getStudents() as $student) {
                if ($student->getId() === $studentId) {
                    return $student;
                }
            }
        }
        
        return null;
    }
}
