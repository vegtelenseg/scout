// TOGGLE THE DROP-DOWN MENU WHEN 'LOGIN' IS CLICKED
var hasToggled = 0;
$(document).ready(function()
{
    // ADD MORE THUMBNAIL ITEMS
    $(function()
    {
      Grid.init();
      // adding more items
      $('#og-additems').on( 'click', function()
      {
          return false;
      });
    });
    $('#li-watchlist').click(function(e) {
      e.preventDefault();
      $('html, body').animate({
        scrollTop: $("#ul-watchlist").offset().top
    }, 500);
    });
    $('#li-discover').click(function(e) {
      e.preventDefault();
      $('html, body').animate({
        scrollTop: $("#ul-discover").offset().top
    }, 500);
    });
    $('#li-crowdpicks').click(function(e) {
      e.preventDefault();
      $('html, body').animate({
        scrollTop: $("#ul-crowdpicks").offset().top
    }, 500);
    });
    $('#login-trigger').click(function()
    {
      if (!hasToggled)
      {
        $(this).next('#login-content').slideToggle();
        hasToggled = 1;
        $(this).toggleClass('active');          
        if ($(this).hasClass('active'))
            $(this).find('span').load('&#x25B2;')
        else
            $(this).find('span').load('&#x25BC;')
      }
    })
    $('#signup-trigger').click(function()
    {
      if (!hasToggled)
      {
        $(this).next('#signup-content').slideToggle();
        hasToggled = 1;
        $(this).toggleClass('active');          
        if ($(this).hasClass('active'))
            $(this).find('span').load('&#x25B2;')
        else
            $(this).find('span').load('&#x25BC;')
      }
    });
// FADE OUT THE ACTIVE LOGIN WINDOW IF NOT IN USE
    var screen = $(window);
    var scroll_pos = screen.scrollTop();
    screen.scroll(function()
    {
      if(((screen.scrollTop() > scroll_pos) && scroll_pos > 430))
      {
          $('#login-content').fadeOut();
          $('#signup-content').fadeOut();
          hasToggled = 0;
      }
      scroll_pos = screen.scrollTop();
    });
// FADE OUT THE ACTIVE LOGIN WINDOW IS THE BODY IS CLICKED
    $(document).mouseup(function(e)
    {
        var container = $('#login-content');
        var container2 = $('#signup-content');

        if ((!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0)) // ... nor a descendant of the container
        {
            container.fadeOut();
            hasToggled = 0;
        }
        if ((!container2.is(e.target) // if the target of the click isn't the container...
            && container2.has(e.target).length === 0))
        {
            container2.fadeOut();
            hasToggled = 0;
        }
    });
});
