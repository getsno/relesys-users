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
        return array_map(
            static fn(array $user) => User::fromArray($user),
            $this->httpClient->get('users')['data']
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function getUser(string $userId): User
    {
        $user = $this->httpClient->get("users/$userId");

        return User::fromArray($user['data']);
    }
}
