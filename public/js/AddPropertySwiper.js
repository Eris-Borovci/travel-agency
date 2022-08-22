const propertySwiper = new Swiper(".property",{
    slidesPerView: 1,
});

propertySwiper.disable()

function slide(callback) {
    propertySwiper.enable();
    callback();
    propertySwiper.disable()
}

function slideNext() {
    propertySwiper.slideNext();
}

function slidePrev() {
    propertySwiper.slidePrev();
}
