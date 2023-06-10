<!-- External JavaScripts -->
<script src="{{ asset('website/js/jquery-3.1.1.min.js ') }} "></script>
<script src="{{ asset('website/js/bootstrap.min.js ') }} "></script>
<script src="{{ asset('website/js/jquery-ui.min.js ') }} "></script>
<!-- JavaScripts -->
<script src="{{ asset('website/js/functions.js ') }} "></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="collapse"]').click(function() {
            $('.sidenav').toggleClass('show');
        });
    });
</script>

<script>
    // Show or hide the button based on the scroll position
    window.onscroll = function() {
      showMoveToTopButton();
    };

    function showMoveToTopButton() {
      var button = document.getElementById("moveToTopBtn");
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        button.style.display = "block";
      } else {
        button.style.display = "none";
      }
    }

    // Scroll to the top of the page with smooth transition and specified duration when the button is clicked
    function scrollToTop(duration) {
      var currentPosition = document.documentElement.scrollTop || document.body.scrollTop;
      var startTime = performance.now();
      var animationFrame;

      function scrollToTopAnimation(timestamp) {
        var elapsed = timestamp - startTime;
        var progress = Math.min(elapsed / duration, 1);
        var easing = easeOutCubic(progress);
        document.documentElement.scrollTop = currentPosition * (1 - easing);
        document.body.scrollTop = currentPosition * (1 - easing);

        if (elapsed < duration) {
          animationFrame = requestAnimationFrame(scrollToTopAnimation);
        } else {
          cancelAnimationFrame(animationFrame);
          document.documentElement.scrollTop = 0;
          document.body.scrollTop = 0;
        }
      }

      function easeOutCubic(t) {
        return 1 - Math.pow(1 - t, 3);
      }

      animationFrame = requestAnimationFrame(scrollToTopAnimation);
    }
  </script>

</body>

</html>
