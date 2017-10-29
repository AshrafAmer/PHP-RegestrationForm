<?php

# ###################################### #
#                                        #
#           Coded By                     #
#         Ashraf - Amer                  #
#           Oct, 2017                    #
#                                        #
# ###################################### #

// bluck hacking
$suspect = false;
// Perl compatible Regular Expression >> this simple one
$pattern = '/Content-type:|Bcc:|Cc:/i';

function isSuspect($value, $pattern, &$suspect){
  if (is_array($value)) {
    foreach ($value as $item) {
      isSuspect($item, $pattern, $suspect);
    }
  }else {
    if (preg_match($pattern, $value)) {
      $suspect = true;
    }
  }
}

// use usSuspect function
isSuspect($_POST, $pattern, $suspect);

// if isSuspect return true
if (!$suspect):
  // to go through the $_POST array
  foreach ($_POST as $key => $value) {
    # to strip leading and trailling whitespaces
    $value = is_array($value) ? $value : trim($value);
    # the field is required but it's empty
    if (empty($value) && in_array($key, $required)) {
      # it it's true >> add it in missing Array
      $missing[] = $key;
      $$key = '';
    } elseif (in_array($key, $expected)) {
      /*
      $key = 'name';
      $$key = 'David' ==> $name = 'David';
      */
      $$key = $value;
    }
  }
endif;
