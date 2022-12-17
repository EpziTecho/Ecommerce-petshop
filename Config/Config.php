<?php 
	
	//define("BASE_URL", "http://localhost/petshop/");
	//const BASE_URL = "http://localhost:8090/petshop-utp";
	// const BASE_URL = "http://localhost:8080/petshop-utp";
	const BASE_URL = "https://ohmypet.epzi.tech";

	//Zona horaria
	date_default_timezone_set('America/Lima');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "u363990101_db_petshop";
	const DB_USER = "u363990101_user_petshop";
	const DB_PASSWORD = "PassPetShop1";
	const DB_CHARSET = "charset=utf8";

	//Datos Empresa

	const DIRECCION = "DIRECCION DE EJEMPLO";
	const TELEFONOEMPRESA = "123456789";
	const WHATSAPP = "51902216601";
	const EMAIL_EMPRESA = "no-reply@ohmypetpetshop.com";
	const EMAIL_PEDIDOS= "no-reply@ohmypetpetshop.com";
	const EMAIL_SUSCRIPCION="ohmypet@gmail.com";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "S/. ";

	//Datos envios de correos
	const NOMBRE_REMITENTE = "Oh my pet ! Petshop";
	const EMAIL_REMITENTE = "no-reply@ohmypetpetshop.com";
	const NOMBRE_EMPRESA = "Oh my pet!";
	const WEB_EMPRESA = "www.ohmypetpetshop.com";

	const CAT_SLIDER = "1,2,3"; //categorias que se van a mostrar en el slider
	const CAT_BANNER = "1,2,3"; //categorias que se van a mostrar en el banner

	//Datos para Encriptar / Desencriptar
	const KEY = 'abelosh';
	const METHODENCRIPT = "AES-128-ECB";

	//Envío
	const COSTOENVIO = 0;

	//MODULOS (constantes de la bd)

	const MDCONTACTOS=8;
	const MDPAGINAS=11;
	//Modulos
	const MCLIENTES = 3;
	const MPEDIDOS = 5;
	const RADMINISTRADOR = 1;
	const RCLIENTES = 7;
	const STATUS = array('Completo','Aprobado','Cancelado','Reembolsado','Pendiente');
	const MDLIBRORECLAMACIONES =13;


	//paginas, id de la bd
	const PINICIO=1;
	const PTIENDA=2;
	const PCARRITO=3;
	const PNOSOTROS = 4;
	const PCONTACTO=5;
	const PPREGUNTAS=6;
	const PTERMINOS=7;
	const PERROR=8;
	const PLIBRORECLAMACIONES=10;




	//Pasarela de pagos Paypal
	const CLIENT_ID_PRUEBA = "AZcYe702r7DtTvTf6-a82gVKrz0WYh0SXeiYVJ3qVUH328bbUAdBYWbebQo0thE9K1oIC_wubjxuTaE3";
	const CLIENT_ID_PRODUCCION = "ASNt8KMY0cuN70GQ7Du5vbtu2CBa-WKX2zDXgUSkVfob7uFx0WOu0MorqWkvIj8c_IfPScwpCLiugglK";
	const CURRENCY = "USD";
	/*const SECRET = "ENfB22-uxJNhxRLunp1I5uwtrbcXoMfIZrMVjODx2oFp5RN9QE2eolW7kgDIirHm25GhnlAWipDpitr-";*/
	 const SECRET ="EGCI6c5dN4SHimd2-_MhHEsXIlosnuGUDFOiznkmfxIm9Xjgzfk7SqHfxJb-7U_nYGK2n5cjhJebsPx-";
	/*
		Correo Paypal Pruebas
			Email: sb-yofmr21494532@personal.example.com
			password: 12345678
	    
		Tarjeta Paypal Pruebas
			Card Type: Visa
			Card Number: 4032036437141037
			Expiration Date: 08/2024
			CVV: 137
	*/
	//SANDBOX PAYPAL
	/*const URLPAYPAL = "https://api-m.sandbox.paypal.com";*/
 	const URLPAYPAL= "https://api-m.paypal.com";
 ?>