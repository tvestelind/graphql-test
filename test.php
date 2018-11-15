<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

use Siler\Diactoros;
use Siler\Graphql;
use Siler\Http;
use Psr\Http\Message\ServerRequestInterface;

$typeDefs = file_get_contents(__DIR__.'/schema.graphql');
$schema = include __DIR__.'/schema.php';

echo "Server running at http://127.0.0.1:8080";

Http\server(
    function (ServerRequestInterface $request) use ($schema) {
        $body = json_decode((string) $request->getBody(), true);
        $user = $request->getQueryParams()['user'] ?? 'anon';
        $data = Graphql\execute($schema, $body, null, $user);

        return Diactoros\json($data);
    },
    function (Throwable $err) {
        error_log($err->getMessage());
        return Diactoros\json([
            'error'   => true,
            'message' => $err->getMessage(),
        ]);
    }
)()->run();
