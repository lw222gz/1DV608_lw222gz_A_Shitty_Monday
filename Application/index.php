<?php

//this line is used in the release version at the webhost due to some wierd bugg where
//I had to manually create a tmp folder to create a session, so that folder can only be found in the code at the webhost.
//session_save_path("tmp");
session_start();



//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/ApplicationView.php');
require_once('view/PostStatusView.php');

require_once('controller/LoginController.php');
require_once('controller/PostController.php');
require_once('controller/MasterController.php');

require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('model/User.php');
require_once('model/UserDAL.php');
require_once('model/SessionManager.php');
require_once('model/PostStatusModel.php');
require_once('model/DALBase.php');
require_once('model/PostsDAL.php');
require_once('model/Post.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE MODELS/ VIEWS/ Controllers
$DALb = new DALBase();
$UDAL = new UserDAL();


$pDAL = new PostsDAL($DALb);
$psM = new PostStatusModel($pDAL);
$sm = new SessionManager();
$lm = new LoginModel($UDAL, $sm);
$rm = new RegisterModel($UDAL);

$PostView = new PostStatusView();
$AppV = new ApplicationView($PostView, $sm);
$v = new LoginView($lm, $AppV, $sm);
$rv = new RegisterView();
$lv = new LayoutView();

$loginCont = new LoginController($v, $lm, $rv, $rm, $sm);
$PostCont = new PostController($PostView, $psM, $sm);
$MC = new MasterController($PostCont, $loginCont, $v, $rv, $PostView, $sm, $AppV);

$MC -> init();

$lv->render($sm -> getLoggedInSession(), $v, $rv);