<main class="mdl-layout__content mdl-color--grey-100">
  <?php //echo  secure_pin() . "<br>" . generateSecurePassword(); ?>
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
     <div class="mdl-card__title">
       <h2 class="mdl-card__title-text">
         Welcome back, Admin
       </h2>
     </div>
   </div>
  </div>
  <div class="mdl-grid">
    <div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
      <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
        <div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
          <h2 class="mdl-card__title-text">Add Product</h2>
        </div>
        <div class="mdl-card__actions mdl-card--border">
          <a href="<?php echo site_url('products/add'); ?>" class="mdl-button mdl-js-button mdl-js-ripple-effect">Add Product</a>
        </div>
      </div>
      <div class="demo-separator mdl-cell--1-col"></div>
    </div>
    <div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
      <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
        <div class="mdl-card__title mdl-card--expand mdl-color--blue-300">
        </div>
        <div class="mdl-card__actions mdl-card--border">
          <a href="<?php echo site_url(""); ?>" class="mdl-button mdl-js-button mdl-js-ripple-effect">Refresh</a>
          <a href="<?php echo site_url("login/logout"); ?>" class="mdl-button mdl-js-button mdl-js-ripple-effect right-card">Logout</a>
        </div>
      </div>
      <div class="demo-separator mdl-cell--1-col"></div>
    </div>
    <div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
      <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
        <div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
          <h2 class="mdl-card__title-text">Admin Accounts</h2>
        </div>
        <div class="mdl-card__actions mdl-card--border">
          <a href="#" id="viewAdminAccounts" class="mdl-button mdl-js-button mdl-js-ripple-effect">View Accounts</a>
          <a href="<?php echo site_url("login/registeradmin"); ?>" class="mdl-button mdl-js-button mdl-js-ripple-effect right-card">Add Account</a>
        </div>
      </div>
      <div class="demo-separator mdl-cell--1-col"></div>
    </div>
  </div>

  <div id="adminAccounts" class="mdl-grid" style="display:none">
  <table class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Pin</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Pin</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($admins as $admin){
            echo '<tr><td>' . $admin->customerNumber . '</td><td>' . $admin->email .
            '</td><td><a href="' . site_url("admin/resetPassword/") . $admin->customerNumber .
            '">Reset</a></td><td><a href="' . site_url("admin/resetPIN/") . $admin->customerNumber . '">Unlock</td></td>';
          } ?>
        </tbody>
    </table>
  </div>
</main>
