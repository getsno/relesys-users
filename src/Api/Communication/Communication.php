<?php

namespace Getsno\Relesys\Api\Communication;

use Getsno\Relesys\Api\Api;
use Getsno\Relesys\Api\BatchResponse;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Api\Communication\Entities\Template;
use Getsno\Relesys\Api\Communication\Enums\MessageType;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\Communication\Enums\DeliveryMethod;
use Getsno\Relesys\Api\Communication\ValueObjects\MessageBody;

class Communication extends Api
{
    /**
     * @throws RelesysHttpClientException
     */
    public function sendMessage(
        string $userId,
        DeliveryMethod $deliveryMethod,
        ?string $communicationTemplateId = null,
        ?MessageType $messageType = null,
        ?MessageBody $messageBody = null,
    ): void
    {
        $params = [
            'deliveryMethod' => $deliveryMethod->value,
        ];

        if ($communicationTemplateId !== null) {
            $params['communicationTemplateId'] = $communicationTemplateId;
        } elseif ($messageType !== null) {
            $params['messageType'] = $messageType->value;
        } else {
            $params['messageBody'] = $messageBody;
        }

        $this->httpClient->post("communication/messages/$userId/send", $params);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function getTemplate(string $templateId): Template
    {
        $responseData = $this->httpClient->get("communication/templates/$templateId")['data'];

        return Template::fromArray($responseData)->setSource($responseData);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function getTemplates(ApiQueryParams $queryParams = new ApiQueryParams(), int $page = 1): BatchResponse
    {
        $queryParams->offset($queryParams->getLimit() * ($page - 1));
        $params = $queryParams->toArray();

        $response = $this->httpClient->get('communication/templates', $params);

        $users = array_map(
            static fn(array $template) => Template::fromArray($template)->setSource($template),
            $response['data']
        );

        return new BatchResponse(
            $response['count'],
            $users,
            $response['nextUrl'] ?? null,
            $response['previousUrl'] ?? null,
        );
    }
}
