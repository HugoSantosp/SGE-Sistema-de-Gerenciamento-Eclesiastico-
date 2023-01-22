<?php
date_default_timezone_set('America/Sao_Paulo');
    $banco = "igreja";
    $servidor = "localhost";
    $user = "root";
    $password = "";

    $email_super_adm = "hugosantospereira11@gmail.com";
    $nome_igreja = "Restitui Church São João de Meriti";
    $endereco_igreja = "Rua A";
    $telefone_igreja = "(21) 2692-7686";

    /// Variaveis globais

    $quantidade_tarefas = 20; // exibir  as proximas 20 tarefas no painel home/igreja

    

try{
    $pdo = new PDO("mysql:dbname=$banco;host=$servidor", "$user", "$password");
    
}catch (Exception $e){
    echo "Erro ao Conmectar ao Banco de dados <br><br>" . $e;
}

    // INSERIR INFORMQAÇÕES INICIAIS



    //criar um pastor presidente padrão

    $consulta = $pdo -> query("SELECT * FROM bispos");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $total = count($result);
    if($total == 0){
        $consulta = $pdo -> query("INSERT INTO bispos SET nome = 'Super ADM', email = '$email_super_adm', documento = '162.289.037-05', telefone = '(21)9-9492-7680',endereco = 'Rua Benedita', foto = 'logorestitui.png', data_nasc = 'curDate()', data_cad = 'curDate()'");
    }

/*     INSERT INTO bispos SET nome = 'Super ADM', email = '$email_super_adm', documento = '162.289.037-05', telefone = '(21)9-9492-7680',endereco = 'Rua Benedita', foto = 'logorestitui.png', data_nasc = 'curDate()', data_cad = 'curDate()'

INSERT INTO bispos (nome, email, documento, telefone, endereco,foto,data_nasc,data_cad) VALUES('Super ADM','$email_super_adm','162.289.037-05','(21)9-9492-7680','Rua Benedita','logorestitui.pnh',curDate(),curDate();
 */    


// Criar um Usuario padrão Relacionado ao Pastro Presidente
    $consulta = $pdo -> query("SELECT * FROM usuario");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $total = count($result);
    if($total == 0){
        $pdo -> query("INSERT INTO usuario (nome, documento, email, senha, nivel, id_pessoa,foto) VALUES('Super ADM','162.289.037-05','$email_super_adm','123','Pastor Presidente', '1','logorestitui.png');");
    }

// Criar uma Igreja Matriz
    $consulta = $pdo -> query("SELECT * FROM igrejas");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $total = count($result);
    if($total == 0){
        $pdo -> query("INSERT INTO igrejas (nome, endereco, obs, foto, telefone, matriz) VALUES('$nome_igreja','$endereco_igreja','Sem Observações','logorestitui.pnh','$telefone_igreja', 'Sim');");
    }

    // Criar um Cargo 
    $consulta = $pdo -> query("SELECT * FROM cargos");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $total = count($result);
    if($total == 0){
        $pdo -> query("INSERT INTO cargos (nome) VALUES('Membro');");
    }
    
    
    //variaveis padrões 

    $consulta = $pdo -> query("SELECT * FROM config");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $total = count($result);

    

    if($total == 0){
        $pdo -> query("INSERT INTO config (nome, valor) VALUES('email_super_adm', '$email_super_adm');");
        $pdo -> query("INSERT INTO config (nome, valor) VALUES('nome_igreja', '$nome_igreja');");
        $pdo -> query("INSERT INTO config (nome, valor) VALUES('endereco_igreja', '$endereco_igreja');");
        $pdo -> query("INSERT INTO config (nome, valor) VALUES('telefone_igreja', '$telefone_igreja');");
        $pdo -> query("INSERT INTO config (nome, valor) VALUES('qtd_tarefa', '$quantidade_tarefas');");
    }


    //BUSCAR INFORMAÇÕES DO BANCO DE DADOS
    $consulta = $pdo -> query("SELECT * FROM config WHERE nome = 'email_super_adm'");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $email_super_adm = $result[0]['valor'];


    $consulta = $pdo -> query("SELECT * FROM config WHERE nome = 'nome_igreja'");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $nome_igreja = $result[0]['valor'];



   

?>