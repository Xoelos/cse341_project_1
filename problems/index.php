<?php

include_once "$_SERVER[DOCUMENT_ROOT]/library/imports.php";

startSession();
$session = grabSession();
$action = grabAction();
$error = grabError();
$success = grabSuccess();

// Controller
switch ($action) {

    // GET Search for Problems
    case 'search':
        $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);

        $results = Problem::queryProblems($session, $query, $category);

        echo Page::render(ProblemsView::getMeta(), ProblemsView::renderBody($results, $session, $success, $error));
        setSuccess(null);
        setError(null);
        break;

    //  GET Create Problem
    case 'create':
        middleware(true, $session);

        $categories = Category::queryAll();

        echo Page::render(CreateProblemView::getMeta(), CreateProblemView::renderBody($categories, $success, $error));
        setSuccess(null);
        setError(null);
        break;

    // POST Create Problem
    case 'createProblem':
        middleware(true, $session);

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING);

        $results = Problem::create($session, $name, $category, $summary);

        if ($results) {
            setSuccess(null);
            setError(null);
            header("Location: /problems/index.php?action=search&query=$name");
        } else {
            setSuccess(null);
            setError("Could not retrieve results, please try again!");
            header("Location: /index.php");
        }
        break;

    // POST Update a problem
    case 'updateProblem':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING);

        $results = Problem::update($id, $name, $category, $summary);

        if ($results) {
            setSuccess(null);
            setError(null);
        } else {
            setSuccess(null);
            setError("Could not update!");
        }

        header("Location: /account/index.php?action=problems");
        break;

    // POST Delete Problem
    case 'deleteProblem':
        $id = filter_input(INPUT_POST, 'problemId', FILTER_SANITIZE_STRING);
        $results = Problem::delete($id);

        if ($results) {
            setSuccess(null);
            setError(null);
        } else {
            setSuccess(null);
            setError("Could not delete!");
        }

        header("Location: /account/index.php?action=problems");
        break;

    // POST Add or Update Vote
    case 'vote':
        middleware(true, $session);

        $problem_id = filter_input(INPUT_POST, 'problemId', FILTER_SANITIZE_STRING);
        $upvote = filter_input(INPUT_POST, 'upvote', FILTER_SANITIZE_NUMBER_INT);

        $results = Vote::upvoteProblem($upvote, $problem_id, $session);

        if ($results) {
            setSuccess(null);
            setError(null);
        } else {
            setSuccess(null);
            setError("Error!");
        }

        header("Location: /problems/index.php");
        break;

    // Show all problems
    default:
        $results = Problem::queryProblems($session);
        echo Page::render(ProblemsView::getMeta(), ProblemsView::renderBody($results, $session, $success, $error));
        setSuccess(null);
        setError(null);
        break;
}
