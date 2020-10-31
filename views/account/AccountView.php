<?php

class AccountView extends View
{
    static function renderBody($user, $success = null, $error = null)
    {
        $body = "<div class='container-fluid text-center mb-5'>
                <div class='row mt-5 mb-3'>
                    <div class='col-12'>
                        <h1>My Account</h1>
                    </div>
                </div>";

        $body .= parent::successAlert($success);
        $body .= parent::errorAlert($error);


        $body .= "<div class='row mt-4'>
                        <div class='col-12 col-md-6 offset-md-3'>
                            <hr>
                       </div>
                   </div>
                <div class='row'>
                       <div class='col-12 my-4'>
                           <h2 class='mb-5'>Manage Your Posts</h2>
                           <a href='/problems/index.php?action=create' class='mx-5'><button type='button' class='btn btn-info mx-auto'>Create a new post</button></a>
                           <a href='/account/index.php?action=problems' class='mx-5'><button type='button' class='btn btn-dark mx-auto'>See your posts</button></a>
                       </div>
                   <div class='col-12 col-md-6 offset-md-3'>
                        <hr>
                   </div>
                     </div>
                    <div class='row mt-5'>
                        <div class='col-12 offset-md-3 col-md-6' >
                            <form id='updateAccount' class='mb-5' method='POST' action='/account/index.php'>
                              <h2>Update Account</h2>
                              <input id='actionAccount' type='hidden' name='action' value='updateAccount'>
                              <div class='row form-group'>
                                  <div class='col-12 col-md-6'>
                                      <label for='firstName'>First Name</label>
                                      <input type='text' class='form-control' id='firstName' name='firstName' value='$user[first_name]' required>
                                  </div>
                                  <div class='col-12 col-md-6'>
                                      <label for='lastName'>Last Name</label>
                                      <input type='text' class='form-control' id='lastName' name='lastName' value='$user[last_name]' required>
                                  </div>
                              </div>
                              <div class='row form-group'>
                                  <div class='col-12'>
                                    <label for='email'>Email address</label>
                                    <input type='email' class='form-control' id='email' name='email' value='$user[email]' required>
                                  </div>
                              </div>
                               <div class='row form-group'>
                                  <div class='col-12'>
                                    <label for='summary'>User Summary</label>
                                    <textarea class='form-control' id='summary' name='summary'>$user[summary]</textarea>
                                  </div>
                              </div>
                              <button type='submit' class='btn btn-secondary px-5 mt-4'>Update Profile</button>
                            </form>
                            <hr>
                            <form id='updatePassword' method='POST' action='/account/index.php' class='mt-5'>
                            <h2>Update Password</h2>
                              <input id='actionPassword' type='hidden' name='action' value='updatePassword'>
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

    static function getMeta()
    {
        return 'Project 1 | Account';
    }
}