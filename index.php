<?php

declare(strict_types=1);

require 'helpers.php';
require 'inmakr.php';

?>

<?php view('header', ['title' => 'PHP Mini Framework']) ?>

<main>
   <h1>PHP Mini Framework</h1>

   <form method='POST'>
      <?php

      input(
         'First Name:',
         [
            'type' => 'text',
            'name' => 'firstname',
            'required' => 'true'
         ]
      );

      input(
         'Age:',
         [
            'type' => 'number',
            'name' => 'age',
            'min' => 18,
            'max' => 110
         ],
         FILTER_SANITIZE_NUMBER_INT,
         [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 18, 'max_range' => 110]
         ],
         'Age should be at least 18 and at most 110'
      );

      ?>

      <button type='submit'>Send</button>
   </form>

</main>

<?php view('footer') ?>