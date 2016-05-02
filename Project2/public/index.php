<?php
// included functions
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/utility/helperFunctions.php';
require_once __DIR__ . '/../app/config.php';

//-------------------------------------------
// map routes to controller class/method
//-------------------------------------------

$app->get('/',      controller('Hdip\Controller', 'main/index'));

// ------ Admin Pages ----------
$app->get('/admin',  controller('Hdip\Controller', 'admin/index'));
$app->get('/lecturerCV',  controller('Hdip\Controller', 'admin/cv'));
$app->get('/lecturerJobs',  controller('Hdip\Controller', 'admin/jobs'));
$app->get('/lecturerEmployed',  controller('Hdip\Controller', 'admin/employed'));

// ------ Student Pages ---------------
$app->get('/student',  controller('Hdip\Controller', 'student/index'));
$app->get('/studentCV',  controller('Hdip\Controller', 'student/studentCV'));
$app->get('/studentJobs',  controller('Hdip\Controller', 'student/studentJobs'));
$app->get('/studentComments',  controller('Hdip\Controller', 'student/studentComments'));

// ------ login and logout ------------
$app->get('/login',  controller('Hdip\Controller', 'user/login'));
$app->get('/logout',  controller('Hdip\Controller', 'user/logout'));

// ------ form login     ------------
$app->post('/login',  controller('Hdip\Controller', 'user/processLogin'));

// ------ run -----------
$app->run();
