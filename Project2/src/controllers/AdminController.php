<?php

namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Hdip\Model\DvdRepository;

/**
 * Class AdminController
 *
 * simple authentication using Silex session object
 * $app['session']->set('isAuthenticated', false);
 *
 * but the propert way to do it:
 * https://gist.github.com/brtriver/1740012
 *
 * @package Hdip\Controller
 */
class AdminController
{

    // action for route:    /admin
    // will we allow access to the Admin home?
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'admin/lecturerCV';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @param Request $request
     * @param Application $app
     *
     * This will load the page for the lecturers to see student cvs
     *
     * @return lecturerCV page
     */
    public function cvAction(Request $request, Application $app){
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        $templateName = 'admin/lecturerCV';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @param Request $request
     * @param Application $app
     *
     * This will load the page for the lecturers to go to the jobs page
     *
     * @return lecturerJobs page
     */
    public function jobsAction(Request $request, Application $app){
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        $templateName = 'admin/lecturerJobs';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @param Request $request
     * @param Application $app
     *
     * This will load the page to show the list of employed and unemployed students
     *
     * @return lecturerEmployed page
     */
    public function employedAction(Request $request, Application $app){
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        // store username into args array
        $argsArray = array(
            'username' => $username,
        );

        $templateName = 'admin/lecturerEmployed';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

}