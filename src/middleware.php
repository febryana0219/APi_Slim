<?php

use Slim\App;

return function (App $app) {
    // e.g: $app->add(new \Slim\Csrf\Guard);

    //middleware untuk validasi token JWT 
    $app->add(new Slim\Middleware\JwtAuthentication([
        "path" => "/api", /* or ["/api", "/admin"] */
        "secure" => false,
        "attribute" => "decoded_token_data",
        "secret" => "supersecretkeyyoushouldnotcommittogithub",
        "algorithm" => ["HS256"],
        "error" => function ($req, $res, $args) {
        $data["status"] = "error";
        $data["message"] = $args["message"];
        return $res
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
        ]));
};
