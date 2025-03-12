new Swiper('.card-wrapper', {
    // Optional parameters
    direction: 'vertical',
    loop: true,
  
    //pagination bullets
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });