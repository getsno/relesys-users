<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\Api;
use Getsno\Relesys\Api\UserManagement\Entities\User;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Enums\PasswordResetLinkDeliveryMethod;

class Users extends Api
{
    /**
     * @throws RelesysHttpClientException
     */
    public function getUsers(): array
    {
        $responseData = $this->httpClient->get('users')['data'];

        return array_map(
            static fn(array $user) => User::fromArray($user)->setSource($user),
            $responseData
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function getUser(string $userId): User
    {
        $responseData = $this->httpClient->get("users/$userId")['data'];

        return User::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function createUser(User $user): User
    {
        $responseData = $this->httpClient->post('users', $user->toArray())['data'];

        return User::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function sendPasswordResetLink(
        string $userId,
        PasswordResetLinkDeliveryMethod $deliveryMethod = PasswordResetLinkDeliveryMethod::PHONE,
        bool $resetLoginCode = false
    ): void
    {
        $this->httpClient->post(
            "users/$userId/passwordresetlink",
            [
                'deliveryMethod' => $deliveryMethod->value,
                'resetLoginCode' => $resetLoginCode
            ]
        );
    }
}
