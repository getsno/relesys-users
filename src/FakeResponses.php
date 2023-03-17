<?php

namespace Getsno\Relesys\FakeResponses;

function getUserResponse(string $id): array
{
    return [
        'data' => [
            'id'                    => $id,
            'url'                   => 'https://api.relesysapp.net/api/v1.1/users/$id',
            'departmentUrl'         => 'https://api.relesysapp.net/api/v1.1/departments/841d1373-d8f9-4dc5-84cf-96a8659222d3',
            'status'                => 'Activated',
            'creationDateTime'      => '2023-03-15T11:52:07.75Z',
            'lastModifiedDateTime'  => '2023-03-15T17:20:14.623Z',
            'externalId'            => null,
            'name'                  => fake()->name(),
            'userName'              => null,
            'title'                 => 'Butikksjef',
            'dataSource'            => null,
            'email'                 => fake()->email(),
            'secondaryEmail'        => null,
            'phoneNumber'           => [
                'countryCode' => 47,
                'number'      => '46621166',
            ],
            'secondaryPhoneNumber'  => [
                'countryCode' => null,
                'number'      => null,
            ],
            'birthDate'             => null,
            'primaryDepartmentId'   => '841d1373-d8f9-4dc5-84cf-96a8659222d3',
            'additionalDepartments' => [
            ],
            'userGroups'            => [
                [
                    'id'         => 'e7cc6092-d6af-4cb6-9ad4-4b3ceab1e8cc',
                    'dataSource' => null,
                ],
                [
                    'id'         => '44c5d010-98fc-4378-99ec-3d2c3caec8e7',
                    'dataSource' => null,
                ],
                [
                    'id'         => '1704d198-1d05-4bbd-a21e-ac0b8df51f78',
                    'dataSource' => null,
                ],
            ],
            'employmentDate'        => null,
            'employmentEndDate'     => null,
        ],
    ];
}
