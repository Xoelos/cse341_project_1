<?php

function renderBody($user)
{
    $body = "<div class='container-fluid text-center'>
                <div class='row mt-5'>
                    <div class='col-12'>
                        <h1>My Account</h1>
                        <hr>
                    </div>
                </div>
                <div class='row mt-4'>
                    <div class='col-12 offset-md-3 col-md-6' >
                        <form id='updateAccount' method='POST' action='account/index.php'>
                          <h2>Update Account</h2>
                          <input id='action' type='hidden' name='action' value='updateAccount'>
                          <div class='row form-group'>
                              <div class='col-12 col-md-6'>
                                  <label for='firstName'>First Name</label>
                                  <input type='text' class='form-control' id='firstName' name='firstName' value='$user->firstName' required>
                              </div>
                              <div class='col-12 col-md-6'>
                                  <label for='lastName'>Last Name</label>
                                  <input type='text' class='form-control' id='lastName' name='lastName' value='$user->lastName' required>
                              </div>
                          </div>
                          <div class='row form-group'>
                              <div class='col-12'>
                                <label for='email'>Email address</label>
                                <input type='email' class='form-control' id='email' name='email' value='$user->email' required>
                              </div>
                          </div>
                           <div class='row form-group'>
                              <div class='col-12'>
                                <label for='summary'>User Summary</label>
                                <textarea class='form-control' id='summary' name='summary' required>$user->summary</textarea>
                              </div>
                          </div>
                          <button type='submit' class='btn btn-secondary px-5 mt-4'>Update</button>
                        </form>
                        <form id='updatePassword' method='POST' action='account/index.php' class='mt-4'>
                        <h2>Update Password</h2>
                          <input id='action' type='hidden' name='action' value='updatePassword'>
                          <div class='row'>
                              <div class='form-group col-12 col-md-6'>
                                <label for='password'>Password</label>
                                <input type='password' class='form-control' id='password' name='password' required>
                              </div>
                              <div class='form-group col-12 col-md-6'>
                                <label for='passwordConfirmation'>Confirm Password</label>
                                <input type='password' class='form-control' id='passwordConfirmation' name='passwordConfirmation' required>
                              </div>
                          </div>
                          <button type='submit' class='btn btn-secondary px-5 mt-4'>Update</button>
                        </form>
                    </div>
                </div>
             </div>";

    return $body;
}

function getMeta()
{
    return 'Project 1 | Register';
}