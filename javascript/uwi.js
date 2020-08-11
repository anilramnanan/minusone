var waitForJQuery = setInterval(function () {
  if (typeof $ != "undefined") {
    $(document).ready(function () {
      if (!!window.IntersectionObserver || "IntersectionObserver" in window) {
        const header = document.querySelector(".header-uwi");
        const navdrawer = document.querySelector("#nav-drawer");
        const sentinal = document.querySelector("#page-header");

        const handler = (entries) => {
          // console.log(entries);
          // entries is an array of observed dom nodes
          // we're only interested in the first one at [0]
          // because that's our .sentinal node.
          // Here observe whether or not that node is in the viewport
          if (!entries[0].isIntersecting) {
            if(navdrawer) navdrawer.classList.add("positionup");
            if(header){
              header.classList.remove("slidedown");
              header.classList.add("slideup");
            }
          } else {
            if(header){
              header.classList.remove("slideup");
              header.classList.add("slidedown");
            }
            if(navdrawer) navdrawer.classList.remove("positionup");
          }
        };

        const observer = new window.IntersectionObserver(handler);
        // give the observer some dom nodes to keep an eye on
        if(sentinal) observer.observe(sentinal);
      }
    });
    clearInterval(waitForJQuery);
  }
}, 100);
