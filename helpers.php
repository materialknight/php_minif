<?php

function iprint(mixed ...$vars): void
{
   $last_elem = $vars[array_key_last($vars)];

   foreach ($vars as $var)
   {
      echo '<pre>' . print_r($var, true) . '</pre>';
   }

   $should_exit = count($vars) > 1 && ($last_elem === 1 || $last_elem === true);

   if ($should_exit) exit;
}

function send_json(array $unencoded): void
{
   header('Content-Type: application/json');
   echo json_encode($unencoded);
   exit;
}

function view(string $filename, array $vars = []): void
{
   foreach ($vars as $key => $val)
   {
      $$key = $val;
   }

   require "inc/$filename.php";
}
