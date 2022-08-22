document.addEventListener("alpine:init", () => {
    Alpine.data("property", () => ({
        propertySelection: "",
        slides: 0,
        propertyName: "",
        location: "",
        isLocationValid: false,
        currentLocation: null,
        initialize() {
            this.multipleSlide(2, true);
            this.$watch("location", () => {
                this.validateLocation();
            });
        },
        validateLocation() {
            const latestCities = City.LastCities;
            console.log("opa", latestCities);

            latestCities.forEach((lc) => {
                if (lc.city == this.location) {
                    this.isLocationValid = true;
                    this.currentLocation = lc;
                    return;
                } else {
                    this.currentLocation = null;
                    this.isLocationValid = false;
                }
            });
        },
        nextSlide(property) {
            if (property) this.propertySelection = property;
            this.slides += 1;
            slide(slideNext);
        },
        prevSlide() {
            this.slides -= 1;
            slide(slidePrev);
        },
        multipleSlide(times, next) {
            for (let i = 1; i <= times; i++) {
                if (next) {
                    this.nextSlide();
                } else {
                    this.prevSlide();
                }
            }
        },
        validateFields(...fields) {
            let notValid = false;
            fields.forEach((field) => {
                if (field == "") {
                    notValid = true;
                    return;
                }
            });
            return notValid;
        },
        validateSlide(...props) {
            if (!this.validateFields(props)) {
                this.nextSlide();
            }
        },
    }));
});
