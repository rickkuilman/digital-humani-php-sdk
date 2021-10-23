<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Actions;

use Carbon\Carbon;
use Exception;
use Rickkuilman\DigitalHumaniPhpSdk\Resources\Enterprise;

trait ManagesEnterprises
{
    /**
     * Get Enterprise by ID
     *
     * @param string|null $enterpriseId Id of the enterprise for which you want to get the details.
     * @return Enterprise
     * @throws Exception
     */
    public function enterprise(string $enterpriseId = null): Enterprise
    {
        return new Enterprise($this->get(sprintf("enterprise/%s",
            $enterpriseId ?? $this->getDefaultEnterpriseId()
        )), $this);
    }

    /**
     * Count trees for an enterprise for any range of date
     *
     * @param Carbon|null $startDate Start Date of the range to specify
     * @param Carbon|null $endDate End Date of the range to specify
     * @param string|null $enterpriseId Id of your enterprise.
     * @return int
     * @throws Exception
     */
    public function treeCount(Carbon $startDate = null, Carbon $endDate = null, string $enterpriseId = null): int
    {

        if (is_null($startDate)) {
            $startDate = Carbon::createFromTimestamp(0);
        }

        if (is_null($endDate)) {
            $endDate = Carbon::today();
        }

        return $this->get(sprintf("enterprise/%s/treeCount?startDate=%s&endDate=%s",
            $enterpriseId ?? $this->getDefaultEnterpriseId(),
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d')
        ))['count'];
    }

    /**
     * Count trees for an enterprise by month
     *
     * @param Carbon|null $month Month for which you want to count the number of trees planted.
     * @param string|null $enterpriseId Id of your enterprise.
     * @return int
     * @throws Exception
     */
    public function treeCountForMonth(Carbon $month = null, string $enterpriseId = null): int
    {
        if (is_null($month)) {
            $month = today();
        }

        return $this->get(sprintf("enterprise/%s/treeCount/%s",
            $enterpriseId ?? $this->getDefaultEnterpriseId(),
            $month->format('Y-m')
        ))['count'];
    }
}
