async function carregar_orgao(valor) {
    if (valor.length >= 3) {
        //console.log("Pesquisar:" + valor);
        const dados = await fetch('/Orgao/orgao?orgao='+valor, {
            method: "get",
            headers: {
              "Content-Type": "application/json",
              "X-Requested-With": "XMLHttpRequest"
            }
        });
        const resposta = await dados.json();
        
        //console.log(resposta);
        let html = "<ul class='list-group '>";
       const lis= resposta.map(({ nome_orgao, id_org }) => "<li class='list-group-item list-group-item-action' data-id='"+id_org+"'>" + nome_orgao+ "</li>")
        //console.log(lis);

        html += lis.join('') + "</ul>";
        resultado_pesquisa.innerHTML = html;
        //console.log(resultado_pesquisa)
    }
}
resultado_pesquisa.addEventListener('click', ({ target }) => {
    if (target.matches('li')) {
        
        fk_orgao.value = target.dataset.id
        orgao.value = target.innerText
        resultado_pesquisa.innerHTML=''
        //console.log(target)
    }
    
})