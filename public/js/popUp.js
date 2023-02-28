const salvarTag=document.querySelector("[salvar]");
const salvarTagPopUp=document.querySelector("[popUp-cadastrar-tag]");
const cadastroEvent=document.querySelector("[popUp-cadastrar-event]");

  function chamaPopUp(){
    salvarTagPopUp.classList.add("aparecer");
  }
  function chamaPopUpEvent(){
    cadastroEvent.classList.add("aparecer");
  }  
  function removerPopUpEvent(){
    cadastroEvent.classList.remove("aparecer");
  }
  function removerPopUp(){
    salvarTagPopUp.classList.remove("aparecer");
  }