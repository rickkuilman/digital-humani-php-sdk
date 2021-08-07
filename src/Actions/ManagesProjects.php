<?php

namespace Rickkuilman\DigitalHumaniSdk\Actions;

use Rickkuilman\DigitalHumaniSdk\Resources\Project;

trait ManagesProjects
{
    /**
     * Get list of all Projects
     *
     * @return array
     */
    public function projects(): array
    {
        return $this->transformCollection(
            $this->get('project'), Project::class
        );
    }

    /**
     * Get Project by ID
     *
     * @param string $projectID Id of the reforestation project for which you want to get the details
     * @return Project
     */
    public function project(string $projectID): Project
    {
        return new Project($this->get("project/{$projectID}"), $this);
    }
}
