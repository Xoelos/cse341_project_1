<?php

// View Parents
include_once "$_SERVER[DOCUMENT_ROOT]/views/Page.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/View.php";

// View Children
include_once "$_SERVER[DOCUMENT_ROOT]/views/NotFoundView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/ErrorView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/SearchView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/AboutView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/problems/CreateProblemView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/problems/ProblemsView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/account/AccountView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/account/LoginView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/account/MyProblemsView.php";
include_once "$_SERVER[DOCUMENT_ROOT]/views/account/RegistrationView.php";

// ORM
include_once "$_SERVER[DOCUMENT_ROOT]/library/db/connections.php";
include_once "$_SERVER[DOCUMENT_ROOT]/library/db/Database.php";
include_once "$_SERVER[DOCUMENT_ROOT]/library/create/Create.php";
include_once "$_SERVER[DOCUMENT_ROOT]/library/update/Update.php";
include_once "$_SERVER[DOCUMENT_ROOT]/library/update/UserUpdate.php";
include_once "$_SERVER[DOCUMENT_ROOT]/library/delete/Delete.php";
include_once "$_SERVER[DOCUMENT_ROOT]/library/query/Query.php";
include_once "$_SERVER[DOCUMENT_ROOT]/library/query/UserQuery.php";

// Models
include_once "$_SERVER[DOCUMENT_ROOT]/models/Problem.php";
include_once "$_SERVER[DOCUMENT_ROOT]/models/User.php";
include_once "$_SERVER[DOCUMENT_ROOT]/models/Category.php";

// Code Snippets
include_once "$_SERVER[DOCUMENT_ROOT]/library/snippets/controller.php";
include_once "$_SERVER[DOCUMENT_ROOT]/library/snippets/middleware.php";

