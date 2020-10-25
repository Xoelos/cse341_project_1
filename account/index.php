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

    // Show account page if logged in, otherwise show search
    default:
        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            header('Location: /index.php');
            break;
        }

        $user = new User();
        $success = $user->setById($_SESSION['logged']);

        if ($success) {
            include '../views/account/account.php';
            $account = new Page(getMeta(), renderBody($user));
            echo $account->page;
            break;
        } else {
            header('Location: /account/index.php?action=login&error=true');
        }
}