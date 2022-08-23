document.addEventListener("alpine:init", () => {
    Alpine.data("property", () => ({
        propertySelection: "",
        slides: 0,
        maxSlides: 4,
        propertyName: "",
        theLocation: "",
        isLocationValid: false,
        currentLocation: {},
        latlngMarkerLocation: {},
        map: null,
        initialize() {
            this.multipleSlide(4, true);

            this.$refs.theLocation.addEventListener("keydown", () => {
                this.theLocation = this.$refs.theLocation.value;
                this.validateLocation();
                this.addCityItemEvent();
            });

            this.$refs.theLocation.addEventListener("input", () => {
                this.theLocation = this.$refs.theLocation.value;
                this.validateLocation();
                this.$nextTick(() => {
                    this.addCityItemEvent();
                });
            });

            this.$refs.theLocation.addEventListener("keyup", () => {
                this.theLocation = this.$refs.theLocation.value;
                this.validateLocation();
                this.addCityItemEvent();
            });

            this.$watch("slides", () => {
                console.log(this.slides);
                if (this.slides == 3) {
                    this.setMap();
                } else {
                    this.removeMap();
                }
            });
        },
        getProgress() {
            const singleSlide = 100 / this.maxSlides;
            const progress = singleSlide * this.slides + "%";

            return progress.toString();
        },
        validateLocation(switchSlide = false) {
            const latestCities = City.LastCities;
            this.theLocation = this.$refs.theLocation.value;

            for (let i = 0; i < latestCities.length; i++) {
                if (
                    latestCities[i].city.toLowerCase() ==
                    this.theLocation.toLowerCase()
                ) {
                    this.isLocationValid = true;
                    this.currentLocation = latestCities[i];
                    this.$refs.lat.value = this.currentLocation.lat;
                    this.$refs.lon.value = this.currentLocation.lon;

                    if (switchSlide) {
                        this.nextSlide();
                    }
                    break;
                } else {
                    this.isLocationValid = false;
                    this.currentLocation = null;
                }
            }
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
        addCityItemEvent() {
            const cities = document.querySelectorAll(".city-item");
            cities.forEach((ci) => {
                ci.addEventListener("mouseover", () => {
                    this.validateLocation();
                });
            });
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
        setMap() {
            this.map = L.map("map").setView(
                [this.$refs.lat.value, this.$refs.lon.value],
                10
            );

            L.tileLayer(
                "https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=ssVRaMfqFIYA1Om5wsEo",
                {
                    attribution:
                        '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
                }
            ).addTo(this.map);

            let marker = L.marker(
                [this.$refs.lat.value, this.$refs.lon.value],
                {
                    draggable: true,
                    autoPan: true,
                }
            ).addTo(this.map);

            this.map.addEventListener("move", (e) => {
                marker.setLatLng([
                    this.map.getCenter().lat,
                    this.map.getCenter().lng,
                ]);
            });

            this.map.addEventListener("zoom", (e) => {
                marker.setLatLng([
                    this.map.getCenter().lat,
                    this.map.getCenter().lng,
                ]);
            });

            marker.addEventListener("move", (e) => {
                this.latlngMarkerLocation = e.target._latlng;
            });
        },
        removeMap() {
            if (this.map != null) {
                this.map.remove();
                this.map = null;
            }
        },
    }));
});
