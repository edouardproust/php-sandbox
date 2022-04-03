<?php

function admin_dashboard_tiles(): array
{
  return [
    [
      'link' => 'analytics.php',
      'header' => 'Analytics',
      'title' => 'Page views',
      'text' => 'Check how many pages has been visited since the website was launched.',
      'button' => 'View stats',
      'color' => 'bg-light',
      'btn-color' => 'btn-primary'
    ], [
      'link' => 'blog/edit-post.php?p=add',
      'header' => 'Blog',
      'title' => 'New post',
      'text' => 'Write a new amazing blog post for your readers.',
      'button' => 'Start writing',
      'color' => '',
      'btn-color' => 'btn-primary'
    ], [
      'link' => 'blog/index.php',
      'header' => 'Blog',
      'title' => 'Edit a post',
      'text' => 'Want to make an update to a post or correct a mistake? You\'re at the right place.',
      'button' => 'Browse posts',
      'color' => '',
      'btn-color' => 'btn-primary'
    ], [
      'link' => 'blog/index-cat-auth.php',
      'header' => 'Blog',
      'title' => 'Categories & authors',
      'text' => 'Add new authors and post categories to the blog, and update the ones already created.',
      'button' => 'Manage',
      'color' => '',
      'btn-color' => 'btn-primary'
    ]
  ];
}
function admin_menu_item($link, $title, $aClass = '')
{
  $class = 'nav-item';
  $link = home() . DIRECTORY_SEPARATOR . $link;
  $html = '<li class="' . $class . '">
      <a class="' . $aClass . '" href="' . $link . '">' . $title . '</a>
    </li>';
  return $html;
}
function greetings($username): string
{
  $time = (int)date('G', time());
  if ($time >= 12 && $time < 18) {
    $hello = 'Good afternoon';
  } elseif ($time >= 18 && $time < 24) {
    $hello = 'Good evening';
  } elseif ($time >= 0 && $time < 6) {
    $hello = 'Happy night';
  } else {
    $hello = 'Good morning';
  }
  return $hello . ', ' . $username . '!';
}
