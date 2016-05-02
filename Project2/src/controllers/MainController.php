<?php

namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Hdip\Model\DvdRepository;

class MainController
{
    /**
     * @param Request $request
     * @param Application $app
     *
     * This will load the opening page of the site
     *
     * @return the index page
     */
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );
        // calls the page and sends the username for the session
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

}