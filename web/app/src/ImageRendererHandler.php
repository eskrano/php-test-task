<?php

namespace App;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageRendererHandler
{
    protected TrackerInterface $tracker;

    public function __construct(TrackerInterface $tracker)
    {
        $this->tracker = $tracker;
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function renderImage(int $id, Request $request): Response
    {
        $path = __DIR__ . '/../images/' . $id . '.jpg';

        if (! file_exists($path)) {
           throw new FileNotFoundException(sprintf('Image %s not found', $id));
        }

        $this->tracker->track(
            $request->headers->get('Referer', $request->getUri()),
            $request->getClientIp(),
            $request->headers->get('User-Agent')
        );

        return new Response(
            file_get_contents($path)
            , 200, ['Content-Type' => 'image/jpg']);
    }

    protected function createException(string $message): \Exception
    {
        return new \Exception($message);
    }
}