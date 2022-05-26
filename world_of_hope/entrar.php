
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,
     initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS --> 
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

     <!--Estilo CSS --> 
     <link rel="stylesheet" href="./assets/css/login.css">

      <!--Favicon-->
      <link rel="apple-touch-icon" sizes="180x180" href="./assets/recursos_de_design/logo/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="./assets/recursos_de_design/logo/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="./assets/recursos_de_design/logo/favicon-16x16.png">
      <link rel="manifest" href="/site.webmanifest">
 

    <title>World of Hope</title>
  </head>
                    
  <body>
      
    <div class="container">  
      
      <div class="form-group">
        <form method="post" action="login.php">
          <h1 class="display-4">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!--Gambiarra temporária-->
          </h1>
          <br>
          
          
          <label for=""></label>
          E-mail:<input class="form-control" type="email" id="email" name="email" placeholder="Digite seu e-mail"><br>
          <label for=""></label>
          Senha:<input  class="form-control" type="password" id="senha" name="senha" placeholder="Digite sua senha"><br>
          <button type="submit" value="entrar" class="btn btn-success">Entrar</button>
        </form>
        <br> 
        <a href="#">
          Recuperar senha
        </a>
        <br>
        <br>
      </div>
    </div>
  


    
    <?php
    //login.php
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    try{
        $conexao = new PDO('mysql:host=localhost;dbname=projetox',
        "root", "");//criando query para consultar no banco de dados
        $sql = "SELECT * FROM usuario where senha=? and login=? ";
        //cria sql com duas variaveis de entrada
        $stmt = $conexao->prepare($sql);//prepara sql a ser executada
        $stmt->bindValue(1,$senha);//associa o valor senha a 1a interrogação
        $stmt->bindValue(2,$login);//associa o valor senha a 2a interrogação?
        $stmt->execute();//executa comando sql
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if($usuario== null || empty($usuario)){
            // se o usuario for nulo ou vazio:
            header("location:formLogin.php?msg=Login ou senha errado!");
            //redireciona para a pagina formLogin.php
        }else{
            //senão significa que o usuario foi encontrado
            session_start();//inicializando a sessão
            $_SESSION["nome"]  =$usuario["nome"];
            $_SESSION["login"] =$usuario["login"];
            $_SESSION["perfil"]=$usuario["perfil"];
            header("location:home.php");
        }
        //recupera a 1a linha do resultado e coloca na variavel $usuario
        //TODO : verificar se foi encontrado um usuario e criar sessao
    }catch(PDOException $e){
       echo $e->getMessage();
    }
    ?>





    <!--JS-->
    <script src="./assets/js/js/script.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
     integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
     integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous">
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js">
    </script>


  </body>
</html>