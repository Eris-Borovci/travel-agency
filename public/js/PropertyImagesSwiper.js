const propertySwiper = new Swiper(".property-swiper", {
    slidesPerView: 3,
    slidesPerGroup: 2,
    spaceBetween: 20,
    rewind: false,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".property-pagination",
    },
});
