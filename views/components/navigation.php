<?php

$navigation =
    '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/index.php">ideaio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?action=about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/problems/index.php">Problems</a>
                </li>
            </ul>';

if(isset($_SESSION['logged']) && $_SESSION['logged']) {
    $navigation .= '<ul class="navbar-nav ml-auto">
                <li class="nav-item">
                   <a class="nav-link" href="/account/index.php?action=logout">Logout</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="/account/index.php">Account</a>
                </li>
            </ul>
        </div>
    </nav>';
} else {
    $navigation .= '<ul class="navbar-nav ml-auto">
                <li class="nav-item">
                   <a class="nav-link" href="/account/index.php?action=login">Login</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="/account/index.php?action=register">Register</a>
                </li>
            </ul>
        </div>
    </nav>';
}
