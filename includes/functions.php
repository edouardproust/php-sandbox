<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions/login.php';

// Menus & titles

function home(): string
{
  return '';
}
function dirbase(string $path = 'index.php'): void
{
  echo '/lessons/files/php_HTML%20&%20Bootstrap_20201103/' . $path;
}

function title_dyn(string $var = 'The Developer Fastlane'): void
{
  if (isset($var)) {
    echo $var;
  } else {
    echo 'The Developer Fastlane';
  }
}

/**
 * @param array $items array([string: url, string: label], ...)
 * @param string $aClass 
 * @return string 
 */
function nav_menu(array $items, string $aClass = ''): string
{
  if (!is_connected()) {
    $dashboard_link = nav_item('pages/login.php', 'Login', $aClass);
  } else {
    $dashboard_link = nav_item('admin/index.php', 'Admin dashboard', $aClass);
  }
  $menu_links = '';
  foreach ($items as $item) {
    $menu_links .= nav_item($item[0], $item[1], $aClass);
  }
  return $menu_links . $dashboard_link;
}

function nav_item($link, $title, $aClass = '')
{
  $class = 'nav-item';
  if (strpos($_SERVER["SCRIPT_NAME"], $link) !== false) {
    $class .= $class . ' active';
  }
  $link = home() . DIRECTORY_SEPARATOR . $link;
  $html = '<li class="' . $class . '">
      <a class="' . $aClass . '" href="' . $link . '">' . $title . '</a>
    </li>';
  return $html;
}

// Shop opening hours

function contact_visit($weekSlots): array
{
  $open['day'] = $open['hour'] = 0;
  $today = (int)date('w');
  $now = (int)date('G');
  if (!empty($weekSlots[$today])) {
    (int)$open['day'] = 1;
  }
  foreach ($weekSlots[$today] as $slot) {
    if ($now >= $slot[0] && $now < $slot[1]) {
      (int)$open['hour'] = 1;
    }
  }
  return $open;
}
function contact_visit_ul(array $weekSlots, array $isOpen): array
{
  foreach (DAYS as $d => $day) {
    $style = '';
    $date = (int)date('w');
    if ($d === $date) {
      if ($isOpen['hour'] === 1) {
        $color = "green";
      } else {
        $color = "red";
      }
      $style = "style='color:$color'";
    }
?><li <?= $style ?>>
      <b><?= $day ?></b>: <?php
                          if (empty($weekSlots[$d])) {
                            echo 'closed';
                          } else {
                            contact_visit_li($weekSlots[$d]);
                          } ?>
    </li><?php
        }
        return $isOpen;
      }
      function contact_visit_li(array $daySlots)
      {
        $line = [];
        foreach ($daySlots as $slot) {
          for ($i = 0; $i < count($slot); $i++) { // Formating from 24-hour format to 12-hour Am format
            if ($slot[$i] > 12) {
              $slot[$i] = ($slot[$i] - 12) . ' pm';
            } else {
              $slot[$i] .= ' am';
            }
          }
          $line[] = "$slot[0] - $slot[1]";
        }
        echo implode(' / ', $line);
      }
      function contact_visit_alert(array $isOpen)
      {
        if (array_sum($isOpen) === 2) {
          echo <<<HTML
    <div class="alert alert-success" role="alert">
      <b>We are open for business.</b> Call us to make sure there are still tables available:<br>
      <b>+1-202-555-0161</b>
    </div>
HTML;
        } else {
          echo <<<HTML
    <div class="alert alert-danger" role="alert">
      <b>The restaurant is now closed.</b> Please make a reservation with the right-hand side form.
    </div>
HTML;
        }
      }

      // Newsletter

      function newsletter_submit()
      {
        if (!empty($_POST)) {
          $today = date("Y-m-d");
          $file = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER["DOCUMENT_ROOT"]) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'newsletter' . DIRECTORY_SEPARATOR . $today . '.txt';
          $data = $_POST['firstname'] . ' - ' . $_POST['email'] . PHP_EOL;
          $link = "Check the list <a href='/data/newsletter/list.php'>here</a>.";

          if (file_exists($file) && in_array($data, file($file))) { // Check if the person is already registered inside this file
            return "
        <div class='alert alert-danger'>
          You are already registered to this list. $link
        </div>";
            echo '';
          } else {
            file_put_contents($file, $data, FILE_APPEND);
            return "
        <div class='alert alert-success'>
          Thank you {$_POST['firstname']}, you're now on our list! $link
        </div>";
          }
        }
      }

      function foo_newsletter(string $code_if_true, string $code_if_false): string
      {
        $where_to_hide_it = [ // Edit this list as needed (add or remove pages)
          'newsletter.php',
          'login.php',
          'admin/analytics.php',
        ];
        // Don't touch the code below
        $needle_found = 0;
        foreach ($where_to_hide_it as $needle) {
          if (strpos($_SERVER["SCRIPT_NAME"], $needle)) {
            $needle_found += 1;
          }
        }
        if ($needle_found > 0) {
          return $code_if_true;
        } else {
          return $code_if_false;
        }
      }
