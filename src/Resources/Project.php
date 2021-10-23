<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Resources;

use Exception;

class Project extends Resource
{
    /**
     * Creation date of the project in the RaaS database (ISO 8601 Date and Time format)
     *
     * @var string
     */
    public string $created;

    /**
     * Date of the last modification of the project information (ISO 8601 Date and Time format)
     *
     * @var string
     */
    public string $updated;

    /**
     * Unique identifier of the project
     *
     * @var string
     */
    public string $id;

    /**
     * Short name of the project, in English (deprecated)
     *
     * @var string
     */
    public string $name;

    /**
     * Short Description of the project, in English (deprecated)
     *
     * @var string
     */
    public string $description;

    /**
     * Name of the reforestation company in English
     *
     * @var string
     */
    public string $reforestationCompanyNameEn;

    /**
     * Name of the reforestation company in French
     *
     * @var string
     */
    public string $reforestationCompanyNameFr;

    /**
     * Physical address of the reforestation company in English
     *
     * @var string
     */
    public string $reforestationCompanyAddressEn;

    /**
     * Physical address of the reforestation company in French
     *
     * @var string
     */
    public string $reforestationCompanyAddressFr;

    /**
     * Website address of the reforestation company in English
     *
     * @var string
     */
    public string $reforestationCompanyWebsiteEn;

    /**
     * Website address of the reforestation company in French
     *
     * @var string
     */
    public string $reforestationCompanyWebsiteFr;

    /**
     * Country of the reforestation project in English
     *
     * @var string
     */
    public string $reforestationProjectCountryEn;

    /**
     * Country of the reforestation project in French
     *
     * @var string
     */
    public string $reforestationProjectCountryFr;

    /**
     * Description of the reforestation project in English
     *
     * @var string
     */
    public string $reforestationProjectDescriptionEn;

    /**
     * Description of the reforestation project in French
     *
     * @var string
     */
    public string $reforestationProjectDescriptionFr;

    /**
     * Image URL of the reforestation project (in English when applicable)
     *
     * @var string
     */
    public string $reforestationProjectImageURLEn;

    /**
     * Image URL of the reforestation project (in French when applicable)
     *
     * @var string
     */
    public string $reforestationProjectImageURLFr;

    /**
     * State or province where the reforestation project is located in English
     *
     * @var string
     */
    public string $reforestationProjectStateEn;

    /**
     * State or province where the reforestation project is located in French
     *
     * @var string
     */
    public string $reforestationProjectStateFr;

    /**
     * Website address of the reforestation project in English
     *
     * @var string
     */
    public string $reforestationProjectWebsiteEn;

    /**
     * Website address of the reforestation project in French
     *
     * @var string
     */
    public string $reforestationProjectWebsiteFr;

    /**
     * Location of the reforestation project in English
     *
     * @var string
     */
    public string $locationEn;

    /**
     * Plant one or many trees
     *
     * @param string $user End user by whom the trees were planted. Example of an user: email@test.com
     * @param int $amount Number of trees requested to plant. Example: 1
     * @param string|null $enterpriseId Id of your enterprise. Example of an enterprise id: 11111111 (Enterprise
     * Ids are 8 digits long)
     * @return mixed
     * @throws Exception
     */
    public function plantTree(string $user, int $amount = 1, string $enterpriseId = null): Tree
    {
        return $this->digitalHumani->plantTree(
            $user,
            $amount,
            $this->id,
            $enterpriseId
        );
    }

}
