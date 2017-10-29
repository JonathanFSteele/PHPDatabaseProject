<?php
  session_start();
  function userIsLoggedIn(){
    if (!isset($_SESSION['LoginID']) || empty($_SESSION['LoginID']) ) {
      return false;
    }
    else {
      return true;
    }
  }
  function userinRole($roleName){
    if (!isset($_SESSION['Role']) || empty($_SESSION['Role']) ) {
      return false;
    }
    else {
      if ($_SESSION['Role'] == $roleName){
        return true;
      }
      else {
        return false;
      }
    }
  }
  function redirectIfNotLoggedIn(){
    if(userIsLoggedIn() == true){
      //all is fine. Do nothing.
    }else {
      // destroy the session since its no good and we don't want any leftover variables.
      session_unset();
      session_destroy();
      header( 'Location: login.php?msg=Not+logged+in.+Please+log+in.');
      exit();
    }
  }
  function redirectIfNotInRole($roleName){
    if(userinRole($roleName) == true){
      //all is fine. do nothing.
    }else {
      // destroy the session and force them to relogin since they hit a page they shouldn't.
      session_unset();
      session_destroy();
      header( 'Location: login.php?msg=Not+Authorized+for+'.$roleName.'+pages.');
      exit();
    }
  }
?>
