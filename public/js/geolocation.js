let locationButton = document.getElementById("get-location");

if('geolocation' in navigator){
    const watcher = navigator.geolocation.watchPosition( function (position){
        locationButton.addEventListener("click", () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showLocation,checkError);
            }
        });
        const showLocation = async (position) => {
            let response = await fetch(
              `https://nominatim.openstreetmap.org/reverse?lat=${position.coords.latitude}&lon=${position.coords.longitude}&format=json`
            );
            let data = await response.json();
            const urlParams = new URLSearchParams(window.location.search);
            switch(data.address.state){
                case 'Acre':
                     $uf="AC";
                     break;
                case 'Alagoas':
                     $uf="AL";
                     break;
                case 'Amapá':
                    $uf="AP";
                    break;
                case 'Amazonas':
                        $uf="AM";
                    break;
                case 'Bahia':
                     $uf="BA";
                     break;
                case 'Ceará':
                     $uf="CE";
                     break;
                case 'Distrito Federal':
                    $uf="DF";
                    break;
                case 'Espírito Santo':
                    $uf="ES";
                    break;
                case 'Goiás':
                    $uf="GO";
                    break;
                case 'Maranhão':
                    $uf="MA";
                    break;
                case 'Mato Grosso':
                    $uf="MT";
                    break;
                case 'Mato Grosso do Sul':
                    $uf="MS";
                    break;
                case 'Minas Gerais':
                    $uf="MG";
                    break;
                case 'Pará':
                    $uf="PA";
                    break;
                case 'Paraíba':
                    $uf="PB";
                    break;
                case 'Paraná':
                    $uf="PR";
                    break;
                case 'Pernambuco':
                    $uf="PE";
                    break;
                case 'Piauí':
                    $uf="PI";
                    break;
                case 'Rio de Janeiro':
                    $uf="RJ";
                    break;
                case 'Rio Grande do Norte':
                    $uf="RN";
                    break;
                case 'Rio Grande do Sul':
                    $uf="RS";
                    break;
                case 'Rondônia':
                    $uf="RO";
                    break;
                case 'Roraima':
                    $uf="RR";
                    break;
                case 'Santa Catarina':
                    $uf="SC";
                    break;
                case 'São Paulo':
                    $uf="SP";
                    break;
                case 'Sergipe':
                    $uf="SE";
                    break;
                case 'Tocantins':
                    $uf="TO";
            }
            urlParams.set('s',$uf);
            window.location.search = urlParams;
        };
        const checkError = (error) => {
            switch (error.code) {
              case error.PERMISSION_DENIED:
                locationDiv.innerText = "Por favor permita que localizemos sua localização!";
                break;
              case error.POSITION_UNAVAILABLE:
                //usually fired for firefox
                locationDiv.innerText = "Localização invalida!";
                break;
              case error.TIMEOUT:
                locationDiv.innerText = "Localização muito antiga";
            }
        };
        })
}else{
    alert ('ops, não foi possível pegar localização')
}

