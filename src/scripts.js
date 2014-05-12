$(document).ready(function(){
  // initialize header toggle 
  $('body').bind('mousewheel', function(e){
    if(e.originalEvent.wheelDelta < 0) {
        //user is scrolling down
       $('.main').css('display','none');
    }else {
        //user is scrolling up
       $('.main').css('display','block');
    }
  });
  $('body').keydown(function(h){
      if(h.keyCode == 38){
        //user presses up key
        $('.main').css('display','block');
      } else if(h.keyCode == 40){
        // user presses down key
       $('.main').css('display','none');
      }
  });

  // search stuff
  var target = "input[name='s']";

    // Listen for changes on first row and get amount value
      $(document).on('change', target, function(){
      var subreddit = $('input[name="s"]').val();
      var url = 'http://www.addison.im/oneK/' + subreddit + "/";
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