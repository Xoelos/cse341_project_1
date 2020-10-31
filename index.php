<?php

include_once "$_SERVER[DOCUMENT_ROOT]/library/imports.php";

startSession();
$session = grabSession();
$action = grabAction();
$error = grabError();
$success = grabSuccess();

// Controller
switch ($action) {

// Show About page
    case 'about':
        echo Page::render(AboutView::getMeta(), AboutView::renderBody($success, $error));
        setSuccess(null);
        setError(null);
        break;

// Show default search page
    default:
        $categories = Category::queryAll();

        echo Page::render(SearchView::getMeta(), SearchView::renderBody($categories, $success, $error));
        setSuccess(null);
        setError(null);
        break;
}