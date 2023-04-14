<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\Api;
use Getsno\Relesys\Api\BatchResponse;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Entities\CustomField;

class CustomFields extends Api
{
    /**
     * @throws RelesysHttpClientException
     */
    public function getCustomFields(ApiQueryParams $queryParams = new ApiQueryParams(), int $page = 1): BatchResponse
    {
        $queryParams->offset($queryParams->getLimit() * ($page - 1));
        $params = $queryParams->toArray();

        $response = $this->httpClient->get('customfields/users', $params);

        $customFields = array_map(
            static fn(array $customField) => CustomField::fromArray($customField)->setSource($customField),
            $response['data']
        );

        return new BatchResponse(
            $response['count'],
            $customFields,
            $response['nextUrl'] ?? null,
            $response['previousUrl'] ?? null,
        );
    }
}
