<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02/05/2016
 * Time: 11:51
 */

class StudentController
{
    /**
     * @param Request $request
     * @param Application $app
     *
     * This will load the cv page where students can edit their cv details
     *
     * @return StudentCV page
     */
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
        $templateName = 'student/studentCV';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @param Request $request
     * @param Application $app
     *
     * This will load the cv page where students can edit their cv details
     * This is different from index in that this is called when a nav button is pressed
     *
     * @return StudentCV page
     */
    public function studentCVAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'student/studentCV';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @param Request $request
     * @param Application $app
     *
     * This will load the cv page where students can see comments left about their cv by a lecturer
     *
     * @return StudentComments page
     */
    public function studentCommentsAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'student/studentComments';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @param Request $request
     * @param Application $app
     *
     * This will load the cv page where students can see the list of available jobs and apply for them
     *
     * @return StudentJObs page
     */
    public function studentJobsAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'student/studentJobs';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}