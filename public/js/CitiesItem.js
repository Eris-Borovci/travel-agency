class CitiesItem {
    countries;
    callbacks;

    constructor(callbacks, inp, countries) {
        this.callbacks = callbacks;
        this.inp = inp;
        this.countries = countries;
    }

    refreshCountries(cnt) {
        this.countries = cnt;
    }

    closeLists() {
        this.callbacks.closeAllLists();
    }

    noResults() {}

    refreshCities() {
        var a,
            b,
            i,
            val = inp.value;
        /*close any already open lists of autocompleted values*/
        this.callbacks.closeAllLists();
        if (!val) {
            removeActivityIndicator();
            return false;
        }
        this.callbacks.changeCurrent(-1);
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", inp.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        inp.parentNode.appendChild(a);
        /*for each item in the countriesay...*/
        /* Checking if there is no result found */
        console.log(this.countries);
        if (this.countries.length < 1) {
            let b = document.createElement("DIV");
            b.style.textAlign = "center";

            const message = document.createElement("P");
            message.innerHTML = "No city found";
            message.classList.add("text-gray-400");

            b.appendChild(message);
            a.appendChild(b);

            return;
        }

        for (let i = 0; i < this.countries.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            //   if (this.countries[i].city.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            b.style.display = "flex";
            b.classList.add("city-item");

            const markerIconContainer = document.createElement("DIV");
            markerIconContainer.style.display = "flex";
            markerIconContainer.style.alignItems = "center";
            const makerIcon = `<svg class="h-8 w-8 marker-icon text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                `;
            markerIconContainer.innerHTML = makerIcon;
            b.appendChild(markerIconContainer);

            const infoContainer = document.createElement("DIV");
            infoContainer.classList.add("px-3");

            const cityInfo = document.createElement("DIV");
            cityInfo.classList.add("font-semibold");
            cityInfo.innerHTML = this.countries[i].city;

            const countryContainer = document.createElement("DIV");
            countryContainer.classList.add("text-gray-400");
            countryContainer.innerHTML = this.countries[i].country;

            infoContainer.appendChild(cityInfo);
            infoContainer.appendChild(countryContainer);

            b.appendChild(infoContainer);

            /*insert a input field that will hold the current countriesay item's value:*/
            b.innerHTML +=
                "<input type='hidden' value='" + this.countries[i].city + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function (e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                // this.callbacks.closeAllLists();
            });
            a.appendChild(b);
        }
    }

    // no
}
