<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\Api;
use Getsno\Relesys\Api\UserManagement\Entities\User;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;

class Users extends Api
{
    /**
     * @throws RelesysHttpClientException
     */
    public function getUsers(): array
    {
        $response = $this->httpClient->get('users')['data'];

        return array_map(
            static fn(array $userData) => User::fromArray($userData)->setOriginalResponse($userData),
            $response
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function getUser(string $userId): User
    {
        $response = $this->httpClient->get("users/$userId");

        return User::fromArray($response['data'])->setOriginalResponse($response);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function createUser(User $user): User
    {
        $response = $this->httpClient->post('users', $user->toArray());

        return User::fromArray($response['data'])->setOriginalResponse($response);
    }
}
