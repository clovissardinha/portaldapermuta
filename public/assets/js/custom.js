grecaptcha.ready(function () {
    //recuperar a chave sitekey
    var siteKey = document.getElementById('siteKey').value;
    
   // enviar o sitekey e a homepage para o google e obter a chave
    grecaptcha.execute(siteKey, {action: 'submit'}).then(function(token) {       
        //retornar a chave para o google
        document.getElementById('g-recaptcha-response').value=token;
    }); 
  });