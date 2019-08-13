<?php

// Maverick Config
return [
    /**
     * Maverick.master_view
     * 
     * View to extend when creating pages
     */
    'master_view' => 'layouts.app',

    /**
     * Maverick.models
     * 
     * Models used to generate routes and views
     */
    'models' => [
        // User
    ],
    /**
     *  Maverick.column_relationships
     * 
     *  Define relationship ID's used in Models
     *  These ID's to improve the create/update forms
     *  
     *  Models defined here should have an ID and Name field in their table.
     */
    'column_relationships' => [
        // 'user_id' => App\User::class
    ],
    /**
     * Maverick.column_ordering
     * 
     * Array defining the correct way to order your Model Forms
     * Default is a 2 column input grid going down. Using a string in the array puts one input on that form line. 
     */
    'column_ordering' => [
        /* 'users' => [
            'name',
            'email',
            ['dealer_id', 'password']
        ], */
    ],
    /**
     * Maverick.column_override
     * 
     * Mostly use to turn strings fields into enums
     */
    'column_override' => [
        /*
        'users' => [
            'user_type' => [
                'type' => 'enum',
                'options' => [
                    'admin',
                    'dealer-employee',
                    'dealer-admin'
                ]
            ]
        ]*/
    ]
];
?>