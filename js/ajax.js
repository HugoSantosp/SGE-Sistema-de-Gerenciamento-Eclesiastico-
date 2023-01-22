function inserir(){
        $('#mensagem').text('');
        $('#tituloModal').text('Inserir Registro');

        var myModal = new bootstrap.Modal(document.getElementById('modalForm'), 
        {
            backdrop: 'static',
        })
        myModal.show();
        Limpar();
}





  function deletar(id, nome){
    $('#id-excluir').val(id);
    $('#nome-excluido').text(nome);
    var myModal = new bootstrap.Modal(document.getElementById('modalExcluir'));
     myModal.show();
     $('#mensagem-excluir').text('');
     Limpar();

}






 $(document).ready(function(){
     $('#exemplo').DataTable({
         "ordering":false
     });
 });




function CarregarImagem(){
    var target  = document.getElementById('target');
    var file = document.querySelector("input[type=file]").files[0];
    var arquivo = file['name'];
    resultado = arquivo.split(".", 2);

    console.log(arquivo);

    if(resultado[1] === 'pdf'){
            $('#target').attr('scr',"../img/img-user/pdf.png");
    
            return;
    }

    var reader = new FileReader();
    reader.onloadend = function(){
        target.src = reader.result;
        
    };
    
    if(file){
        reader.readAsDataURL(file);

    }else{
        target.src = "";
      
    }
}





/* function CarregarImagemUsu(){
    var target  = document.getElementById('target-usu');
    var file = document.querySelector("#imagem-usu").files[0];
    var arquivo = file['name'];
    resultado = arquivo.split(".", 2);

     if(resultado[1] === 'pdf'){
            $('#target-usu').attr('scr',"../img/img-user/pdf.png");
            return;
    }

    var reader = new FileReader();
    reader.onloadend = function(){
        target.src = reader.result;
    };
    
    if(file){
        reader.readAsDataURL(file);

    }else{
        target.src = "";
    }
} */








