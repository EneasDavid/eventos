const salvarTag=document.querySelector("[salvar]");
const salvarTagPopUp=document.querySelector("[popUp-cadastrar-tag]");
const localizar=document.querySelector("[popUp-localizar-tag]");

  function chamaPopUp(){
    salvarTagPopUp.classList.add("aparecer");
  }
  function removerPopUp(){
    salvarTagPopUp.classList.remove("aparecer");
  }
  function removerlocalizarPopUp(){
    localizar.classList.remove("aparecer");
  }