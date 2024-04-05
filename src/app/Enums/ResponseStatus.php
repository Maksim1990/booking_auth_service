<?php

declare(strict_types=1);

namespace App\Enums;

use Symfony\Component\HttpFoundation\Response;

enum ResponseStatus: int
{
    case HTTP_OK = Response::HTTP_OK;
    case UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;
    case NOT_FOUND = Response::HTTP_NOT_FOUND;
    case HTTP_BAD_REQUEST = Response::HTTP_BAD_REQUEST;
    case HTTP_INTERNAL_SERVER_ERROR = Response::HTTP_INTERNAL_SERVER_ERROR;
}
