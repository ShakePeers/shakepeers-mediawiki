<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use Mediawiki\Api\FluentRequest;
use Mediawiki\Api\MediawikiApi;

require_once __DIR__.'/vendor/autoload.php';

$app = new \Slim\App();
$app->get('/{num}', function (Request $request, Response $response, $args) {
    $api = MediawikiApi::newFromApiEndpoint('https://shakepeers.org/api.php');
    $request = FluentRequest::factory()->setAction('query')
        ->setParam('list', 'allpages')
        ->setParam('apfilterredir', 'nonredirects')
        ->setParam('aplimit', 500)
        ->setParam('apnamespace', 5000);
    $pages = $api->getRequest($request);
    $ids = [];
    foreach ($pages['query']['allpages'] as $key => $page) {
        $ids[$key] = $page['pageid'];
    }
    array_multisort($ids, SORT_ASC, $pages['query']['allpages']);

    return $response->withRedirect('index.php/'.rawurlencode($pages['query']['allpages'][$args['num']]['title']));
});
$app->run();
