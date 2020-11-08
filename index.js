function hideOptionsMenu() {
      var menu = $(".optionsMenu");
      if (menu.css("display") != "none") {
        menu.css("display", "none");
      }
    }

    function showOptionsMenu(button) {
      var songId = $(button).prevAll(".songId").val();
      var menu = $(".optionsMenu");
      var menuWidth = menu.width();
      menu.find(".songId").val(songId);
      menu.css({
        "top": 20 + "px",
        "left": 60 + "px",
        "display": "inline"
      });

    }
    $(document).click(function(click) {
      var target = $(click.target);

      if (!target.hasClass("item") && !target.hasClass("optionsButton")) {
        hideOptionsMenu();
      }
    });

    $(window).scroll(function() {
      hideOptionsMenu();
    });

    function addsonglist(song_id,playlist)
    {
        if(playlist!="")
        {
        window.location.href = "addsong.php?s_id="+song_id+"&list="+playlist;
        }
        else{
            return true;
        }
    }