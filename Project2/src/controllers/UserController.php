<?php

namespace Hdip\Controller;

use Itb\checkuser;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;


/**
 * Class UserController
 *
 * @package Hdip\Controller
 */
class UserController extends DatabaseTable
{

    //Declare variables
    private $level;
    private $username;
    private $password;

    // action for POST route:    /processLogin
    /**
     * @param Request $request
     * @param Application $app
     *
     * This will process the login
     * it will send the username to another function to verify it exists
     * it will then look at the admin level for this user and decide which page to show the user (admin/student)
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processLoginAction(Request $request, Application $app)
    {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $isLoggedIn = false;

        //session logged in

        $isLoggedIn = self::canFindMatchingUsernameAndPassword($username,$password);

        // authenticate!
        if ($isLoggedIn == true) {

            if($this->isAdmin()==true){
                // store username in 'user' in 'session'
                $app['session']->set('user', array('username' => $username) );

                // success - redirect to the secure admin home page
                return $app->redirect('/admin');
            }
            else{
                // store username in 'user' in 'session'
                $app['session']->set('user', array('username' => $username) );

                // success - redirect to the secure admin home page
                return $app->redirect('/student');
            }


        }

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter'
        );

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /login
    /**
     * @param Request $request
     * @param Application $app
     *
     * This will show the login page
     *
     * @return login page
     */
    public function loginAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null );

        $argsArray = [];

        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @param Request $request
     * @param Application $app
     *
     * This will end the session and return the user to the index page
     *
     * @return index page
     */
    public function logoutAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null );

        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', []);

    }

    public function isAdmin(){
        echo $this->getLevel();
        die();
        if($this->getLevel()==1){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * @return int admin level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $id
     * this will set the admin level
     */
    public function setLevel($id)
    {
        $this->level = $id;
    }

    /**
     * @return string username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * This will set the username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string password
     * This will return the password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * hash the password before storing ...
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $hashedPassword;
    }

    /**

     * @param $username
     * @param $password
     *
     * return success (or not) of attempting to find matching username/password in the repo
     *
     * @return bool
     */
    public static function canFindMatchingUsernameAndPassword($username, $password)
    {

        $user = self::getOneByUsername($username);

        $hashedStoredPassword = $user->getPassword();

        self::level($username);

        if($password == $hashedStoredPassword){
            return true;
        }

    }

    public function level($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT level FROM users WHERE username=:username';
        //$sql = 'SELECT * FROM admin WHERE username=$username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        $level = $statement->fetch();

        $setlev = new self;
        $setlev->setLevel($level);

    }

    /**
     * if record exists with $username, return User object for that record
     * otherwise return 'null'
     *
     * @param $username
     *
     * @return mixed|null
     */
    public static function getOneByUsername($username)
    {

        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM users WHERE username=:username';
        //$sql = 'SELECT * FROM admin WHERE username=$username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();


        if ($object = $statement->fetch()) {

            return $object;
        } else {
            echo 'hello';
            die();
            return null;
        }
    }

    /**
     * this will return all of the students who are employed
     * @return users array
     */
    public static function getEmployed()
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM studentlogin WHERE isEmployed=:yes';

        $statement = $connection->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        $employ = $statement->fetchAll();

        return $employ;
    }

    /**
     * This will return a list of students who are unemployed
     * @return user array
     */
    public static function getNotEmployed()
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM studentlogin WHERE isEmployed!=:yes';

        $statement = $connection->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        $employ = $statement->fetchAll();

        return $employ;
    }

}