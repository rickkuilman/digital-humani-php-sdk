<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Production mode
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will make the Digital Humani SDK
    | use the production URL of Digital Humani. While testing
    | it's recommended to set this value to false.
    |
    */

    'use_production' => env('DIGITAL_HUMANI_PRODUCTION_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Default project
    |--------------------------------------------------------------------------
    |
    | By default, when no project ID is set when planting a tree, the
    | project with ID "14442771" will be used. The location of this
    | plant is "where they are needed most".
    |
    | See: https://digitalhumani.com/docs/#appendixlist-of-projects
    |
    */

    'default_project' => '14442771',

];
