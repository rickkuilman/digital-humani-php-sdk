<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Actions;

use Exception;
use Rickkuilman\DigitalHumaniPhpSdk\Resources\Tree;

trait ManagesTrees
{
    /**
     * Plant one or many trees
     *
     * @param string $user End user by whom the trees were planted. Example of an user: email@test.com
     * @param int $amount Number of trees requested to plant. Example: 1
     * @param string|null $projectId Id of the reforestation project for where you want the trees to be planted.
     * Example of an id: 93333333 (Project Ids are 8 digits long)
     * @param string|null $enterpriseId Id of your enterprise. Example of an enterprise id: 11111111 (Enterprise
     * Ids are 8 digits long)
     * @return Tree
     * @throws Exception
     */
    public function plantTree(string $user, int $amount = 1, string $projectId = null, string $enterpriseId = null): Tree
    {
        if (is_null($projectId)) {
            $projectId = $this->defaultProjectId();
        }

        return new Tree($this->post('tree', [
            'enterpriseId' => $enterpriseId ?? $this->getDefaultEnterpriseId(),
            'user' => $user,
            'treeCount' => $amount,
            'projectId' => (string)$projectId,
        ]), $this);
    }

    /**
     * Get details of a single request to plant one or many trees
     *
     * @param string $uuid uuid of the trees for which you want to get the details.
     * @return Tree
     * @throws Exception
     */
    public function tree(string $uuid): Tree
    {
        return new Tree($this->get("tree/{$uuid}"), $this);
    }

    /**
     * Count trees for a user
     *
     * @param string $user End user by whom the trees were planted. Example of an user: email@test.com
     * @param string|null $enterpriseId Id of your enterprise. Example of an enterprise id: 11111111 (Enterprise
     * Ids are 8 digits long)
     * @return array
     * @throws Exception
     */
    public function countTreesPlantedByUser(string $user, string $enterpriseId = null): array
    {
        return $this->get(sprintf("tree?enterpriseId=%s&user=%s",
            $enterpriseId ?? $this->getDefaultEnterpriseId(),
            $user
        ));
    }
}
