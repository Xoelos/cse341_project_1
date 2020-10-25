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
            isset($_GET['category']) ?
                $_GET['category'] :
                null,
            null
        );

        $results = $problem->queryProblems();
        $question = new Page(getMeta(), renderBody($results));
        echo $question->page;
        break;

    /*
     *  Create new problem
     */
    case 'create':
        include '../views/problems/create.php';

        if(!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            header('Location: /index.php');
            break;
        }
        $categoryQuery = new Query('subjects');
        $categories = $categoryQuery->queryAll();

        $createProblem = new Page(getMeta(), renderBody($categories));

        echo $createProblem->page;
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
