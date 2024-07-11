<?php

function input(string $label, array $attrs, int|array $sanitization_filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS, int|array $validation_filter = null, string $error = null)
{
   $attr_val_strs = array_map(
      fn ($attr, $val) => "$attr='$val'",
      array_keys($attrs),
      $attrs
   );

   $attrs_str = implode(' ', $attr_val_strs);

   echo "<label>$label <input $attrs_str></label>";

   if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

   $name = $attrs['name'];

   if (is_array($sanitization_filter))
   {
      $_POST[$name] = filter_var($_POST[$name], $sanitization_filter['filter'], $sanitization_filter['flags']);
   }
   else
   {
      $_POST[$name] = filter_var($_POST[$name], $sanitization_filter);
   }

   if (!$validation_filter) return;

   if (is_array($validation_filter))
   {
      $filter = $validation_filter['filter'];
      unset($validation_filter['filter']);
      $options = $validation_filter;

      $validated = filter_var($_POST[$name], $filter, $options);
   }
   else
   {
      $validated = filter_var($_POST[$name], $validation_filter);
   }

   if ($validated) return;

   echo "<span class='error_message'>$error</span>";
}
