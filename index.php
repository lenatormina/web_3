<?php
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);
	header('Content-Type: text/html; charset=UTF-8');
	

	

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	    if (!empty($_GET['save'])) {
	        print('Спасибо, форма сохранена.');
	    }
	    include('form.html');
	    exit();
	}
	

	$errors = FALSE;
	if (empty($_POST['name'])) {
	    print('Напишите ФИО.<br/>');
	    $errors = TRUE;
	}
	

	if (empty($_POST['email'])) {
	    print('Напишите почту.<br/>');
	    $errors = TRUE;
	}
	

	if (empty($_POST['birth'])) {
	    print('Напишите свой день рождения.<br/>');
	    $errors = TRUE;
	}
	

	if ( empty($_POST['sex']) ) {
	    print('Укажите пол.<br/>');
	    $errors = TRUE;
	}
	

	switch($_POST['sex']) {
	    case 'male': {
	        $sex='m';
	        break;
	    }
	    case 'female':{
	        $sex='f';
	        break;
	    }
	};
	

	

	if (empty($_POST['limbs'])) {
	    print('Укажите количество конечностей.<br/>');
	    $errors = TRUE;
	}
	

	switch($_POST['limbs']) {
	    case '1': {
	        $limbs='1';
	        break;
	    }
	    case '2':{
	        $limbs='2';
	        break;
	    }
	    case '3':{
	        $limbs='3';
	        break;
	    }
	    case '4':{
	        $limbs='4';
	        break;
	    }
	};
	

	if (empty($_POST['power'])) {
	    print('Укажите хоть одну суперспособность.<br/>');
	    $errors = TRUE;
	}
	

	$power1=in_array('undeath',$_POST['power']) ? '1' : '0';
	$power2=in_array('walls',$_POST['power']) ? '1' : '0';
	$power3=in_array('levitation',$_POST['power']) ? '1' : '0';
	

	if (empty($_POST['bio'])) {
	    print('Напишите кратко биографию.<br/>');
	    $errors = TRUE;
	}
	

	if (empty($_POST['agree'])) {
	    print('Вы не согласились с условиями контракта!<br/>');
	    $errors = TRUE;
	}
	$agree = 'agree';
	

	if ($errors) {
	    exit();
	}
	

	$user = 'u47596';
	$pass = '9963761';
	$db = new PDO('mysql:host=localhost;dbname=u47596', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
	

	try {
	    $stmt = $db->prepare("INSERT INTO application SET name = ?, email = ?, birth = ? ,sex = ?, limbs = ?, undeath = ?, walls = ? ,levitation =?, bio = ?, agree = ?");
	    $stmt -> execute(array($_POST['name'],$_POST['email'],$_POST['birth'],$sex,$limbs,$power1,$power2,$power3,$_POST['bio'], $agree));
	}
	catch(PDOException $e){
	    print('Error : ' . $e->getMessage());
	    exit();
	}
	

	header('Location: ?save=1');
