window.initMap = (dams) => {
    if (!dams || dams.length === 0) return;

    const mapElement = document.getElementById('map');
    if (!mapElement) return;

    const map = L.map('map', {
        zoomControl: false // desativa o controle padrão
    }).setView([-15, -55], 4);

// Adiciona o controle de zoom no canto inferior direito
    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, Maxar, Earthstar Geographics',
        maxZoom: 17
    }).addTo(map);

    const markers = [];

    dams.forEach(dam => {
        const {
            latitude,
            longitude,
            name,
            street,
            number,
            neighborhood,
            city,
            state,
            psb_link,
            client_name,
            client_email
        } = dam;

        const popupContent = `
            <strong>${name}</strong><br>
            ${street || ''}${number ? ', ' + number : ''}<br>
            ${neighborhood || ''}${city || '' ? ', ' + city : ''}${state || '' ? '/' + state : ''}<br><br>
            <a href="${psb_link || '#'}" target="_blank" class="text-blue-500 underline">Link PSB</a><br>
            <span><strong>Cliente:</strong> ${client_name || 'N/A'} (${client_email || 'sem email'})</span>
        `;

        const marker = L.marker([latitude, longitude]).addTo(map);
        marker.bindPopup(popupContent);
        markers.push(marker);
    });

    if (markers.length > 0) {
        const group = L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.2), {
            maxZoom: 23 // não dá zoom demais
        });
    }

};

/*document.addEventListener('livewire:load', () => {
    const initMap = async () => {
        const mapElement = document.getElementById('map');
        if (!mapElement) return;

        // Inicializa o mapa
        const map = L.map('map').setView([0, 0], 5); // Inicial com zoom genérico

        // Adiciona camada base (pode customizar com outra se quiser)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        try {
            const response = await fetch('/api/barragens');
            const result = await response.json();

            if (!result.success) {
                console.error('Erro ao carregar barragens:', result.message);
                return;
            }

            const barragens = result.data;
            const markers = [];

            barragens.forEach(barragem => {
                const {
                    latitude,
                    longitude,
                    name,
                    street,
                    number,
                    neighborhood,
                    city,
                    state,
                    psb_link,
                    client_name,
                    client_email
                } = barragem;

                // Cria marcador
                const marker = L.marker([latitude, longitude]).addTo(map);

                // Prepara o conteúdo do popup
                const popupContent = `
                    <strong>${name}</strong><br>
                    ${street || ''}${number ? ', ' + number : ''}<br>
                    ${neighborhood || ''}${city || '' ? ', ' + city : ''}${state || '' ? '/' + state : ''}<br><br>
                    <a href="${psb_link || '#'}" target="_blank" class="text-blue-500 underline">Link PSB</a><br>
                    <span><strong>Cliente:</strong> ${client_name || 'N/A'} (${client_email || 'sem email'})</span>
                `;

                marker.bindPopup(popupContent);
                markers.push(marker);
            });

            // Ajusta o mapa para abranger todos os marcadores
            if (markers.length > 0) {
                const group = L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.2));
            }

        } catch (error) {
            console.error('Erro ao buscar barragens:', error);
        }
    };

    // Delay mínimo para garantir que Alpine/Livewire já montaram o DOM
    setTimeout(initMap, 100);
});*/
