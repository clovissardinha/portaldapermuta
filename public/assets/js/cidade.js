async function carregar_cidade(valor) {
    if (valor.length >= 3) {
        //console.log("Pesquisar:" + valor);
        const dados = await fetch('/Cidade/city?cidade='+valor, {
            method: "get",
            headers: {
              "Content-Type": "application/json",
              "X-Requested-With": "XMLHttpRequest"
            }
        });
        const resposta = await dados.json();
        
        //console.log(resposta);
        let html = "<ul class='list-group '>";
       const lis= resposta.map(({ cid_nome, cid_uf, cid_id }) => "<li class='list-group-item list-group-item-action' data-id='"+cid_id+"'>" + cid_nome + '-' + cid_uf + "</li>")
        
        html += lis.join('') + "</ul>";
        resultado_pesquisa.innerHTML = html;
        //console.log(resultado_pesquisa)
    }
}
resultado_pesquisa.addEventListener('click', ({ target }) => {
    if (target.matches('li')) {
        cidade.value = target.innerText
        fk_cidade.value = target.dataset.id
        resultado_pesquisa.innerHTML=''
        //console.log(target)
    }
    
})