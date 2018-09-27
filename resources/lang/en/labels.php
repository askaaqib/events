<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'All',
        'yes'     => 'Yes',
        'no'      => 'No',
        'copyright' => 'Copyright',
        'custom'  => 'Custom',
        'actions' => 'Actions',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'              => 'Hide',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create'              => 'Create User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',

                'table' => [
                    'confirmed'      => 'Confirmed',
                    'created'        => 'Created',
                    'email'          => 'E-mail',
                    'mobile'          => 'Mobile Number',
                    'id'             => 'ID',
                    'last_updated'   => 'Last Updated',
                    'name'           => 'Name',
                    'first_name'     => 'First Name',
                    'last_name'      => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted'     => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'roles'          => 'Roles',
                    'social' => 'Social',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmed',
                            'created_at'   => 'Created At',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'name'         => 'Name',
                            'first_name'   => 'First Name',
                            'last_name'    => 'Last Name',
                            'status'       => 'Status',
                            'timezone'     => 'Timezone',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],

        'venues' => [
            'header' => 'Venues Management',
            'create' => 'Add New Venue',
            'update' => 'Update Venue',
            'counts' => 'Venues total|Venue total',
            'view' => 'Venues',
            'capacity' => 'Capacity',
            'name' => 'Name',
            'days_of_work' => 'Days Of Work' ,
            'address' => 'Address',
            'active' => 'Active',
            'all_venues' => 'All Venues',
            'exclude_date' => 'Set Exclude Date',
        ],
        'excludeDates' => [
            'header' => 'Exclude Dates Management',
            'create' => 'Create Exclude Date',
            'update' => 'Update Exclude Date',
            'counts' => 'Exclude Dates total|Exclude Date total',
            'view' => 'excludeDates',
            'from_date' => 'From',
            'name' => 'Name',
            'venue_name' => 'Chose Venue',
            'to_date' => 'To' ,
            'address' => 'Address',
            'active' => 'Active',
            'all_excludeDates' => 'All excludeDates',
            'exclude_date' => 'Set Exclude Date',
        ],
        'riseCapacity' => [
            'header' => 'Rise Capacity Management',
            'create' => 'Create Rise Capacity',
            'update' => 'Update Rise Capacity',
            'counts' => 'Rise Capacity total|Rise Capacity total',
            'view' => 'excludeDates',
            'from_date' => 'From',
            'name' => 'Name',
            'venue_name' => 'Venue Name',
            'event_name' => 'Chose Event',
            'to_date' => 'To' ,
            'address' => 'Address',
            'active' => 'Active',
            'all_riseCapacity' => 'All Rise Capacity',
            'riseCapacity' => 'Set Rise Capacity',
            'capacity' => 'Rise Capacity to'
        ],
        'events' => [
            'header' => 'Events Management',
            'create' => 'Create Event',
            'update' => 'Update Event',
            'counts' => 'Event total|Events total',
            'view' => 'All Events',
            'venue_name' => 'Venue Name',
            'capacity' => 'Capacity',
            'name' => 'Name',
            'start_date' => 'Start Date' ,
            'end_date' => 'End Date',
            'active' => 'Active',
        ],
        'bookings' => [
            'header' => 'Bookings Management',
            'create' => 'Create Booking',
            'update' => 'Update Booking',
            'counts' => 'Booking total|Bookings total',
            'view' => 'Bookings',
            'venue_name' => 'Venue Name',
            'capacity' => 'Capacity',
            'name' => 'Name',
            'start_date' => 'Start Date' ,
            'end_date' => 'End Date',
            'active' => 'Active',
            'customer_name' => 'Customer Name',
            'event_name' => 'Event Name',
            'book_date' => 'Book Date',
            'studens_count' => 'Students Count',
            'gender' => 'Gender',
            'special_needs' => 'Special Needs',
            'need_food_meal' => 'Food Meal',
            'students_grade' => 'Students Grade',
            'file_upload' => 'Uploads',
            'studens_count' => 'Students Count',
            'status'        => 'Status',

        ]
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'Register',
            'remember_me'        => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password'                 => 'Forgot Your Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'update_password_button'           => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'email'              => 'E-mail',
                'last_updated'       => 'Last Updated',
                'name'               => 'Name',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],

        'reservation' => [
            'box_title' => 'Event Reservation',
            'button' => 'Submit'
        ]
    ],
];
