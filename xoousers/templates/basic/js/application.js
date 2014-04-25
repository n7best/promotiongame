// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S ALL JUST JUNK FOR OUR DOCS!
// ++++++++++++++++++++++++++++++++++++++++++

!function ($) {

  $(function(){

    var $window = $(window)

    $('.button-loading')
      .click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000)
      })
	  
	   $('#button-forgot')
            .click(function () {
              document.location.href='user_password_reset.php';
          })
	  
	  
	  
  })

// Modified from the original jsonpi https://github.com/benvinegar/jquery-jsonpi

}(window.jQuery)
