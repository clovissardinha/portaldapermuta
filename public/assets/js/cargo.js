async function carregar_cargo(valor) {
    if (valor.length >= 3) {
        //console.log("Pesquisar:" + valor);
        const dados = await fetch('/Cargo/cargo?cargo='+valor, {
            method: "get",
            headers: {
              "Content-Type": "application/json",
              "X-Requested-With": "XMLHttpRequest"
            }
        });
        const resposta = await dados.json();
        
        //console.log(resposta);
        let html = "<ul class='list-group '>";
       const lis= resposta.map(({ nome_cargo, id_cargos }) => "<li class='list-group-item list-group-item-action' data-id='"+id_cargos+"'>" + nome_cargo+ "</li>")
        //console.log(lis);

        html += lis.join('') + "</ul>";
        resultado_pesquisa.innerHTML = html;
        //console.log(resultado_pesquisa)
    }
}
resultado_pesquisa.addEventListener('click', ({ target }) => {
    if (target.matches('li')) {
        
        fk_cargo.value = target.dataset.id
        cargo.value = target.innerText
        resultado_pesquisa.innerHTML=''
        //console.log(target)
    }
    
})