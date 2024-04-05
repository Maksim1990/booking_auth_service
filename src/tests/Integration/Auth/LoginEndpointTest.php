<?php

declare(strict_types=1);

namespace Tests\Integration\Auth;

use App\Enums\ResponseStatus;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginEndpointTest extends BaseWebTestCase
{
    use RefreshDatabase;
    private const array PAYLOAD = ['email' => 'test@test.com', 'password' => 'pass'];

    public function setUp(): void
    {
        parent::setUp();

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@test.com',
            'password' => Hash::make('pass'),
        ]);
    }

    public function testUnauthorizedResponse(): void
    {
        $response = $this->post(
            $this->getUrl(self::LOGIN_ROUTE_NAME),
            ['email' => 'email@test.com', 'password' => 'password']
        );

        $response->assertJson(['status' => ResponseStatus::UNAUTHORIZED->value, 'message' => 'Unauthenticated.']);
        $response->assertStatus(ResponseStatus::UNAUTHORIZED->value);
    }

    public function testValidationResponse(): void
    {
        $response = $this->post($this->getUrl(self::LOGIN_ROUTE_NAME), ['email' => '', 'password' => 'pass']);

        $response->assertJson(
            ['status' => ResponseStatus::HTTP_BAD_REQUEST->value, 'message' => 'The email field is required.']
        );
        $response->assertStatus(ResponseStatus::HTTP_BAD_REQUEST->value);
    }

    public function testSuccessResponse(): void
    {
        $response = $this->post($this->getUrl(self::LOGIN_ROUTE_NAME), self::PAYLOAD);

        $responseContent = $this->getResponseData($response);
        $this->assertArrayHasKey('access_token', $responseContent);
        $this->assertEquals('bearer', $responseContent['token_type']);
        $this->assertEquals(3600, $responseContent['expires_in']);
        $response->assertOk();
    }
}
