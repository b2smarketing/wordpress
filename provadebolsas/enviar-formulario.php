<?php

ob_start();

require_once('sistema/library/conexao.php');

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require_once("backend_email/PHPMailerAutoload.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

$nome       = $_POST["userNome"];
$sobrenome       = $_POST["userSobrenome"];
$email       = $_POST["userEmail"];
$cpf        = $_POST["userCpf"];
$celular    = $_POST["userCelular"];
$data     	= $_POST["userData"];
$curso  	= $_POST["userCurso"];	

try{ 
    $sql = "INSERT INTO dados_provadebolsas2020(nome,
                sobrenome,
                email,
                cpf,
                celular,
                data,
                curso) VALUES (
                :nome,
                :sobrenome,
                :email,
                :cpf, 
                :celular,
                :data, 
                :curso)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $_POST['userNome'], PDO::PARAM_STR);
    $stmt->bindParam(':sobrenome', $_POST['userSobrenome'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $_POST['userEmail'], PDO::PARAM_STR);    
    $stmt->bindParam(':cpf', $_POST['userCpf'], PDO::PARAM_STR); 
    $stmt->bindParam(':celular', $_POST['userCelular'], PDO::PARAM_STR);
    $stmt->bindParam(':data', $_POST['userData'], PDO::PARAM_STR); 
    $stmt->bindParam(':curso', $_POST['userCurso'], PDO::PARAM_STR);   

    $result = $stmt->execute();

} catch(PDOException $exception){ 
    echo "Erro ao cadastrar. Por favor entrar em contato conosco informando o erro abaixo:<br/><br/>";
    echo $exception->getMessage(); 
    die();
} 

###### echo "O e-mail inserido é valido!"; #########
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
$mail->Username = "informativo@fam.br"; // Usuário do servidor SMTP (endereço de email)
$mail->Password = "&f4m2019@"; // Senha do servidor SMTP (senha do email usado)
$mail->Port = 465;
$mail->SMTPSecure = true; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
$mail->SMTPAutoTLS = true; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"

// Define o remetente	
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = "informativo@fam.br"; // Seu e-mail
$mail->Sender = "informativo@fam.br"; // Seu e-mail
$mail->FromName = utf8_decode("$nome"); // Seu nome

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

$mail->AddAddress("$email", "FAM - Faculdade de Americana");



// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = utf8_decode("Prova de Bolsas FAM 2020"); // Assunto da mensagem

$mail->Body = utf8_decode("<html>
<head>
<title>emkt mega desconto</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
</head>
<body bgcolor='#FFFFFF' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
<!-- Save for Web Slices (emkt mega desconto.psd) -->
<table id='Tabela_01' width='750' border='0' cellpadding='0' cellspacing='0'>
    <tr style='text-align: center;'>
        <td colspan='5'>
            <img src='http://provadebolsas.com.br/assets/img/logo-blue.png' style='margin-top: 20px;' alt='FAM 20 Anos'>
        </td>
    </tr>
    <!--
	<tr>
		<td colspan='5'>
			<img src='http://provadebolsas.com.br/emkt/emkt-mega-desconto_01.png' width='650' height='531' alt=''></td>
	</tr>
	<tr>
		<td colspan='5'>
			<img src='http://provadebolsas.com.br/emkt/emkt-mega-desconto_02.png' width='650' height='159' alt=''></td>
	</tr> -->
	<tr style='background: #fff; text-align: center; font-size: 18px; font-family: fantasy;'>
		<td colspan='5' style='padding: 30px;'>
            Parabéns, você se inscreveu para o PROVA DE BOLSAS FAM 2020! 
            <br><br>
            Essa é a sua oportunidade de garantir uma bolsa de até 100% de desconto.<br/>
            Sua prova será no dia 26/01, às 09h00 e tem duração máxima de 3h00.<br/>
			Não esqueça sua caneta preta ou azul fabricada em material transparente e documento com foto. 
			<br><br>
			A prova consiste em 15 questões de múltipla escolha sobre conhecimentos gerais e uma redação. 
			<br><br>
			Esperamos por você! Boa sorte!
		</td>
	</tr>
	<!--<tr>
		<td colspan='5'>
			<img src='http://provadebolsas.com.br/emkt/emkt-mega-desconto_03.png' width='650' height='323' alt=''></td>
	</tr>
	<tr>
		<td>
			<img src='http://provadebolsas.com.br/emkt/emkt-mega-desconto_04.png' width='368' height='144' alt=''></td>
		<td>
			<a href='https://www.facebook.com/famamericana' target='_blank'><img src='http://provadebolsas.com.br/emkt/emkt-mega-desconto_05.png' width='73' height='144' alt=''></a></td>
		<td>
			<a href='https://instagram.com/famamericana' target='_blank'><img src='http://provadebolsas.com.br/emkt/emkt-mega-desconto_06.png' width='57' height='144' alt=''></a></td>
		<td>
			<a href='https://www.youtube.com/channel/UCpk07TjMWhMr3Wv-bFnkk-A' target='_blank'><img src='http://provadebolsas.com.br/emkt/emkt-mega-desconto_07.png' width='56' height='144' alt=''></a></td>
		<td>
			<a href='https://www.linkedin.com/school/fam-faculdade-de-americana/' target='_blank'><img src='http://provadebolsas.com.br/emkt/emkt-mega-desconto_08.png' width='96' height='144' alt=''></a></td>
	</tr>-->
</table>
<!-- End Save for Web Slices -->
</body>
</html>
");

$mail->AltBody = 'Inscricao FAM 2020!';

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo

// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

// Exibe uma mensagem de resultado
if ($enviado) {
	echo "Obrigado pela sua inscrição!<br/>Em breve você receberá um e-mail de confirmação.<br/>Dúvidas entre em contato via WhatsApp (19) 99437-9555.";
} else {
	$data = array('type' => 'error', 'message' => 'erro');
	header('HTTP/1.1 400 N&atilde;o foi poss&iacute;vel enviar o e-mail. Informa&ccedil;&otilde;e do erro: ' . $mail->ErrorInfo);
	header('Content-Type: application/json; charset=UTF-8');
	echo json_encode($data);	
	//echo "Informacoes do erro: ". $mail->ErrorInfo;
}
?>	