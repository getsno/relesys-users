<?php

namespace Getsno\Relesys\Tests\Api\Communication;

use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;
use Getsno\Relesys\Api\Communication\Communication;
use Getsno\Relesys\Api\Communication\Entities\Template;
use Getsno\Relesys\Api\Communication\Enums\MessageType;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\Communication\Enums\DeliveryMethod;
use Getsno\Relesys\Api\Communication\ValueObjects\MessageBody;

use function Getsno\Relesys\Tests\getCommunicationTemplateResponse;
use function Getsno\Relesys\Tests\getCommunicationTemplatesResponse;

class TemplatesTest extends TestCase
{
    public function testTemplatesFacade(): void
    {
        $this->mockFacadeIfTestingInIsolation('communication');

        $this->assertInstanceOf(Communication::class, Relesys::communication());
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testSendMessageByTemplateId(): void
    {
        $testUserId = fake()->uuid;
        $testTemplateId = fake()->uuid;

        $this->mockFacadeIfTestingInIsolation(
            'communication',
            static function (MockInterface $mock) use ($testUserId) {
                $mock->shouldReceive('post')
                    ->once()
                    ->withArgs(
                        static fn(string $path, array $params) => $path === "communication/messages/$testUserId/send"
                    );
            }
        );

        Relesys::communication()->sendMessage($testUserId, DeliveryMethod::Both, $testTemplateId);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testSendMessageByType(): void
    {
        $testUserId = fake()->uuid;

        $this->mockFacadeIfTestingInIsolation(
            'communication',
            static function (MockInterface $mock) use ($testUserId) {
                $mock->shouldReceive('post')
                    ->once()
                    ->withArgs(
                        static fn(string $path, array $params) => $path === "communication/messages/$testUserId/send"
                    );
            }
        );

        Relesys::communication()->sendMessage(
            $testUserId,
            DeliveryMethod::Both,
            MessageType::Welcome->value
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testSendCustomMessage(): void
    {
        $testUserId = fake()->uuid;

        $this->mockFacadeIfTestingInIsolation(
            'communication',
            static function (MockInterface $mock) use ($testUserId) {
                $mock->shouldReceive('post')
                    ->once()
                    ->withArgs(
                        static fn(string $path, array $params) => $path === "communication/messages/$testUserId/send"
                    );
            }
        );

        Relesys::communication()->sendMessage(
            $testUserId,
            DeliveryMethod::Both,
            messageBody: MessageBody::fromArray([
                'email' => [
                    'subject' => 'test',
                    'body'    => 'Test email message',
                ],
                'sms'   => [
                    'body' => 'test sms message',
                ],
            ])
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetTemplate(): void
    {
        $testTemplateId = fake()->uuid;

        $this->mockFacadeIfTestingInIsolation(
            'communication',
            static function (MockInterface $mock) use ($testTemplateId) {
                $mock->shouldReceive('get')
                    ->once()
                    ->with("communication/templates/$testTemplateId")
                    ->andReturn(getCommunicationTemplateResponse($testTemplateId));
            }
        );

        $template = Relesys::communication()->getTemplate($testTemplateId);

        $this->assertEquals($testTemplateId, $template->id);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetTemplates(): void
    {
        $this->mockFacadeIfTestingInIsolation('communication', function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->once()
                ->withArgs(static fn(string $path, array $params) => $path === 'communication/templates')
                ->andReturn(getCommunicationTemplatesResponse(3));
        });

        $queryParams = (new ApiQueryParams)
            ->sortBy('name')
            ->limit(5);
        $response = Relesys::communication()->getTemplates($queryParams);

        $this->assertIsInt($response->count);
        $this->assertContainsOnlyInstancesOf(Template::class, $response->data);
    }
}
