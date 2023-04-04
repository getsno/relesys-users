<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\Api;
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
    public function getUserGroups(): array
    {
        $responseData = $this->httpClient->get('userGroups')['data'];

        return array_map(
            static fn(array $userGroup) => UserGroup::fromArray($userGroup)->setSource($userGroup),
            $responseData
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
