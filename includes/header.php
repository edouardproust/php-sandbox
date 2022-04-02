<?php
require_once 'functions/login.php';
require_once 'functions.php';
require_once 'nav.php';

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Edouard Proust">
  <meta name="generator" content="The Developer Fastlane">
  <title><?php title_dyn($title) ?></title>

  <link rel="canonical" href="https://getbootstrap.comexamples/starter-template/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/style.css">

</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
    <div class="navbar-brand">
      <a href="/" class="text-light">Restaurant</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <?= nav_menu($main_menu, 'nav-link') ?>
      </ul>
      <?php if (is_connected()) : ?>
        <button onclick="location.href='/pages/logout.php'" type="button" class="btn btn-danger mr-2">Log out</button>
      <?php endif; ?>
    </div>
  </nav>

  <main role="main" class="container">
    <div class="starter-template">
      <?php if (strpos($_SERVER["SCRIPT_NAME"], 'blog/post.php') === false) : ?>
        <!-- Don't show title if is a blog post -->
        <h1><?= $title ?></h1>
      <?php endif; ?>