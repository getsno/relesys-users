<?php

namespace Getsno\Relesys\Tests;

use Getsno\Relesys\Api\UserManagement\Entities\User;
use Getsno\Relesys\Api\UserManagement\Entities\UserGroup;
use Getsno\Relesys\Api\UserManagement\Entities\Department;

/**
 * Users
 */
function getUserResponse(string $id): array
{
    return [
        'data' => [
            'id'                    => $id,
            'url'                   => "https://api.relesysapp.net/api/v1.1/users/$id",
            'departmentUrl'         => 'https://api.relesysapp.net/api/v1.1/departments/' . fake()->uuid,
            'status'                => 'Activated',
            'creationDateTime'      => '2023-03-15T11:52:07.75Z',
            'lastModifiedDateTime'  => '2023-03-15T17:20:14.623Z',
            'externalId'            => fake()->uuid,
            'name'                  => fake()->name,
            'userName'              => null,
            'title'                 => fake()->word,
            'dataSource'            => null,
            'email'                 => fake()->email,
            'secondaryEmail'        => null,
            'phoneNumber'           => [
                'countryCode' => 47,
                'number'      => '11111111',
            ],
            'secondaryPhoneNumber'  => null,
            'birthDate'             => fake()->date,
            'primaryDepartmentId'   => fake()->uuid,
            'additionalDepartments' => [
                [
                    'id'         => fake()->uuid,
                    'dataSource' => 'RelesysAPI',
                ],
            ],
            'userGroups'            => [
                [
                    'id'         => fake()->uuid,
                    'dataSource' => null,
                ],
                [
                    'id'         => fake()->uuid,
                    'dataSource' => null,
                ],
                [
                    'id'         => fake()->uuid,
                    'dataSource' => null,
                ],
            ],
            'employmentDate'        => fake()->date,
            'employmentEndDate'     => null,
        ],
    ];
}

function getUsersResponse(int $amount): array
{
    $users = [
        'count' => $amount,
        'data'  => [],
    ];

    while (count($users['data']) < $amount) {
        $currentIteration = count($users['data']) + 1;
        $users['data'][] = [...getUserResponse($currentIteration)['data']];
    }

    return $users;
}

function createUserResponse(User $user): array
{
    return [
        'data' => $user->toArray(),
    ];
}

/** Departments */
function getDepartmentResponse(string $id): array
{
    return [
        'data' => [
            'id'                       => $id,
            'url'                      => "https://api.relesysapp.net/api/v1.1/departments/$id",
            'creationDateTime'         => '2023-01-09T08:14:44.397Z',
            'lastModifiedDateTime'     => '2023-02-14T10:04:11.95Z',
            'name'                     => 'Test department',
            'parentId'                 => fake()->uuid,
            'externalId'               => null,
            'addressLine'              => null,
            'addressLine2'             => null,
            'zipCode'                  => null,
            'city'                     => null,
            'defaultPhoneCountryCode'  => 47,
            'phoneNumber'              => [
                'countryCode' => null,
                'number'      => null,
            ],
            'managerUserId'            => null,
            'showInContacts'           => true,
            'showInHighscores'         => true,
            'showInActivityStatistics' => true,
            'contentCulture'           => null,
            'uiCulture'                => null,
            'type'                     => 'Division',
            'timeZone'                 => null,
        ],
    ];
}

function getDepartmentsResponse(int $amount): array
{
    $users = [
        'count' => $amount,
        'data'  => [],
    ];

    while (count($users['data']) < $amount) {
        $currentIteration = count($users['data']) + 1;
        $users['data'][] = [...getDepartmentResponse($currentIteration)['data']];
    }

    return $users;
}

function createDepartmentResponse(Department $department): array
{
    return [
        'data' => $department->toArray(),
    ];
}

/**
 * UserGroups
 */
function getUserGroupResponse(string $id): array
{
    return [
        'data' => [
            'id'                   => $id,
            'url'                  => null,
            'creationDateTime'     => '1991-12-25T13:14:35Z',
            'lastModifiedDateTime' => '2018-06-09T04:58:45Z',
            'name'                 => 'User Group A',
            'externalId'           => 'UGA',
            'description'          => 'Description for User Group A',
        ],
    ];
}

function getUserGroupsResponse(int $amount): array
{
    $users = [
        'count' => $amount,
        'data'  => [],
    ];

    while (count($users['data']) < $amount) {
        $currentIteration = count($users['data']) + 1;
        $users['data'][] = [...getUserGroupResponse($currentIteration)['data']];
    }

    return $users;
}

function createUserGroupResponse(UserGroup $userGroup): array
{
    return [
        'data' => $userGroup->toArray(),
    ];
}

/**
 * CustomFields
 */
function getCustomFieldsResponse(int $amount): array
{
    $customFields = [
        'count' => $amount,
        'data'  => [],
    ];

    $customFieldResponse = [
        'data' => [
            'id'         => fake()->uuid,
            'externalId' => fake()->word,
            'name'       => fake()->word,
            'type'       => 'MultilineText',
        ],
    ];

    while (count($customFields['data']) < $amount) {
        $customFields['data'][] = $customFieldResponse['data'];
    }

    return $customFields;
}

/**
 * Communication
 */
function getCommunicationTemplateResponse(string $id): array
{
    return [
        'data' => [
            'id'                            => fake()->uuid,
            'name'                          => fake()->word,
            'communicationTemplateCultures' => [
                [
                    'cultureCode' => 'en-GB',
                    'sms'         => [
                        'body' => 'Hi #name#!',
                    ],
                    'email'       => [
                        'subject' => 'Welcome',
                        'body'    => '<p>Hi #name#</p>',
                    ],
                ],
                [
                    'cultureCode' => 'nb-NO',
                    'sms'         => [
                        'body' => 'Hei, #name#!',
                    ],
                    'email'       => [
                        'subject' => 'Velkommen',
                        'body'    => 'Hei, #name#!',
                    ],
                ],
            ],
            'creationDateTime'              => fake()->date,
            'lastModifiedDateTime'          => null,
        ],
    ];
}

function getCommunicationTemplatesResponse(int $amount): array
{
    $templates = [
        'count' => $amount,
        'data'  => [],
    ];

    while (count($templates['data']) < $amount) {
        $currentIteration = count($templates['data']) + 1;
        $templates['data'][] = [...getCommunicationTemplateResponse($currentIteration)['data']];
    }

    return $templates;
}
