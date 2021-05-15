<?php

declare(strict_types=1);

namespace siev20\Controller;

use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the session routes.
 */
class Session extends ControllerBase
{
    public function index(): ResponseInterface
    {
        $body = renderView("layout/session.php");
        return $this->response($body);
    }

    public function destroy(): ResponseInterface
    {
        destroySession();
        return $this->redirect(url("/session"));
    }
}
