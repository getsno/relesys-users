<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\Api;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Api\UserManagement\Entities\User;
use Getsno\Relesys\Api\UserManagement\Enums\UserStatus;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Entities\Patches\UserPatch;
use Getsno\Relesys\Api\UserManagement\Enums\PasswordResetLinkDeliveryMethod;

class Users extends Api
{
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
    public function getUsers(ApiQueryParams $queryParams = new ApiQueryParams(), int $page = 1): array
    {
        $queryParams->offset($queryParams->getLimit() * ($page - 1));
        $params = $queryParams->toArray();
        $responseData = $this->httpClient->get('users', $params);

        return array_map(
            static fn(array $user) => User::fromArray($user)->setSource($user),
            $responseData['data']
        );
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
                'resetLoginCode' => $resetLoginCode,
            ]
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function sendSms(string $userId, string $message): void
    {
        $this->httpClient->post("users/$userId/sms", ['message' => $message]);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function updateUser(string $userId, UserPatch $userPatch): User
    {
        $responseData = $this->httpClient->patch("users/$userId", $userPatch->getPatch())['data'];

        return User::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function changeUserStatus(string $userId, UserStatus $userStatus): void
    {
        $this->httpClient->put("users/$userId/status", ['status' => $userStatus->value]);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function deleteUser(string $userId): void
    {
        $this->httpClient->delete("users/$userId");
    }
}
