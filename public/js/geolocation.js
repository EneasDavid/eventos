// Obtém a referência do botão que irá pegar a localização do usuário
const locationButton = document.getElementById("get-location");

// Obtém a referência do elemento onde será mostrada a localização
const locationDiv = document.getElementById("location");

// Dicionário que relaciona o nome do estado completo com a sigla do estado
const stateToUf = {
  'Acre': 'AC',
  'Alagoas': 'AL',
  'Amapá': 'AP',
  'Amazonas': 'AM',
  'Bahia': 'BA',
  'Ceará': 'CE',
  'Distrito Federal': 'DF',
  'Espírito Santo': 'ES',
  'Goiás': 'GO',
  'Maranhão': 'MA',
  'Mato Grosso': 'MT',
  'Mato Grosso do Sul': 'MS',
  'Minas Gerais': 'MG',
  'Pará': 'PA',
  'Paraíba': 'PB',
  'Paraná': 'PR',
  'Pernambuco': 'PE',
  'Piauí': 'PI',
  'Rio de Janeiro': 'RJ',
  'Rio Grande do Norte': 'RN',
  'Rio Grande do Sul': 'RS',
  'Rondônia': 'RO',
  'Roraima': 'RR',
  'Santa Catarina': 'SC',
  'São Paulo': 'SP',
  'Sergipe': 'SE',
  'Tocantins': 'TO'
};

// Função que será chamada quando a localização do usuário for obtida
const showLocation = async (position) => {
  try {
    // Monta a URL para obter o endereço a partir das coordenadas
    const url = `https://nominatim.openstreetmap.org/reverse?lat=${position.coords.latitude}&lon=${position.coords.longitude}&format=json`;
    
    // Faz a requisição para obter os dados do endereço
    const response = await fetch(url);
    
    // Converte a resposta em JSON
    const data = await response.json();
    
    // Obtém a sigla do estado a partir do nome completo do estado
    const uf = stateToUf[data.address.state];
    
    // Se a sigla do estado foi obtida com sucesso
    if (uf) {
      // Adiciona a sigla do estado aos parâmetros da URL e recarrega a página
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set("s", uf);
      window.location.search = urlParams;
    } else {
      // Se a sigla do estado não foi encontrada, exibe uma mensagem de erro
      locationDiv.innerText = "Não foi possível obter o código do estado.";
    }
  } catch (error) {
    // Se ocorreu um erro ao obter os dados do endereço, exibe uma mensagem de erro
    console.error(error);
    locationDiv.innerText = "Ocorreu um erro ao obter a localização.";
  }
};


// Função para tratar erros ao obter a localização do usuário
const checkError = (error) => {
    switch (error.code) {
      case error.PERMISSION_DENIED:
        // Permissão de localização negada pelo usuário
        locationDiv.innerText = "Por favor permita que localizemos sua localização!";
        break;
      case error.POSITION_UNAVAILABLE:
        // Localização indisponível
        locationDiv.innerText = "Localização inválida!";
        break;
      case error.TIMEOUT:
        // Timeout na obtenção da localização
        locationDiv.innerText = "Localização muito antiga";
        break;
     default:
        // Caso ocorra algum erro desconhecido, exibe uma mensagem de erro genérica
        locationDiv.innerText = "Ocorreu um erro ao obter a localização.";
      break;
  }
};

const getLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showLocation, checkError);
  } else {
    locationDiv.innerText = "Ops, não foi possível pegar a localização.";
  }
};

locationButton.addEventListener("click", getLocation);