<?php

declare(strict_types=1);

namespace Tests\Integration\Auth;

use App\Enums\ResponseStatus;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutEndpointTest extends BaseWebTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        User::factory()->create(['email' => 'test@test.com', 'password' => Hash::make('pass')]);
    }

    public function testUnauthorizedResponse(): void
    {
        $response = $this->post($this->getUrl(self::LOGOUT_ROUTE_NAME));

        $response->assertJson(['status' => ResponseStatus::UNAUTHORIZED->value, 'message' => 'Unauthenticated.']);
        $response->assertStatus(ResponseStatus::UNAUTHORIZED->value);
    }

    public function testSuccessResponse(): void
    {
        $response = $this->post($this->getUrl(self::LOGIN_ROUTE_NAME), ['email' => 'test@test.com', 'password' => 'pass']);
        $response = $this->post(
            $this->getUrl(self::LOGOUT_ROUTE_NAME),
            headers: ['Authorization' => sprintf('Bearer %s', $this->getResponseData($response)['access_token'])]
        );

        $response->assertStatus(ResponseStatus::HTTP_OK->value);
        $response->assertOk();
        $this->assertEquals('Successfully logged out.', $this->getResponseData($response)['message']);
    }
}
