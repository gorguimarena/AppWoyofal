<?php
require_once '../app/config/bootstrap.php';

use DevNoKage\Router;

Router::setRoute($routes);

Router::resolve();