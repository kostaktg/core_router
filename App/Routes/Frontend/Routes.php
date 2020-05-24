<?php 
use Core\Router;

Router::set('home', 'Home', null,  function(){
    echo 'homeVIEW';
});


Router::set('about', 'Home', null,  function(){
    echo 'home';
});

