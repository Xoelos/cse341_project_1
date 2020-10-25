<?php

function renderBody($error = null)
{
    $body = '<div class="container-fluid text-center">
                <div class="row mt-5">
                    <div class="col-12 offset-md-3 col-md-6" >
                        <form id="login" method="POST" action="/account/index.php">
                          <h2>Login</h2>
                          <input id="action" type="hidden" name="action" value="loginPost">
                          <div class="row form-group mt-5">
                              <div class="col-12 col-md-6 offset-md-3">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                              </div>
                              <div class="col-12 col-md-6 offset-md-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                              </div>
                          </div>
                          <button type="submit" class="btn btn-secondary px-5 mt-4">Login</button>
                        </form>
                    </div>
                </div>';

    if ($error) {
        $body .= '<div class="row mt-5">
                    <div class="col-12 col-md-4 offset-md-4">
                        <div class="alert alert-danger" role="alert">
                            Invalid Credentials!
                        </div>
                    </div>
                  </div>';
    }

    $body .= '</div>';

    return $body;
}

function getMeta()
{
    return 'Project 1 | Login';
}