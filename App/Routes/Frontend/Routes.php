<?php 
use Core\Router;

Router::set('/home', 'Home');
Router::set('/', 'Home');

Router::set('/five-factors', 'FiveFactors');
Router::set('/five-factors', 'FiveFactors', 'show', ':slug');

Router::set('/about', 'Home', 'create');

