<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mini-things are a Limerick based distribution company who specialise in selling miniature toys (classic cars, planes, motorcycles, trains etc.) from their Raheen operation to toy shops and collectors all over the world.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Mini Things</title>

    <link rel="shortcut icon" href="<?php echo $this->img_base . "favicon.png"?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo $this->css_base . "material.min.css"?>">
    <link rel="stylesheet" href="<?php echo $this->css_base . "styles.css"?>">
    <link rel="stylesheet" href="<?php echo $this->css_base . "style.css"?>">

    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  </head>

  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Mini Things</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label style="margin: auto" class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i id="s" class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Search...</label>
            </div>
          </div>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="<?php echo $this->img_base . "user.jpg"?>" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span>
            <?php
            if($this->SESSION)
              echo $this->SESSION->email;
            else
              echo 'Guest';
            ?>
            </span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Login/Logout</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <?php
              if($this->SESSION)
                echo '<a class="no-underline" href="'. site_url("login/logout") . '"><li class="mdl-menu__item">Logout</li></a>';
              else
                echo '<a class="no-underline" href="'. site_url("login") . '"><li class="mdl-menu__item">Login</li></a><a class="no-underline" href="'. site_url("login/register") . '"><li class="mdl-menu__item">Register</li></a>';
              ?>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="<?php echo base_url();?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href="<?php echo site_url('products');?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_offer</i>Products</a>
          <?php
          if(empty($this->SESSION->admin)){
            echo '<a class="mdl-navigation__link" href="' . site_url('wish') .'"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Wish List</a>
                  <a class="mdl-navigation__link" href="' . site_url('cart') .'"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Shopping Cart</a>';
          }
          if($this->SESSION)
            echo '<a class="mdl-navigation__link" href="' . site_url('orders') .'"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_basket</i>Orders</a>';
          ?>
          <div class="mdl-layout-spacer"></div>
          <!-- <a class="mdl-navigation__link" href="<?php echo site_url('home/contact');?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i>Contact</a>-->
        </nav>
      </div>
