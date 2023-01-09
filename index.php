<?php

ini_set('display_errors', true);
require './vendor/autoload.php';

$_controller = null;
$_action = null;
$_id = null;

// if ($_SERVER["REQUEST_URI"] == "/") {

//   $_controller = "home";
// } else {
//   $_controller = "error";
// }

switch ($_SERVER["REQUEST_URI"]) {
  case "/";
  case "/home";
    $_controller = "home";
    break;

  case "/movies";
    $_controller = "movies";
    break;

  case "/series";
    $_controller = "series";
    break;

  case "/actors";
    $_controller = "actors";
    break;

  case "/director";
    $_controller = "director";
    break;

  default:
    $_controller = "error";
    break;
}




if (isset($_GET["page"]) && !empty($_GET["page"])) {


  $getPage = trim(htmlspecialchars(strtolower($_GET["page"])));
  $tabPageValid = ["home", "movies", "director", "series", "actors"];
  $_controller = in_array($getPage, $tabPageValid) ? $getPage : "error";

  // if (in_array($getPage, $tabPageValid)) {
  //   $_controller = "home";
  // } else {
  //   $_controller = "error";
  // }
}

$pageInstance = "Tarek\\Poo\\Controllers\\" . ucfirst($_controller) . "Controller";
$page = new $pageInstance;

include_once "./public/partials/_header.php";
if ($_action == null) {
  include_once "./public/views/" . ucfirst($_controller) . "/" . ucfirst($_controller) . "Views.php";
} else {
  include_once "./public/views/" . ucfirst($_controller) . "/" . ucfirst($_action) . "Views.php";
}

include_once "./public/partials/_footer.php";
