<?php

function middleware(bool $authed, ?int $session)
{
    if ($authed && !$session)
    {
         header('Location: /index.php');
         exit;
     }

    if (!$authed && $session)
    {
        header('Location: /account/index.php');
        exit;
    }
}