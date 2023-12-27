let h2 = document.getElementById('location-info');

function success(pos) {
    const latitude = pos.coords.latitude;
    const longitude = pos.coords.longitude;

    // Verificar se o URL já possui uma UF
    const urlParams = new URLSearchParams(window.location.search);
    const existingUF = urlParams.get('s');

    if (existingUF) {
        // Se já existe uma UF, exibir apenas a mensagem
        h2.textContent = `UF: ${existingUF}`;
    } else {
        // Se não existe uma UF, chamar a função que converte as coordenadas para UF
        getUFFromCoordinates(latitude, longitude)
            .then(uf => {
                h2.textContent = `UF: ${uf}`;
            })
            .catch(error => {
                console.error(error);
                h2.textContent = "Erro ao obter a localização.";
            });
    }
}

function error(err) {
    console.error(err);
    h2.textContent = "Erro ao obter a localização.";
}

async function getUFFromCoordinates(latitude, longitude) {
    try {
        // Utilizando a API do OpenStreetMap (Nominatim) para obter informações de localização
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`);
        const data = await response.json();

        // Extrair a UF (state) dos dados obtidos
        const uf = convertStateToUF(data.address.state);

        // Atualizar a URL com a UF
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('s', uf);
        window.location.search = urlParams;

        return uf;
    } catch (error) {
        console.error("Erro ao obter UF:", error);
        throw error;
    }
}

function convertStateToUF(state) {
    // Lógica de conversão de estado para UF
    switch (state) {
        case 'Acre': return 'AC';
        case 'Alagoas': return 'AL';
        case 'Amapá': return 'AP';
        case 'Amazonas': return 'AM';
        case 'Bahia': return 'BA';
        case 'Ceará': return 'CE';
        case 'Distrito Federal': return 'DF';
        case 'Espírito Santo': return 'ES';
        case 'Goiás': return 'GO';
        case 'Maranhão': return 'MA';
        case 'Mato Grosso': return 'MT';
        case 'Mato Grosso do Sul': return 'MS';
        case 'Minas Gerais': return 'MG';
        case 'Pará': return 'PA';
        case 'Paraíba': return 'PB';
        case 'Paraná': return 'PR';
        case 'Pernambuco': return 'PE';
        case 'Piauí': return 'PI';
        case 'Rio de Janeiro': return 'RJ';
        case 'Rio Grande do Norte': return 'RN';
        case 'Rio Grande do Sul': return 'RS';
        case 'Rondônia': return 'RO';
        case 'Roraima': return 'RR';
        case 'Santa Catarina': return 'SC';
        case 'São Paulo': return 'SP';
        case 'Sergipe': return 'SE';
        case 'Tocantins': return 'TO';
        default: return 'Desconhecido';
    }
}

var watchID = navigator.geolocation.watchPosition(success, error, {
    enableHighAccuracy: true,
    timeout: 5000
});
