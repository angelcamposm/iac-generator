<?php

return [
    /*
     | ------------------------------------------------------------------------
     | Default values
     | ------------------------------------------------------------------------
     | Default value of options in the resources to be created.
     |
     */
    'defaults' => [
        'kubernetes' => [
            'resources' => [
                'service' => [

                ]
            ]
        ],
        'openshift' => [
            'resources' => [
                'routes' => [

                ]
            ]
        ]
    ],
];
