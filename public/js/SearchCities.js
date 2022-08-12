class Cities {
    AIClass;
    CitiesItemClass;
    options = {
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': '493cf8b598mshf605a0fcd39ce7dp16fde7jsnf14f9082dc33',
            'X-RapidAPI-Host': 'spott.p.rapidapi.com'
        }
    };

    constructor(parent, callbacks){
        this.parent = parent;
        this.callbacks = callbacks;
        this.AIClass = new ActivityIndicator(this.parent);
        this.CitiesItemClass = new CitiesItem(this.callbacks, this.parent, []);
    }

    async fetchCities(query) {
        // Add Indicator
        this.AIClass.addActivityIndicator();
        this.callbacks.closeAllLists();
     
        // Fetch
        const request = await fetch(`https://spott.p.rapidapi.com/places/autocomplete?limit=10&skip=0&q=${query}&type=CITY`, this.options);
        const response = await request.json();

        const cities = [];
        
        response.forEach(city => {
            const info = {id: city.id, city: city.name, country: city.country.name};

            cities.push(info);
        });

        this.AIClass.removeActivityIndicator();
        this.CitiesItemClass.refreshCountries(cities);
        this.CitiesItemClass.refreshCities();

    }    
}