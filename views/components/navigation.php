<?php

putenv('LOCAL_REF=');

$navigation =
'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="' . getenv('LOCAL_REF') . '/index.php">Generic Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="' . getenv('LOCAL_REF') . '/posts/index.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="' . getenv('LOCAL_REF') . 'cart.php">Cart</a>
            </li>
        </ul>
    </div>
</nav>';