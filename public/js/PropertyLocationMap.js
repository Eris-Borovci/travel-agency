if (marker_coords.lon == undefined) {
    marker_coords.lon = marker_coords.lng;
}

const map = L.map("map").setView([marker_coords.lat, marker_coords.lon], 10);

L.tileLayer(
    "https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=ssVRaMfqFIYA1Om5wsEo",
    {
        attribution:
            '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
    }
).addTo(map);

let marker = L.marker([marker_coords.lat, marker_coords.lon], {
    draggable: false,
}).addTo(map);

document.querySelector("#relocate").addEventListener("click", () => {
    map.setView([marker_coords.lat, marker_coords.lon], 17);
});
