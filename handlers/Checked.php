<?php

# ###################################### #
#                                        #
#           Coded By                     #
#         Ashraf - Amer                  #
#           Oct, 2017                    #
#                                        #
# ###################################### #

$maxChecked = 1;

if(!isset($_POST['gender'])){
  $_POST['gender'] = '';
}

if(!isset($_POST['terms'])){
  $_POST['terms'] = '';
}

if(!isset($_POST['level'])){
  $_POST['level'] = [];
}

if (count($_POST['level']) > $maxChecked) {
    $errors['level'] = true;
}
