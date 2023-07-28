<?php

/**
 * Image rendener and tracker handler
 */

require __DIR__ . '/../app/vendor/autoload.php';

use App\DatabaseTracker;
use App\ImageRendererHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// create instance of Image Renderer Handler and assign Database Tracker
$handler = new ImageRendererHandler(
    new DatabaseTracker()
);

// initialize Symfony Request object
$request = Request::createFromGlobals();

// handle image rendering and tracking
try {
    return $handler->renderImage(
        $request->get('id', 1),
        $request
    )->send();
} catch (\Exception $e) {
    // return 404
    return (new Response(
        'Not found',
        404,
        ['Content-Type' => 'text/html']
    ))->send();
}