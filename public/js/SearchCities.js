class Cities {
    AIClass;
    CitiesItemClass;
    Type;
    callbacks;

    LastCities = [];
    options = {
        method: "GET",
        headers: {
            "X-RapidAPI-Key":
                "13e84508e6msh02d2937822591edp12b752jsn846b77ed23db",
            "X-RapidAPI-Host": "spott.p.rapidapi.com",
        },
    };

    constructor(parent, type) {
        this.parent = parent;
        this.AIClass = new ActivityIndicator(this.parent);
        this.Type = type;
    }

    bindCallbacks(callbacks) {
        this.callbacks = callbacks;
        this.CitiesItemClass = new CitiesItem(this.callbacks, this.parent, []);
    }

    async fetchCities(query) {
        // Stopping the fetch so it doesnt spend my requests
        // return;

        // Add Indicator
        this.AIClass.addActivityIndicator();
        this.callbacks.closeAllLists();

        // Fetch
        const request = await fetch(
            `https://spott.p.rapidapi.com/places/autocomplete?limit=10&skip=0&q=${query}&type=CITY`,
            this.options
        );
        const response = await request.json();

        const cities = [];

        console.log(response);

        response.forEach((city) => {
            const info = {
                id: city.id,
                city: city.name,
                country: city.country.name,
            };

            cities.push(info);
        });

        this.LastCities = cities;
        this.AIClass.removeActivityIndicator();
        this.CitiesItemClass.refreshCountries(cities);
        this.CitiesItemClass.refreshCities();
    }
}
