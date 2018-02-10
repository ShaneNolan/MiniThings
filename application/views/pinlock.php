<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
      <form method="POST" action="<?php echo site_url('login/pinunlock');?>">
        <h3 class="text-center">Mini Things - Login</h3>
        <div class="text-center"><?php echo isset($message) ? '<span style="color:red;">' . $message . '</span>' : "You appear to be logging in from a different."; ?></div>
        <div class="group">
          <input type="password" name="pin" maxlength="4" required><span class="highlight"></span><span class="bar"></span>
          <label>Pin</label>
        </div>
        <button type="submit" class="button buttonBlue">Enter Pin
          <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
      </form>
  </div>
</main>
</div>
