<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Auth Service API",
 *      description="L5 Swagger OpenApi description"
 * )
 * @OA\Server(
 *      url="/api/v1",
 *  ),
 * @OA\SecurityScheme(
 *       securityScheme="bearerAuth",
 *       in="header",
 *       name="bearerAuth",
 *       type="http",
 *       scheme="bearer",
 *       bearerFormat="JWT",
 *  )
 */
abstract class Controller
{
}
