$(window, document, undefined).ready(function() {
  $('input').blur(function() {
    var $this = $(this);
    if ($this.val())
      $this.addClass('used');
    else
      $this.removeClass('used');
  });

  var $ripples = $('.ripples');
  $ripples.on('click.Ripples', function(e) {

    var $this = $(this);
    var $offset = $this.parent().offset();
    var $circle = $this.find('.ripplesCircle');
    var x = e.pageX - $offset.left;
    var y = e.pageY - $offset.top;

    $circle.css({
      top: y + 'px',
      left: x + 'px'
    });

    $this.addClass('is-active');
  });

  $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
  	$(this).removeClass('is-active');
  });
});

$('#btn_next').click(function(e) {
  var valid = true;
  $("#form_one input").each(function(){
   if($(this).val().length == 0){
     valid = false;
     showSnack('Invalid input, try again.');
     return false;
   }
  });

  if($('[name=password]').val() != $('[name=confirm_password]').val()){
    valid = false;
    showSnack("Passwords don't match.");
    $('input[name="password"]').focus();
  }

  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if(!emailReg.test($('[name=email]').val())){
    valid = false;
    showSnack("Invalid email entered.");
    $('input[name="email"]').focus();
  }

  if(valid){
    $("#form_two").delay(100).fadeIn(100);
    $("#form_one").fadeOut(100);
    $('input[name="company_name"]').focus();
    e.preventDefault();
  }
});

function showSnack(message){
  var snackbarContainer = document.querySelector('#snackbar-input');
  var data = {
    message: message,
    timeout: 2500,
    actionHandler: function(event) {
      snackbarContainer.classList.remove('mdl-snackbar--active');
      snackbarContainer.setAttribute("aria-hidden", "true");
    },
    actionText: 'OK'
  };

  snackbarContainer.MaterialSnackbar.showSnackbar(data);
}

$('#btn_back').click(function(e) {
  $("#form_one").delay(100).fadeIn(100);
  $("#form_two").fadeOut(100);
  e.preventDefault();
});

$('.heart-product').click(function(e) {
  if(ajaxReq($('input[name="url"]').val() + "/wish/addWish", $(this).val())){
    var $btn = $('button[id="btn_wish"][value="' + $(this).val() + '"]');
    if($btn.hasClass("red-heart")){
      $btn.removeClass("red-heart");
      showSnack("Removed from wishlist.");
    }else{
      $btn.addClass("red-heart");
      showSnack("Added to wishlist.");
    }
  }else
    showSnack("Unable to add to wishlist.");

  e.preventDefault();
});

$('#addToCart').click(function(e) {
  $.ajax({
    type: "POST",
    url: $('input[name="url"]').val() + "/cart/addRemove/" + $(this).val(),
    success: function(response){
      if(response.indexOf("Adding to cart") > 0)
        showSnack("Added to shopping cart.");
      else
       showSnack("Removed from shopping cart.");
    }
});
  e.preventDefault();
});

$('#s').click(function(e) {
  search();
});

$('#search').keypress(function (e) {
 if(e.which == 13)
  search();
});

function search(){
  if($('#search').val().length > 0){
    var $response = ajaxReq($('input[name="url"]').val() + "/products/search", $('#search').val());

    if($response){
      $response.done(function(data){
        if(data.indexOf("No products found") != -1)
          showSnack("Nothing found");
        else{
          $("main").hide();
          $("main").replaceWith(data.substring(data.indexOf("<main"), data.indexOf("</main")));
          $("main").css("display", "none");
          $("main").fadeIn("100");
        }
      });
    }else
      showSnack("Something went wrong trying to search :(");
  }
}

function ajaxReq(domain, dat){
  return $.ajax({
      type: "POST",
      url: domain + "/" + dat,
      timeout: 5000
  })
}

$('#product_image').on('click', function() {
  $('#productimage').click();
});

$('#viewAdminAccounts').on('click', function() {
  if($(this).text() == "View Accounts"){
    $(this).text('Hide Accounts');
    $("#adminAccounts").fadeIn(500);
  }else {
    $(this).text('View Accounts');
    $("#adminAccounts").fadeOut(500);
  }
});
