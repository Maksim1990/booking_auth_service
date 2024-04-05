<?php

declare(strict_types=1);

namespace Tests\Integration\Auth;

use Illuminate\Support\Facades\URL;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class BaseWebTestCase extends TestCase
{
    use RefreshDatabase;

    protected const string USER_INFO_ROUTE_NAME = 'auth.me';
    protected const string LOGIN_ROUTE_NAME = 'auth.login';
    protected const string LOGOUT_ROUTE_NAME = 'auth.logout';
    protected const string REFRESH_TOKEN_ROUTE_NAME = 'auth.refresh';

    protected function getResponseData(TestResponse $response): array
    {
        return json_decode($response->getContent(), true);
    }

    protected function getUrl(string $route): string
    {
        return URL::route($route);
    }
}
