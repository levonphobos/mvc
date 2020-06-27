<?php

Route::set('home', function (){
    Home::createView('Home');
    Home::addCover();
    Home::editCover();
    Home::deleteCover();
    Home::logout();
    Home::addPost();
    Home::deletePost();
});

Route::set('login', function (){
    Login::createView('Login');
    Login::userLogin();
    Login::sendResetLinkToMail();
});

Route::set('register', function (){
    Register::createView('Register');
    Register::registration();
});

Route::set('reset_password', function (){
    ResetPassword::createView('ResetPassword');
    ResetPassword::resetPass();
});