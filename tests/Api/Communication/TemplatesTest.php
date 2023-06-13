<?php

namespace Getsno\Relesys\Tests\Api\Communication;

use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;
use Getsno\Relesys\Api\Communication\Communication;
use Getsno\Relesys\Api\Communication\Entities\Template;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;

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
    public function testSendMessage(): void
    {
        // $testUserGroupId = fake()->uuid;
        //
        // $this->mockFacadeIfTestingInIsolation(
        //     'userGroups',
        //     static function (MockInterface $mock) use ($testUserGroupId) {
        //         $mock->shouldReceive('get')
        //             ->once()
        //             ->with("userGroups/$testUserGroupId")
        //             ->andReturn(getUserGroupResponse($testUserGroupId));
        //     }
        // );
        //
        // $userGroup = Relesys::userGroups()->getUserGroup($testUserGroupId);
        //
        // $this->assertEquals($testUserGroupId, $userGroup->id);
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
