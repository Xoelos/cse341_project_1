<?php

include_once '../library/classes.php';

if (session_id() == "")
    session_start();

// Grab action
$action = null;
if (filter_input(INPUT_POST, 'action') !== null)
    $action = filter_input(INPUT_POST, 'action');

if (filter_input(INPUT_GET, 'action') !== null)
    $action = filter_input(INPUT_GET, 'action');


switch ($action) {

    // Show Register page
    case 'register':
        include '../views/account/register.php';

        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            header('Location: /account/index.php');
            break;
        }

        $register = new Page(getMeta(), renderBody());

        echo $register->page;
        break;

    // Register New Account
    case 'registerPost':
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            header('Location: /account/index.php');
            break;
        }

        $newUser = new User();
        $error = $newUser->set(
            isset($_POST['firstName']) ?
                $_POST['firstName'] :
                null,
            isset($_POST['lastName']) ?
                $_POST['lastName'] :
                null,
            isset($_POST['email']) ?
                $_POST['email'] :
                null,
            isset($_POST['password']) ?
                $_POST['password'] :
                null,
            isset($_POST['passwordConfirmation']) ?
                $_POST['passwordConfirmation'] :
                null,
            0);

        if ($error) {
            echo $error;
            exit;
        }

        $userId = $newUser->register();

        if ($userId)
            $_SESSION['logged'] = $userId;

        header('Location: /account/index.php');
        break;

    // Show Login page
    case 'login':
        include '../views/account/login.php';

        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            header('Location: /account/index.php');
            break;
        }

        if (isset($_GET['error']))
            $login = new Page(getMeta(), renderBody(true));
        else
            $login = new Page(getMeta(), renderBody(false));

        echo $login->page;
        break;

    // Login User
    case 'loginPost':
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            header('Location: /index.php');
            break;
        }

        $visitor = new User();
        $user = $visitor->login($_POST['email'], $_POST['password']);

        if ($user)
            $_SESSION['logged'] = $user['id'];

        header('Location: /account/index.php');
        break;

    // Show Logout page
    case 'logout':
        $_SESSION['logged'] = null;
        header('Location: /index.php?action=logout');
        break;

    // Update User Profile
    case 'updateAccount':
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING);

        $newUser = new User();
        $success = $newUser->updateProfile($firstName, $lastName, $email, $summary);

        header("Location: /account/index.php?success=$success");
        break;

    // Update User Password
    case 'updatePassword':
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordConfirmation = filter_input(INPUT_POST, 'passwordConfirmation', FILTER_SANITIZE_STRING);

        $newUser = new User();
        $hashedPassword = $newUser->passwordCheck($password, $passwordConfirmation);

        if ($hashedPassword === 0) {
            header("Location: /account/index.php?success=0");
            break;
        }

        $success = $newUser->updatePassword($hashedPassword);

        header("Location: /account/index.php?success=$success");
        break;

    // Show user's posts
    case 'problems':
        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            header('Location: /index.php');
            break;
        }

        $problem = new Problem(null, null, null);
        $results = $problem->queryByUserId($_SESSION['logged']);
        $categoryQuery = new Query('subjects');
        $categories = $categoryQuery->queryAll();

        if (count($results) > 0) {
            include '../views/account/problems.php';
            $userProblems = new Page(getMeta(), renderBody($categories, $results));
            echo $userProblems->page;
            break;
        } else {
            include '../views/account/problems.php';
            $userProblems = new Page(getMeta(), renderBody($categories, false));
            echo $userProblems->page;
            break;
        }

    // Show account page if logged in, otherwise show search
    default:
        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            header('Location: /index.php');
            break;
        }

        $user = new User();

        if ($user->setById($_SESSION['logged'])) {
            include '../views/account/account.php';
            $account = new Page(getMeta(), renderBody($user, isset($_GET['success']) ? $_GET['success'] : null));
            echo $account->page;
            break;
        } else {
            header('Location: /account/index.php?action=login&error=true');
            break;
        }
}