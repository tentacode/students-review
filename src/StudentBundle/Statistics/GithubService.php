<?php

namespace StudentBundle\Statistics;

use StudentBundle\Entity\Team;

class GithubService
{
    public function getStats(int $teamId): array
    {
        $teamRepository = $em->getRepository(Team::class);
        $githubUrl = $teamRepository->find($teamId)
            ->getGithubRepository()
        ;
        
        return [
            'commits' => 123,
            'additions' => 123124,
            'deletions' => 3298,
        ];
    }
}
