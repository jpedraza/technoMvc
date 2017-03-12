<?php 

if ($_POST) {
	require('core/core.php');
	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'login':
			require('core/bin/ajax/goLogin.php');
			break;		
		case 'reg':
			require('core/bin/ajax/goReg.php');
			break;	
		case 'lostpass':
			require('core/bin/ajax/goLostpass.php');
			break;	
		case 'addpro':
			require('core/bin/ajax/goAddpro.php');
			break;	
		case 'edipro':
			require('core/bin/ajax/goEdipro.php');
			break;	
		case 'ediperfil':
			require('core/bin/ajax/ediPerfil.php');
			break;
		case 'editpass':
			require('core/bin/ajax/editPass.php');
			break;
		case 'addUserAdm':
			require('core/bin/ajax/addUserAdm.php');
			break;
		case 'editUserAdm':
			require('core/bin/ajax/editUserAdm.php');
			break;	
		case 'promocionAdd':
			require('core/bin/ajax/goAddpromo.php');
			break;	
		case 'promocionEdi':
			require('core/bin/ajax/goEdipromo.php');
			break;	
		case 'busPro':
			require('core/bin/ajax/busPro.php');
			break;	
		case 'confirmCheck':
			require('core/bin/ajax/goCheckConfirm.php');
			break;	
		default:	
		case 'confirmCompra':
			require('core/bin/ajax/goConfirmCompra.php');
			break;	
		default:
			header('location: home/');
			break;
	}
} else {
	header('location: contacto/');
}

?>