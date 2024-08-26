const container = document.getElementById("post-carousel");
const options = { 
  enabled: false,
  fill: true,
  center: false,
  Navigation: false,
  slidesPerPage: "auto",
  infinite: false,
  breakpoints: {
      "(max-width: 1199px)": {
          enabled: true,
      },
  },
};

if(container && options) new Carousel(container, options);