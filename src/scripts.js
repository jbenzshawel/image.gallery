$(document).foundation();
$(document).ready(function(){
  // initialize header toggle 
  $('body').bind('mousewheel', function(e){
    if(e.originalEvent.wheelDelta < 0) {
        //user is scrolling down
       $('.main').css('display','none');
      $('iframe').css('height', '95%');

       //$('.homeLink').css('display','block');

    }else {
        //user is scrolling up
       $('.main').css('display','block');
        // $('.homeLink').css('display','none');
        $('iframe').css('height', '100%');
    }
  });
   $('body').keydown(function(h){
      if(h.keyCode == 38){
        //user presses up key
        $('.main').css('display','block');
       //$('.homeLink').css('display','none');

      } else if(h.keyCode == 40){
        // user presses down key
       $('.main').css('display','none');
       //$('.homeLink').css('display','block');

      }
  });

  // search stuff
  var target = "input[name='s']";

    // Listen for changes on first row and get amount value
      $(document).on('change', target, function(){
      var subreddit = $('input[name="s"]').val();
      var url = '?subreddit=' + subreddit + "";
      window.location.href = url;
    });

$(".fancybox").fancybox({
    openEffect  : 'none',
    closeEffect : 'none'
  });
  $(".fancybox-imgur").fancybox({
    openEffect  : 'none',
    closeEffect : 'none'
  });
});