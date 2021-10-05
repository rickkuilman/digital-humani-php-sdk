<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Resources;

use Carbon\Carbon;

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
     */
    public function treeCount(Carbon $startDate = null, Carbon $endDate = null): int
    {
        return $this->digitalHumani->treeCount(
            $this->id,
            $startDate,
            $endDate,
        );
    }

    /**
     * Retrieve the number of trees planted by an enterprise for a specific month
     *
     * @param Carbon|null $month
     * @return int
     */
    public function treeCountForMonth(Carbon $month = null): int
    {
        return $this->digitalHumani->treeCountForMonth(
            $this->id,
            $month,
        );
    }

}
