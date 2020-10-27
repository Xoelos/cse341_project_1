<?php

include_once '../library/classes.php';

if (session_id() == "")
    session_start();

/*
 *  Grab action
 */
$action = null;
if (filter_input(INPUT_POST, 'action') !== null)
    $action = filter_input(INPUT_POST, 'action');

if (filter_input(INPUT_GET, 'action') !== null)
    $action = filter_input(INPUT_GET, 'action');

/*
 * Control by action
 */
switch ($action) {
    /*
     * Search by term
     */
    case 'search':
        include '../views/problems/problems.php';

        $problem = new Problem(
            isset($_GET['query']) ?
                $_GET['query'] :
                null,
            isset($_GET['subject']) ?
                $_GET['subject'] :
                null,
            null
        );

        $results = $problem->queryProblems();
        $question = new Page(getMeta(), renderBody($results));
        echo $question->page;
        break;

    /*
     *  GET Submit new problem thread
     */
    case 'create':
        include '../views/problems/create.php';

        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            header('Location: /index.php');
            break;
        }
        $categoryQuery = new Query('subjects');
        $categories = $categoryQuery->queryAll();

        if (isset($_GET['success']) && $_GET['success'])
            $createProblem = new Page(getMeta(), renderBody($categories, true));
        else
            $createProblem = new Page(getMeta(), renderBody($categories, false));

        echo $createProblem->page;
        break;

    /*
    *  POST Create a new problem
    */
    case 'createProblem':
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_NUMBER_INT);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING);

        $newProblem = new Problem($name, $subject, $summary);
        $newProblem->create();

        header("Location: /problems/index.php?action=search&query=$name");
        break;

    /*
    *  POST Create a new problem
    */
    case 'updateProblem':
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_NUMBER_INT);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING);

        $newProblem = new Problem($name, $subject, $summary);
        $success = $newProblem->update();

        header("Location: /problems/index.php?action=search&query=$name");
        break;

    /*
    *  POST Create a new problem
    */
    case 'deleteProblem':
        $id = filter_input(INPUT_POST, 'problemId', FILTER_SANITIZE_STRING);

        $newProblem = new Problem(null, null, null);
        $success = $newProblem->delete($id);

        header("Location: /account/index.php?action=problems");
        break;

    /*
     * Return a query of all
     */
    default:
        include '../views/problems/problems.php';

        $problem = new Problem(null, null, null);

        $results = $problem->queryProblems();
        $question = new Page(getMeta(), renderBody($results));
        echo $question->page;
        break;
}
