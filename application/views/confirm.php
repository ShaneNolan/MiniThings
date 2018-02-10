<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
      <div style="margin:auto" class="mdl-card mdl-cell mdl-cell--8-col  mdl-shadow--2dp">
        <div class="mdl-card__supporting-text"><?php echo isset($message) ? $message : ""; ?></div>
        <div class="mdl-card__actions mdl-card--border">
          <a href="<?php echo site_url(); ?>" class="mdl-button right-card">Confirm</a>
        </div>
      </div>
  </div>
</main>
</div>
