<?php

namespace Getsno\Relesys\Tests;

use Getsno\Relesys\Api\UserManagement\Entities\User;

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
        'data' => $user->toArray()
    ];
}
