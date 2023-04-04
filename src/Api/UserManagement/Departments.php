<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\Api;
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
    public function getDepartments(): array
    {
        $responseData = $this->httpClient->get('departments')['data'];

        return array_map(
            static fn(array $department) => Department::fromArray($department)->setSource($department),
            $responseData
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
