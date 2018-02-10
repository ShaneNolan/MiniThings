<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
      <form style="width: 50%" method="POST" action="<?php echo site_url('login/login');?>">
        <h3 class="text-center">Mini Things - Login</h3>
        <div class="text-center"><?php echo validation_errors(); ?></div>
        <div class="group">
          <input type="text" name="email" autofocus required><span class="highlight"></span><span class="bar"></span>
          <label>Email</label>
        </div>
        <div class="group">
          <input type="password" name="password" required><span class="highlight"></span><span class="bar"></span>
          <label>Password</label>
        </div>
        <div class="group" style="padding-bottom: 15px;border-bottom:1px solid #757575">
          <input type="checkbox" style="margin-top: 12px; margin-left:15px" name="remember_me" class="checkbox">
          <label>Remember Me</label>
        </div>
        <button type="submit" class="button buttonBlue">Login
          <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
      </form>
  </div>
</main>
</div>
