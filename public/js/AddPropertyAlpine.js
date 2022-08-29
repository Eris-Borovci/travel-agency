document.addEventListener("alpine:init", () => {
    Alpine.data("property", () => ({
        propertySelection: "apartment", //Property selection
        slides: 0,
        maxSlides: document.querySelectorAll(".swiper-slide").length - 1,
        propertyName: "", //Property name
        theLocation: "",
        isLocationValid: false,
        currentLocation: {}, // The location picked { city, country, id, lanlng }
        latlngMarkerLocation: {}, // The lanlng from the marker
        map: null,
        maxPeople: 1,
        roomsAmount: {
            bedroom: 0,
            livingRoom: 0,
            bathroom: 0,
        }, // Rooms amount by the 4th slide
        numberOfInputs: 0,
        selectedFiles: [], //Selected files from the inputs
        price: 0, // Property price
        initialize() {
            this.multipleSlide(4, true);

            // Setting today date to check in/out input
            const date = new Date();
            const today =
                (date.getMonth() + 1).toString() +
                "-" +
                date.getDate().toString() +
                "-" +
                date.getFullYear().toString();

            this.$refs.checkIn.value = today;

            // Starting the event listeners for the location input
            this.$nextTick(() => {
                ["keydown", "input", "keyup"].forEach((ev) => {
                    this.$refs.theLocation.addEventListener(ev, () => {
                        this.theLocation = this.$refs.theLocation.value;
                        this.validateLocation();
                        this.$nextTick(() => {
                            this.addCityItemEvent();
                        });
                    });
                });
            });

            this.$watch("slides", () => {
                if (this.slides == 3) {
                    this.setMap();
                } else if (this.slides == 8) {
                    const video = document.getElementById("finished_animation");
                    video.load();
                    video.play();
                    setTimeout(() => {
                        video.pause();
                    }, 1000);
                } else {
                    this.removeMap();
                }
            });

            this.addFileInput();

            this.addEventFilesInputs();
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
        nextSlide(property = null) {
            if (property != null) this.propertySelection = property;

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
                this.$refs.lat.value = e.target._latlng.lat;
                this.$refs.lon.value = e.target._latlng.lng;
            });
        },
        removeMap() {
            if (this.map != null) {
                this.map.remove();
                this.map = null;
            }
        },
        increaseRoom(type) {
            switch (type) {
                case "bedroom":
                    this.roomsAmount.bedroom += 1;
                    break;
                case "livingRoom":
                    this.roomsAmount.livingRoom += 1;
                    break;
                case "bathroom":
                    this.roomsAmount.bathroom += 1;
                    break;
                default:
                    break;
            }
        },
        decreaseRoom(type) {
            switch (type) {
                case "bedroom":
                    if (this.roomsAmount.bedroom - 1 < 0) break;
                    this.roomsAmount.bedroom -= 1;
                    break;
                case "livingRoom":
                    if (this.roomsAmount.livingRoom - 1 < 0) break;
                    this.roomsAmount.livingRoom -= 1;
                    break;
                case "bathroom":
                    if (this.roomsAmount.bathroom - 1 < 0) break;
                    this.roomsAmount.bathroom -= 1;
                    break;
                default:
                    break;
            }
        },
        peopleAmount(amount) {
            if (this.maxPeople + amount >= 1) {
                this.maxPeople += amount;
            }
        },
        validateRooms(shouldNext) {
            if (
                this.roomsAmount.bedroom == 0 &&
                this.roomsAmount.livingRoom == 0 &&
                this.roomsAmount.bathroom == 0
            ) {
                return false;
            }
            if (shouldNext) {
                this.nextSlide();
            }
            return true;
        },
        validateCheckInOut(shouldNext = false) {
            if (this.$refs.checkIn.value != "") {
                if (shouldNext) {
                    this.nextSlide();
                }
                return true;
            }
            return false;
        },
        checkFiles(next = false) {
            if (this.getSelectedFiles().length > 0) {
                if (next) {
                    this.nextSlide();
                }
                return true;
            }

            return false;
        },
        getSelectedFiles() {
            this.selectedFiles = [];

            const inputs = document.querySelectorAll(".filesGroup input");
            let files = [];

            inputs.forEach((inp) => {
                if (inp.files.length > 0) {
                    files.push(inp.files[0]);
                }
            });

            this.selectedFiles = files;

            return files;
        },
        addFileInput() {
            this.refreshNumberOfInputs();

            let lastInput = document.querySelectorAll(".filesGroup input");
            lastInput = lastInput[lastInput.length - 1];

            if (lastInput != undefined && lastInput.files.length == 0) {
                this.$refs.addFileBtn.setAttribute("disabled", true);
                lastInput.classList.add("animate-wiggle");
                setTimeout(() => {
                    this.$refs.addFileBtn.removeAttribute("disabled");
                    lastInput.classList.remove("animate-wiggle");
                }, 1200);
                return;
            }

            const template = this.createInputTemplate();

            document.querySelector(".filesGroup").append(template);

            this.addEventFilesInputs();
        },
        removeFileInput(input) {
            const activeInputs = document.querySelectorAll(".filesGroup input");
            const removeBtn =
                document.querySelectorAll(".filesGroup button")[0];

            // Checking if there is only one input
            if (activeInputs.length <= 1) {
                activeInputs[0].classList.add("animate-wiggle");
                removeBtn.setAttribute("disabled", true);
                activeInputs;
                setTimeout(() => {
                    activeInputs[0].classList.remove("animate-wiggle");
                    removeBtn.removeAttribute("disabled");
                }, 1200);
                return;
            }

            const filesContainerChild =
                document.querySelector(".filesGroup").children[input];

            filesContainerChild.classList.add("hidden");
            filesContainerChild.innerHTML = "";
        },
        refreshNumberOfInputs() {
            const filesGroup = document.querySelectorAll(".filesGroup > div");

            this.numberOfInputs = filesGroup.length;
        },
        createInputTemplate() {
            const inputContainer = document.createElement("div");
            inputContainer.classList.add(
                "flex",
                "justify-center",
                "items-center"
            );
            inputContainer.id = `file_input_${this.numberOfInputs}`;

            const theInput = document.createElement("input");
            theInput.classList.add(
                "my-1.5",
                "block",
                "w-full",
                "text-sm",
                "text-gray-900",
                "bg-gray-50",
                "rounded-lg",
                "border",
                "border-gray-300",
                "cursor-pointer",
                "focus:outline-none"
            );
            theInput.setAttribute("aria-describedby", "file_input_help");
            theInput.type = "file";
            theInput.id = this.numberOfInputs;
            inputContainer.append(theInput);

            const theSpacer = document.createElement("div");
            theSpacer.classList.add("spacer", "px-2");
            inputContainer.append(theSpacer);

            const theRemoveBtn = document.createElement("button");
            theRemoveBtn.type = "button";
            theRemoveBtn.setAttribute(
                "x-on:click",
                `removeFileInput(${this.numberOfInputs})`
            );
            theRemoveBtn.classList.add(
                "h-7",
                "w-7",
                "border-gray-700",
                "border-2",
                "rounded-full"
            );

            const theIcon = document.createElement("i");
            theIcon.classList.add("fa-solid", "fa-minus", "text-gray-70");
            theRemoveBtn.append(theIcon);

            inputContainer.append(theRemoveBtn);

            return inputContainer;
        },
        addEventFilesInputs() {
            const inputs = document.querySelectorAll(".filesGroup input");

            inputs.forEach((input) => {
                input.addEventListener("change", () => {
                    this.checkFiles();
                });
            });
        },
        async sendRequest(next = false) {
            if (next) this.nextSlide();

            // Fetching all files
            const f = document.querySelectorAll(".filesGroup input");
            console.log(f[0].files[0]);

            // The property details form data
            const formData = new FormData();
            formData.append("property_selection", this.propertySelection);
            formData.append("property_name", this.propertyName);
            formData.append(
                "current_location",
                JSON.stringify(this.currentLocation)
            );
            formData.append(
                "marker_location",
                JSON.stringify(this.latlngMarkerLocation)
            );
            formData.append("max_people", this.maxPeople);
            formData.append("rooms_details", JSON.stringify(this.roomsAmount));
            formData.append("check_in", this.$refs.checkIn.value);
            formData.append("check_out", this.$refs.checkOut.value);
            formData.append("price", this.price);

            // Sending the requests
            const request = await fetch("http://travel-agency.test/property", {
                method: "POST",
                body: formData,
            });

            const response = await request.json();

            console.log(response);
            // The property photo form data
            let photosError = false;

            for (let i = 0; i < f.length; i++) {
                const photosFormData = new FormData();
                photosFormData.append("File", f[i].files[0]);
                photosFormData.append("property_id", response.property_id);

                const photoRequest = await fetch(
                    "http://travel-agency.test/photos",
                    {
                        method: "POST",
                        body: photosFormData,
                    }
                );

                const photoResponse = await photoRequest.json();

                if (photoResponse.status != "finished") {
                    photosError = true;
                    break;
                }
            }

            if (photosError) {
                // Do something if saving the photos fails
            }
        },
    }));
});
