import './bootstrap';

import Alpine from 'alpinejs';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import 'leaflet-draw';
import 'leaflet-draw/dist/leaflet.draw.css';

// Adiciona Alpine ao escopo global
window.Alpine = Alpine;
Alpine.start();

window.L = L;

document.addEventListener('DOMContentLoaded', () => {
    const mapElement = document.getElementById('map');

    if (!mapElement) {
        console.error("Elemento #map não encontrado!");
        return;
    }

    const map = L.map(mapElement, {
        center: [-19.675661176238506, -51.19287655887194],
        zoom: 18,
        minZoom: 15,
        maxZoom: 22,
        zoomControl: true,
        scrollWheelZoom: true,
        dragging: true
    });

    // Adiciona uma camada de mapa (tiles) do OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
});
