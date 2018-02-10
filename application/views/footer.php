<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="snackbar-input" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button  type="button" class="mdl-snackbar__action" style="color: #22ADC1"></button>
</div>
<input type="hidden" name="url" value="<?php echo site_url() ?>" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo $this->scripts_base . "main.js"?>"></script>
<script src="<?php echo $this->css_base . "material.min.js"?>"></script>
<?php if(isset($scripts)) { echo $scripts; } ?>
</body>
</html>
