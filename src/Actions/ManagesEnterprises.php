<?php

namespace Rickkuilman\DigitalHumaniSdk\Actions;

use Carbon\Carbon;
use Rickkuilman\DigitalHumaniSdk\Resources\Enterprise;

trait ManagesEnterprises
{
    /**
     * Get Enterprise by ID
     *
     * @param string $enterpriseId Id of the enterprise for which you want to get the details.
     * @return Enterprise
     */
    public function enterprise(string $enterpriseId): Enterprise
    {
        return new Enterprise($this->get("enterprise/{$enterpriseId}"), $this);
    }

    /**
     * Count trees for an enterprise for any range of date
     *
     * @param string $enterpriseId Id of your enterprise.
     * @param Carbon|null $startDate Start Date of the range to specify
     * @param Carbon|null $endDate End Date of the range to specify
     * @return int
     */
    public function treeCount(string $enterpriseId, Carbon $startDate = null, Carbon $endDate = null): int
    {

        if (is_null($startDate)) {
            $startDate = Carbon::createFromTimestamp(0);
        }

        if (is_null($endDate)) {
            $endDate = Carbon::today();
        }

        return $this->get(sprintf("enterprise/%s/treeCount?startDate=%s&endDate=%s",
            $enterpriseId,
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d')
        ))['count'];
    }

    /**
     * Count trees for an enterprise by month
     *
     * @param string $enterpriseId Id of your enterprise.
     * @param Carbon|null $month Month for which you want to count the number of trees planted.
     * @return int
     */
    public function treeCountForMonth(string $enterpriseId, Carbon $month = null): int
    {
        if (is_null($month)) {
            $month = today();
        }

        return $this->get(sprintf("enterprise/%s/treeCount/%s",
            $enterpriseId,
            $month->format('Y-m')
        ))['count'];
    }
}
