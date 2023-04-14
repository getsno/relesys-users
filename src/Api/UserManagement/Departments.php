<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\Api;
use Getsno\Relesys\Api\BatchResponse;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Api\UserManagement\Entities\User;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Entities\Department;
use Getsno\Relesys\Api\UserManagement\Entities\Patches\DepartmentPatch;

class Departments extends Api
{
    /**
     * @throws RelesysHttpClientException
     */
    public function getDepartment(string $departmentId): Department
    {
        $responseData = $this->httpClient->get("departments/$departmentId")['data'];

        return Department::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function getDepartments(ApiQueryParams $queryParams = new ApiQueryParams(), int $page = 1): BatchResponse
    {
        $queryParams->offset($queryParams->getLimit() * ($page - 1));
        $params = $queryParams->toArray();

        $response = $this->httpClient->get('departments', $params);

        $departments = array_map(
            static fn(array $department) => Department::fromArray($department)->setSource($department),
            $response['data']
        );

        return new BatchResponse(
            $response['count'],
            $departments,
            $response['nextUrl'] ?? null,
            $response['previousUrl'] ?? null,
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function createDepartment(Department $department): Department
    {
        $responseData = $this->httpClient->post('departments', $department->toArray())['data'];

        return Department::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function updateDepartment(string $departmentId, DepartmentPatch $departmentPatch): Department
    {
        $responseData = $this->httpClient->patch(
            "departments/$departmentId",
            $departmentPatch->getPatch()
        )['data'];

        return Department::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function deleteDepartment(string $departmentId): void
    {
        $this->httpClient->delete("departments/$departmentId");
    }
}
