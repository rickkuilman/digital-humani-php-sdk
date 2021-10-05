<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Resources;

class Tree extends Resource
{

    /**
     * @var string Universally Unique Identifier generated (string)
     */
    public string $uuid;

    /**
     * @var string Creation date of the trees in the RaaS database (ISO 8601 Date and Time format)
     */
    public string $created;

    /**
     * @var string Number of trees requested to plant (integer)
     */
    public string $treeCount;

    /**
     * @var string Identifier of the enterprise (string)
     */
    public string $enterpriseId;

    /**
     * @var string Identifier of the project (string)
     */
    public string $projectId;

    /**
     * @var string End user by whom the trees were planted (string)
     */
    public string $user;
}
