<?php

# ###################################### #
#                                        #
#           Coded By                     #
#         Ashraf - Amer                  #
#           Oct, 2017                    #
#                                        #
# ###################################### #

 // this array to handle errors
$errors = [];
// this is an empty array to deal with missing
$missing = [];
// look for if we click on Register button >> execute this code
if(isset($_POST['send'])){
  # $expected array for all components in the form
  $expected = ['name', 'email','gender', 'terms', 'comments', 'level'];
  # $required array for all required fields
  $required = ['name', 'comments', 'gender', 'terms', 'level'];
  # include external PHP file
  require './handlers/checked.php';
  require './handlers/emailFns.php';
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <!-- Boostrap CDN link to include bootstrap's compiled css. -->
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
    integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
    crossorigin="anonymous">
    <!-- our css file -->
    <link rel="stylesheet" href="style.css" type="text/css"
    media="only screen and (min-device-width: 481px">
  </head>

  <body>
    <h1 class="text-center headline"> PHP Registration Form </h1>
    <?php if ($_POST && $suspect): ?>
      <p class="text-danger">
        Sorry your mail hasn't sent.
      </p>
    <?php elseif($errors || $missing): ?>
      <!-- this <div> will appear only if we have errors OR missing -->
      <p class="text-danger">
        Please fix item(s).
      </p>
    <?php endif; ?>

    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
      <!-- Name field -->
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Name"
          name="name" id="name"
          <?php
          if($errors || $missing){
            echo 'value ="' . htmlentities($name) . '"';
          }
          ?>
          >
        </div>
        <?php if($missing && in_array('name', $missing)):  ?>
          <p class="text-danger">
            Please enter your name.
          </p>
        <?php endif; ?>
      </div>

      <!--e-mail field -->
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" placeholder="E-mail"
          name="email" id="email"
          <?php
          if($errors || $missing){
            echo 'value ="' . htmlentities($email) . '"';
          }
          ?>
          >
        </div>
        <?php if($missing && in_array('email', $missing)):  ?>
          <p class="text-danger">
            Please enter your email.
          </p>
        <?php elseif (isset($errors['email'])) : ?>
          <p class="text-danger">
            Invalid email address.
          </p>
        <?php endif; ?>
      </div>

      <!-- gender field -->
      <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-legend col-sm-2">Gender</legend>
          <div class="col-sm-10">
            <div class="form-check-inline">
              <label class="form-check-label" for="gender_m">
                <input class="form-check-input" type="radio" name="gender"
                id="gender_m" value="male"
                <?php
                if($_POST && $gender == 'male'){
                  echo 'checked';
                }
                 ?>
                > male
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label" for="gender_f">
                <input class="form-check-input" type="radio" name="gender"
              id="gender_f" value="female"
              <?php
              if($_POST && $gender == 'female'){
                echo 'checked';
              }
               ?>
               > female
              </label>
            </div>
          </div>
        </div>
        <?php
          if ($missing && in_array('gender', $missing)) :
         ?>
          <p class="text-danger">
            You must select your gender.
          </p>
        <?php endif; ?>
      </fieldset>

      <!-- Check Level box -->
      <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-legend col-sm-2">Codeing Level</legend>
          <div class="col-sm-10">
            <div class="form-check-inline">
              <label class="form-check-label" for="entry">
                <input class="form-check-input" type="checkbox" name="level[]"
                id="entry" value="entry level"
                <?php
                if($_POST && in_array('entry level', $level)){
                  echo 'checked';
                }
                 ?>
                > Entry Level
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label" for="intermediate">
                <input class="form-check-input" type="checkbox" name="level[]"
                id="intermediate" value="intermediate level"
                <?php
                if($_POST && in_array('intermediate level', $level)){
                  echo 'checked';
                }
                 ?>
                > Entermediate Level
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label" for="expert">
                <input class="form-check-input" type="checkbox" name="level[]"
                id="expert" value="expert level"
                <?php
                if($_POST && in_array('expert level', $level)){
                  echo 'checked';
                }
                 ?>
                > Expert Level
              </label>
            </div>
          </div>
          <?php if (isset($errors['level'])) : ?>
          <p class="text-danger">
            You must select at max <?= $maxChecked . ' choice'; ?>.
          </p>
         <?php endif; ?>
        </div>
      </fieldset>

      <!-- comment field -->
      <div class="form-group row">
        <label for="comments" class="col-sm-2 col-form-label">About you</label>
        <div class="col-sm-10">
          <textarea class="form-control text-area"
          name="comments" id="comments">
          <?php
          if($errors || $missing){
            echo htmlentities($comments);
          }
          ?>
          </textarea>
        </div>
        <?php if($missing && in_array('comments', $missing)):  ?>
            <p class="text-danger">
              You forgot to add any comments.
            </p>
        <?php endif; ?>
      </div>

      <!-- Check terms box -->
      <div class="col-sm-10">
        <div class="form-check text-center">
          <label for="terms" class="form-check-label">
            <input class="form-check-input" name="terms"
            id="terms" type="checkbox" value="agreed"
            <?php
            if ($_POST && terms == "agreed") {
              echo "checked";
            }
            ?>
            >
            I agree to the terms and conditions.
          </label>
        </div>
        <?php if($missing && in_array('terms', $missing)):  ?>
          <p class="text-danger text-center">
            You must read terms and agree.
          </p>
        <?php endif; ?>
      </div>


      <!-- Registration -->
      <div class="form-group row">
        <div class="col-sm-10 text-center register">
          <button type="submit" name="send" id="send" value="send comments"
          class="btn btn-primary">Register</button>
        </div>
      </div>
    </form>
  </body>
</html>
