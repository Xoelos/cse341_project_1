<?php

function renderBody($user, $updated = -1)
{
    $body = "<div class='container-fluid text-center mb-5'>
                <div class='row mt-5'>
                    <div class='col-12 mb-5'>
                        <h1>My Account</h1>
                    </div>
                    <div class='col-12 mb-3'>
                        <a href='/problems/index.php?action=create' class='mx-3'><button type='button' class='btn btn-info mx-auto'>Create a new post</button></a>
                        <a href='/account/index.php?action=problems' class='mx-3'><button type='button' class='btn btn-dark mx-auto'>See your posts</button></a>
                    </div>
                </div>";


    if($updated === "1") {
        $body .= "<div class='row'>
                    <div class='col-8 col-md-4 col-lg-3 mx-auto'>
                        <div class='alert alert-success' role='alert'>
                         Account Updated!
                        </div>
                    </div>
                  </div>";
    } else if ($updated === "0") {
        $body .= "<div class='row'>
                    <div class='col-8 col-md-4 col-lg-3 mx-auto'>
                        <div class='alert alert-danger' role='alert'>
                         Error updating account
                        </div>
                    </div>
                  </div>";
    }

    $body .= "<div class='row mt-5'>
                    <div class='col-12 offset-md-3 col-md-6' >
                        <form id='updateAccount' class='mb-5' method='POST' action='/account/index.php'>
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
                                <textarea class='form-control' id='summary' name='summary'>$user->summary</textarea>
                              </div>
                          </div>
                          <button type='submit' class='btn btn-secondary px-5 mt-4'>Update Profile</button>
                        </form>
                        <form id='updatePassword' method='POST' action='/account/index.php' class='mt-5'>
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
                          <button type='submit' class='btn btn-secondary px-5 mt-4'>Update Password</button>
                        </form>
                    </div>
                </div>
             </div>";


    return $body;
}

function getMeta()
{
    return 'Project 1 | Account';
}