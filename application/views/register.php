<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
      <form style="width: 50%" method="POST" action="<?php echo site_url('login/create');?>">
        <h3 class="text-center">Mini Things - Register</h3>
        <div class="text-center"><?php if(isset($message)) { echo $message; } else { echo validation_errors(); } ?></div>
        <div id="form_one">
          <div class="group">
            <input type="text" name="first_name" value="<?php echo $customer['contactFirstName']; ?>" required><span class="highlight"></span><span class="bar"></span>
            <label>First Name</label>
          </div>
          <div class="group">
            <input type="text" name="last_name" value="" required><span class="highlight"></span><span class="bar"></span>
            <label>Last Name</label>
          </div>
          <div class="group">
            <input type="text" name="email" value="" required><span class="highlight"></span><span class="bar"></span>
            <label>Email</label>
          </div>
          <div class="group">
            <input type="text" name="phone" value="" required><span class="highlight"></span><span class="bar"></span>
            <label>Phone</label>
          </div>
          <div class="group">
            <input type="password" name="password" required><span class="highlight"></span><span class="bar"></span>
            <label>Password</label>
          </div>
          <div class="group">
            <input type="password" name="confirm_password" required><span class="highlight"></span><span class="bar"></span>
            <label>Confirm Password</label>
          </div>
          <button type="button" id="btn_next" class="button buttonBlue">Next
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
          </button>
      </div>

      <div id="form_two" style="display:none">
        <div class="group">
          <input type="text" name="company_name" value="" required><span class="highlight"></span><span class="bar"></span>
          <label>Company Name</label>
        </div>
        <div class="group">
          <input type="text" name="line_one" value="" required><span class="highlight"></span><span class="bar"></span>
          <label>Address Line One</label>
        </div>
        <div class="group">
          <input type="text" name="line_two" value="" required><span class="highlight"></span><span class="bar"></span>
          <label>Address Line Two</label>
        </div>
        <div class="group">
          <input type="text" name="city" value="" required><span class="highlight"></span><span class="bar"></span>
          <label>City</label>
        </div>
        <div class="group">
          <input type="text" name="state" value="" required><span class="highlight"></span><span class="bar"></span>
          <label>State</label>
        </div>
        <div class="group">
          <input type="text" name="country" value="" required><span class="highlight"></span><span class="bar"></span>
          <label>Country</label>
        </div>
        <div class="group">
          <input type="text" name="post_code" value="" required><span class="highlight"></span><span class="bar"></span>
          <label>Post Code</label>
        </div>
        <button type="button" id="btn_back" style="width:45%;" class="button buttonBlue">Back
          <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
        <button type="submit" style="width:45%; float:right;" class="button buttonBlue">Register
          <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
      </div>
    </form>
  </div>
</main>
</div>
