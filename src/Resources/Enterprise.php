<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Resources;

use Carbon\Carbon;
use Exception;

class Enterprise extends Resource
{
    /**
     * Creation date of the enterprise in the RaaS database (ISO 8601 Date and Time format)
     *
     * @var string
     */
    public string $created;

    /**
     * Date of the last modification of the enterprise information (ISO 8601 Date and Time format)
     *
     * @var string
     */
    public string $updated;

    /**
     * Unique identifier of the enterprise
     *
     * @var string
     */
    public string $id;

    /**
     * Name of the enterprise
     *
     * @var string
     */
    public string $name;

    /**
     * Name and email of the contact in the enterprise
     *
     * @var array
     */
    public array $contact;

    /**
     * Retrieve the number of trees planted by an enterprise for any range of date.
     *
     * @param Carbon|null $startDate
     * @param Carbon|null $endDate
     * @return int
     * @throws Exception
     */
    public function treeCount(Carbon $startDate = null, Carbon $endDate = null): int
    {
        return $this->digitalHumani->treeCount(
            $startDate,
            $endDate,
            $this->id,
        );
    }

    /**
     * Retrieve the number of trees planted by an enterprise for a specific month
     *
     * @param Carbon|null $month
     * @return int
     * @throws Exception
     */
    public function treeCountForMonth(Carbon $month = null): int
    {
        return $this->digitalHumani->treeCountForMonth(
            $month,
            $this->id,
        );
    }

    /**
     * Plant one or many trees
     *
     * @param string $user End user by whom the trees were planted. Example of an user: email@test.com
     * @param int $amount Number of trees requested to plant. Example: 1
     * @param string|null $projectId Id of the reforestation project for where you want the trees to be planted.
     * Example of an id: 93333333 (Project Ids are 8 digits long)
     * @return mixed
     * @throws Exception
     */
    public function plantTree(string $user, int $amount = 1, string $projectId = null): Tree
    {
        return $this->digitalHumani->plantTree(
            $user,
            $amount,
            $projectId,
            $this->id
        );
    }
}
