<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\Api;
use Getsno\Relesys\Api\BatchResponse;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Api\UserManagement\Entities\User;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Entities\UserGroup;
use Getsno\Relesys\Api\UserManagement\Entities\Patches\UserGroupPatch;

class UserGroups extends Api
{
    /**
     * @throws RelesysHttpClientException
     */
    public function getUserGroup(string $userGroupId): UserGroup
    {
        $responseData = $this->httpClient->get("userGroups/$userGroupId")['data'];

        return UserGroup::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function getUserGroups(ApiQueryParams $queryParams = new ApiQueryParams(), int $page = 1): BatchResponse
    {
        $queryParams->offset($queryParams->getLimit() * ($page - 1));
        $params = $queryParams->toArray();

        $response = $this->httpClient->get('userGroups', $params);

        $userGroups = array_map(
            static fn(array $userGroup) => UserGroup::fromArray($userGroup)->setSource($userGroup),
            $response['data']
        );

        return new BatchResponse(
            $response['count'],
            $userGroups,
            $response['nextUrl'] ?? null,
            $response['previousUrl'] ?? null,
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function createUserGroup(UserGroup $userGroup): UserGroup
    {
        $responseData = $this->httpClient->post('userGroups', $userGroup->toArray())['data'];

        return UserGroup::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function updateUserGroup(string $useGroupId, UserGroupPatch $userGroupPatch): UserGroup
    {
        $responseData = $this->httpClient->patch(
            "userGroups/$useGroupId",
            $userGroupPatch->getPatch()
        )['data'];

        return UserGroup::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function deleteUserGroup(string $userGroupId): void
    {
        $this->httpClient->delete("userGroups/$userGroupId");
    }
}
