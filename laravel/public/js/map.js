var map = L.map('map').setView([52.228, 5.420], 7);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 18,
attribution: '© OpenStreetMap'
}).addTo(map);
