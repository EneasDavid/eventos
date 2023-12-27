function initializeLocationGetter(elementId) {
    const element = document.getElementById(elementId);
    let watchID;

    async function success(pos) {
        const latitude = pos.coords.latitude;
        const longitude = pos.coords.longitude;

        try {
            const ufElement = element.querySelector('.uf-info');

            if (hasLocationBeenConsulted()) {
                const urlParams = new URLSearchParams(window.location.search);
                const existingUF = urlParams.get('s');
                ufElement.textContent = `UF: ${existingUF}`;
            } else {
                const uf = await getUFFromCoordinates(latitude, longitude);
                ufElement.textContent = `UF: ${uf}`;
                // Marcar a localização como consultada configurando um cookie
                document.cookie = 'locationConsulted=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';
            }
        } catch (error) {
            console.error("Erro ao obter a localização:", error);
            element.textContent = "Erro ao obter a localização.";
        }
    }

    function error(err) {
        console.error(err);
        element.textContent = "Erro ao obter a localização.";
    }

    element.addEventListener('click', async function () {
        if (watchID) {
            navigator.geolocation.clearWatch(watchID);
        }

        try {
            const pos = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject, {
                    enableHighAccuracy: true,
                    timeout: 5000
                });
            });

            success(pos);
        } catch (error) {
            error(error);
        }
    });

    async function getUFFromCoordinates(latitude, longitude) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`);
            const data = await response.json();
            const uf = convertStateToUF(data.address.state);

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

function hasLocationBeenConsulted() {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('s',$uf);
    window.location.search = urlParams
}

const locationGetter = initializeLocationGetter('getLocationButton');
