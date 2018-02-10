<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
      <form style="width: 50%" method="POST" action="<?php echo site_url('login/createadmin');?>">
        <h3 class="text-center">Mini Things <br> Admin Registration</h3>
        <div class="text-center"><?php if(isset($message)) { echo $message; } else { echo validation_errors(); } ?></div>
        <div>
          <div class="group">
            <input type="text" name="email" value="" autofocus required><span class="highlight"></span><span class="bar"></span>
            <label>Email</label>
          </div>
          <div class="group">
            <input type="password" name="password" value="" required><span class="highlight"></span><span class="bar"></span>
            <label>Password</label>
          </div>
          <button type="submit" class="button buttonBlue">Register
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
          </button>
        </div>
      </form>
    </div>
  </main>
</div>
