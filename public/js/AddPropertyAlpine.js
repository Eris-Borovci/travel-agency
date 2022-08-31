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
        selectedFiles: [], //Selected files from the inputs
        price: 0, // Property price
        imageLength: 0,
        mainPhoto: null,
        areFilesValid: false,
        initialize() {
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
        addEventFilesInputs() {
            const input = document.querySelector("#dropzone-file");
            const dropZone = document.querySelector("#the-drop-zone");

            const files = [];
            const callback = (value) => {
                files.push(value);
                this.selectedFiles = files;
            };

            input.addEventListener("change", () => {
                this.renderImage(input.files, callback);
                this.validatePhotos();
            });

            dropZone.addEventListener("dragleave", (e) => {
                e.preventDefault();
                dropZone.classList.remove("scale-110");
            });

            dropZone.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropZone.classList.add("scale-110");
            });

            dropZone.addEventListener("drop", (e) => {
                e.preventDefault();
                dropZone.classList.remove("scale-110");
                this.renderImage(e.dataTransfer.files, callback);
                this.validatePhotos();
            });
        },
        validateImages(images) {},
        addImage(blobData, theFile) {
            this.imageLength += 1;
            document
                .querySelector(".filesGroup")
                .prepend(this.createNewImageTemplate(blobData, theFile));
        },
        renderImage(fileList, callback) {
            const filesLength = fileList.length;
            if (filesLength > 0) {
                for (let i = 0; i < filesLength; i++) {
                    callback(fileList[i]);

                    const reader = new FileReader();
                    reader.addEventListener("load", (e) => {
                        this.addImage(e.target.result, fileList[i]);
                    });
                    reader.readAsDataURL(fileList[i]);
                }
            }
        },
        createNewImageTemplate(blob, theFile) {
            const mainContainer = document.createElement("div");
            mainContainer.classList.add(
                "h-48",
                `main-image-container-${this.imageLength}`,
                "relative"
            );

            mainContainer.addEventListener("click", () => {
                this.mainPhoto = this.getMainPhotosIndex();
                this.validatePhotos();
            });

            const removeButton = document.createElement("div");
            removeButton.classList.add(
                "absolute",
                "flex",
                "justify-center",
                "items-center",
                "-top-2",
                "-right-2",
                "w-5",
                "h-5",
                "rounded-full",
                "border-2",
                "border-gray-600",
                "bg-white",
                "text-sm"
            );
            removeButton.innerHTML =
                '<i class="fa-solid fa-x text-gray-600"></i>';
            removeButton.setAttribute(
                "x-on:click",
                `removePhoto(${this.imageLength})`
            );
            mainContainer.append(removeButton);

            const newFileList = new DataTransfer();
            newFileList.items.add(theFile);

            const fileInputValue = document.createElement("input");
            fileInputValue.type = "file";
            fileInputValue.classList.add("hidden");
            fileInputValue.files = newFileList.files;
            mainContainer.append(fileInputValue);

            const radio = document.createElement("input");
            radio.type = "radio";
            radio.value = "";
            radio.name = "main-photo";
            radio.id = `image-option-${this.imageLength}`;
            radio.classList.add("hidden", "peer");

            const container = document.createElement("label");
            container.setAttribute("for", `image-option-${this.imageLength}`);
            container.classList.add(
                "w-full",
                "h-48",
                "rounded-lg",
                "overflow-hidden",
                "border-2",
                "inline-flex",
                "align-center",
                "justify-center",
                "peer-checked:border-blue-600"
            );

            const imgContainer = document.createElement("div");
            const img = document.createElement("img");
            img.classList.add("w-full", "h-full");
            img.src = blob;

            imgContainer.append(img);

            container.append(imgContainer);

            mainContainer.append(radio);
            mainContainer.append(container);

            return mainContainer;
        },
        removePhoto(index) {
            const container = document.querySelector(
                `.main-image-container-${index}`
            );

            this.getPhotos();

            this.imageLength -= 1;
            container.parentElement.removeChild(container);
        },
        getMainPhotosIndex() {
            const radioInputs = document.querySelectorAll(
                ".filesGroup > .relative input[type='radio']"
            );

            let index = 0;

            radioInputs.forEach((ri) => {
                if (ri.checked == true) {
                    index = ri.id.substr(ri.id.length - 1);
                }
            });

            return index;
        },
        getPhotos() {
            let main = null;
            const mainPhotoClass = `.main-image-container-${this.getMainPhotosIndex()}`;
            const photos = [];

            // Assigning the main photo
            const mainPhoto = document.querySelector(
                `${mainPhotoClass} > input[type='file']`
            );

            if (mainPhoto != null) {
                main = mainPhoto.files[0];
            }

            // Assigning other photos than are not main
            const photosInputs = document.querySelectorAll(
                ".filesGroup > .relative > input[type='file']"
            );

            photosInputs.forEach((pi) => {
                if (
                    !pi.parentElement.classList.contains(
                        mainPhotoClass.substring(1)
                    )
                ) {
                    photos.push(pi.files[0]);
                }
            });

            const allPhotos = { main, photos };

            return allPhotos;
        },
        validatePhotos() {
            if (this.getPhotos().main == null) {
                return (this.areFilesValid = false);
            }

            this.areFilesValid = true;
        },
        async sendRequest(next = false) {
            if (next) this.nextSlide();

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

            // The property photo form data
            let photosError = false;
            const f = this.getPhotos();

            // return;
            const mainPhotoFormData = new FormData();
            mainPhotoFormData.append("File", f.main);
            mainPhotoFormData.append("property_id", response.property_id);
            mainPhotoFormData.append("is_main", 1);
            const mainPhotoRequest = await fetch(
                "http://travel-agency.test/photos",
                {
                    method: "POST",
                    body: mainPhotoFormData,
                }
            );

            const mainPhotoResponse = await mainPhotoRequest.text();

            console.log("Main Photo", mainPhotoResponse);

            if (mainPhotoResponse.status != "finished") {
                photosError = true;
            }

            console.log("the length", f.photos.length);

            for (let i = 0; i < f.photos.length; i++) {
                const photosFormData = new FormData();
                photosFormData.append("File", f.photos[i]);
                photosFormData.append("property_id", response.property_id);
                mainPhotoFormData.append("is_main", 0);

                const photoRequest = await fetch(
                    "http://travel-agency.test/photos",
                    {
                        method: "POST",
                        body: photosFormData,
                    }
                );

                const photoResponse = await photoRequest.json();
                console.log("Photos", photoResponse);

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
