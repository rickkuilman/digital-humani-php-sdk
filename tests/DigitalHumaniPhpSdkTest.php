<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase;
use Rickkuilman\DigitalHumaniPhpSdk\DigitalHumani;
use Rickkuilman\DigitalHumaniPhpSdk\Exceptions\BadRequestException;
use Rickkuilman\DigitalHumaniPhpSdk\Exceptions\ForbiddenException;
use Rickkuilman\DigitalHumaniPhpSdk\Exceptions\NotFoundException;
use Rickkuilman\DigitalHumaniPhpSdk\Exceptions\UnauthorizedException;

class DigitalHumaniPhpSdkTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function test_making_basic_requests()
    {
        $digitalHumani = new DigitalHumani('abc', '4c6e672d', false, $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')
            ->once()
            ->with('GET', 'project', [])
            ->andReturn(
                new Response(200, [], '[{"reforestationCompanyName_en": "OneTreePlanted"}]')
            );

        $this->assertCount(1, $digitalHumani->projects());
    }

    public function test_handling_404_errors()
    {
        $this->expectException(NotFoundException::class);

        $digitalHumani = new DigitalHumani('abc', '4c6e672d', false, $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')
            ->once()
            ->with('GET', 'project', [])
            ->andReturn(
                new Response(404)
            );

        $digitalHumani->projects();
    }

    public function test_handling_401_errors()
    {
        $this->expectException(UnauthorizedException::class);

        $digitalHumani = new DigitalHumani('abc', '4c6e672d', false, $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')
            ->once()
            ->with('GET', 'project', [])
            ->andReturn(
                new Response(401)
            );

        $digitalHumani->projects();
    }

    public function test_handling_403_errors()
    {
        $this->expectException(ForbiddenException::class);

        $digitalHumani = new DigitalHumani('abc', '4c6e672d', false, $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')
            ->once()
            ->with('GET', 'project', [])
            ->andReturn(
                new Response(403)
            );

        $digitalHumani->projects();
    }

    public function test_handling_400_errors()
    {
        $this->expectException(BadRequestException::class);

        $digitalHumani = new DigitalHumani('abc', '4c6e672d', false, $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')
            ->once()
            ->with('POST', 'tree', [
                'json' => [
                    'enterpriseId' => '4c6e672d',
                    'user' => 'rick@example.com',
                    'treeCount' => 1,
                    'projectId' => DigitalHumani::DEFAULT_PROJECT_ID,
                ],
            ])
            ->andReturn(
                new Response(400)
            );

        $digitalHumani->plantTree('rick@example.com');
    }

}
