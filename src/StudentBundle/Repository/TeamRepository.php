<?php

namespace StudentBundle\Repository;

use Symfony\Component\Finder\Finder;
use StudentBundle\Entity\Student;
use StudentBundle\Entity\Team;

class TeamRepository
{
    public function findAllTeams(): array
    {
        $finder = new Finder;
        $finder->files()->in(sprintf('%s/../Resources/teams', __DIR__));
        
        $teams = [];
        foreach ($finder as $file) {
            $filePath = $file->getRealPath();
            $data = json_decode(file_get_contents($filePath), true);
            
            $data['students'] = array_map(function(array $studentData) {
                return new Student($studentData);
            }, $data['students']);
            
            $teams[] = new Team($data);
        }
        
        return $teams;
    }
}
