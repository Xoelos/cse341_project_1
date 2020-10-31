<?php


class View
{
    public static function errorAlert($error) {
        if ($error) {
            return "<div class='row mt-5'>
                    <div class='col-12 col-md-4 offset-md-4'>
                        <div class='alert alert-danger' role='alert'>
                             $error
                        </div>
                    </div>
                  </div>";
        }
    }

    public static function successAlert($message) {
        if ($message) {
            return "<div class='row mt-5'>
                    <div class='col-12 col-md-4 offset-md-4'>
                        <div class='alert alert-success' role='alert'>
                             $message
                        </div>
                    </div>
                  </div>";
        }
    }

    public static function errorToast($error) {
        if ($error) {
            return "<div class='toast' role='alert' aria-live='assertive' aria-atomic='true'>
                      <div class='toast-header'>
                        <strong class='mr-auto'>Error!</strong>
                        <button type='button' class='ml-2 mb-1 close' data-dismiss='toast' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='toast-body'>
                        $error
                      </div>
                    </div>";
        }
    }

    public static function successToast($message) {
        if ($message) {
            return "<div class='toast' role='alert' aria-live='assertive' aria-atomic='true'>
                      <div class='toast-header'>
                        <strong class='mr-auto'>Success!</strong>
                        <button type='button' class='ml-2 mb-1 close' data-dismiss='toast' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='toast-body'>
                        $message
                      </div>
                    </div>";
        }
    }
}