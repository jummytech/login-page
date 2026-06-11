<?php 
session_start();
include_once("php/helper.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap"
      rel="stylesheet"
    />
    <!-- <meta http-equiv="refresh" content="3" /> -->
  </head>
  <body>
    <aside class="">
      <header class="">
        <div class="logo">JUMMYTECH</div>
      </header>
      <p class="foot-note">Capturing Moments,<br />Creating Memories</p>
    </aside>
    <main class="">
      <div id="auth-wrapper">
        <header>
          <h1>Login to your account</h1>
          <p>Don't have an account? <a href="register.php">Sign up</a></p>
        </header>
        <?php if(has_error()): ?>
        <div class="alert" aria-hidden="false">
          <p><?= error() ?></p>
          <button class="alert-close-btn">x</button>
        </div>
        <?php endif;?>
        <form action="php/login.php" method="POST">
          <div class="form-input">
            <input
              type="text"
              name="username"
              required
              minlength="3"
              value="<?= input("username"); ?>"
              placeholder="Username"
            />
            <p class="form-error"><?= errors("username") ?></p>
          </div>
          <div class="form-input">
            <div class="password-input-wrapper">
              <input
                type="password"
                name="password"
                required
                minlength="8"
                placeholder="Password"
              />
              <div class="show-hide">
                <svg
                  id="show"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                  />
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                  />
                </svg>
                <svg
                  id="hide"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                  />
                </svg>
              </div>
            </div>
            <p class="form-error"><?= errors("password") ?></p>
          </div>
          <div class="forgot-password">
            <button type="reset">Clear fields</button>
            <a href="#">Forgot Password?</a>
          </div>
          <button type="submit">Login</button>
        </form>
      </div>
    </main>
    <script src="js/script.js"></script>
  </body>
</html>
