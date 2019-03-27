var waitForJQuery = setInterval(function() {
   if (typeof $ != 'undefined') {
      $(document).ready(function() {
         $('.page-header-headings').addClass("{{uwicampus}}")
         $('.course-content').addClass("{{uwicampus}}")
         $(document).on('scroll', function() {
            var s = Math.floor($(this).scrollTop());
            var sb = 288;

            var h = $('.header-uwi');
            var hp = $('.page-container-uwi');
            var hsd = h.hasClass("slidedown")
            
            if (s > sb) {
               if (hsd) {
                  h.removeClass("slidedown").addClass("slideup");
                  hp.addClass("slideuptrack");
               }
            } else {
               h.removeClass("slideup").addClass("slidedown");
               hp.removeClass("slideuptrack");
            }
         })
      });
      clearInterval(waitForJQuery);
   }
}, 100);
