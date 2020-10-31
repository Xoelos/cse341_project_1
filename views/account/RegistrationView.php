<?php


class RegistrationView extends View
{
    static function renderBody($success = null, $error = null)
    {
        $body = '<div class="container-fluid text-center">
                <div class="row mt-5">
                    <div class="col-12 offset-md-3 col-md-6" >
                        <form id="register" method="POST" action="/account/index.php">
                          <h2>Register</h2>
                          <input id="action" type="hidden" name="action" value="registerPost">
                          <div class="row form-group">
                              <div class="col-12 col-md-6">
                                  <label for="firstName">First Name</label>
                                  <input type="text" class="form-control" id="firstName" name="firstName" required>
                              </div>
                              <div class="col-12 col-md-6">
                                  <label for="lastName">Last Name</label>
                                  <input type="text" class="form-control" id="lastName" name="lastName" required>
                              </div>
                          </div>
                          <div class="row form-group">
                              <div class="col-12">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <small id="emailHelp" class="form-text text-muted">Well never share your email with anyone else.</small>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-12 col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                              </div>
                              <div class="form-group col-12 col-md-6">
                                <label for="passwordConfirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" required>
                              </div>
                          </div>
                          <button type="submit" class="btn btn-secondary px-5 mt-4">Register</button>
                        </form>
                    </div>
                </div>';

            $body .= parent::successAlert($success);
            $body .= parent::errorAlert($error);
            $body .= '</div>';

        return $body;
    }

    static function getMeta()
    {
        return 'Project 1 | Register';
    }
}