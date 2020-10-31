<?php

include_once "$_SERVER[DOCUMENT_ROOT]/library/imports.php";

startSession();
$session = grabSession();
$action = grabAction();
$error = grabError();
$success = grabSuccess();

/*
 * Control by action
 */
switch ($action) {

    // GET Show Register page
    case 'register':
        middleware(false, $session);
        echo Page::render(RegistrationView::getMeta(), RegistrationView::renderBody($success, $error));
        setSuccess(null);
        setError(null);
        break;

    // POST Register New Account
    case 'registerPost':
        middleware(false, $session);

        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirm = filter_input(INPUT_POST, 'passwordConfirmation', FILTER_SANITIZE_STRING);

        $id = User::register($firstName, $lastName, $email, '', $password, $confirm, 0);

        if ($id) {
            $_SESSION['logged'] = $id;
            $_SESSION['name'] = $firstName;
            setSuccess(null);
            setError(null);
            header('Location: /account/index.php');
        } else {
            setSuccess(null);
            setError("Unable to register account, please try again!");
            header('Location: /account/index.php?action=register');
        }

        break;

    // GET Login page
    case 'login':
        middleware(false, $session);

        setSuccess(null);
        setError(null);

        echo Page::render(LoginView::getMeta(), LoginView::renderBody($success, $error));
        break;

    // POST Login User
    case 'loginPost':
        middleware(false, $session);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_EMAIL);

        $user = User::login($email, $password);

        if ($user) {
            $_SESSION['logged'] = $user['id'];
            $_SESSION['name'] = $user['first_name'];
            setSuccess("You have successfully logged in!");
            setError(null);

            header('Location: /account/index.php');
            break;
        } else {
            setSuccess(null);
            setError("Could not log in, please try again!");
            header('Location: /account/index.php?action=login');
            break;
        }

    // Show Logout page
    case 'logout':
        middleware(true, $session);
        unset($_SESSION['logged']);
        unset($_SESSION['name']);

        setSuccess("You have successfully logged out!");
        setError(null);
        header('Location: /index.php');
        break;

    // Update User Profile
    case 'updateAccount':
        middleware(true, $session);

        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING);

        $user = new User();
        $success = $user->updateProfile($session, $firstName, $lastName, $email, $summary);

        $success ? setSuccess("You have successfully updated your profile!") : setSuccess(null);
        !$success ? setError("Error: unable to update profile!") : setError(null);

        header("Location: /account/index.php");
        break;

    // Update User Password
    case 'updatePassword':
        middleware(true, $session);

        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordConfirmation = filter_input(INPUT_POST, 'passwordConfirmation', FILTER_SANITIZE_STRING);
        $hashedPassword = User::passwordCheck($password, $passwordConfirmation);


        if (!$hashedPassword) {
            setSuccess(null);
            setError("Password does not match!");
            header("Location: /account/index.php");
            break;
        }

        User::updatePassword($session, $hashedPassword);

        setSuccess("You have successfully updated your password!");
        setError(null);

        header("Location: /account/index.php");
        break;

    // Show User's Posts
    case 'problems':
        middleware(true, $session);

        $categories = Category::queryAll();
        $results = Problem::getByUserId($session);

        echo Page::render(MyProblemsView::getMeta(), MyProblemsView::renderBody($categories, $results, $success, $error));
        setSuccess(null);
        setError(null);
        break;

    // Show account page if logged in, otherwise show search
    default:
        middleware(true, $session);

        $user = User::getById($session);
        if ($user) {
            echo Page::render(AccountView::getMeta(), AccountView::renderBody($user, $success, $error));
            setSuccess(null);
            setError(null);
        }
        else {
            setSuccess(null);
            setError(null);
            header("Location: /account/index.php?action=logout");
        }
        break;
}