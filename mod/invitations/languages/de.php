<?php

	/**
	 * Elgg invitations plugin
	 * Invite friends to this elgg site. With integrated walledgarden
	 * 
	 * @package 
	 * @license 
	 * @author 
	 * @author 
	 * @copyright 
	 * @copyright 
	 * @link 
	 */
		
		$german = array(
	
		
		/**
		 * Settings and Status
		 */
		
			'invitations:default:expdays' => "Wie lange sollen die Einladungen g&uuml;ltig sein",
			'invitations:default:walledgarden' => "Walledgarden aktivieren",
			'invitations:default:label:enable' => "aktivieren",
			'invitations:default:label:disable' => "deaktivieren",
			'invitations:default:enableforgottenpassword' => "Falls Walledgarden: erlaube Zugriff auf die Passwort-vergessen-Seiten",
			'invitations:default:enableregistration' => "Falls Walledgarden: erlaube Zugriff auf Standard-Registrierung und zeige den Link unter Loginformular",
			'invitations:default:email' => "Standard-Absender-Adresse (System-Mail-Adresse)",
			
			'invitations:default:allowedusers' => "Wer darf Einladungen verschicken",
			'invitations:default:label:all' => "alle",
			'invitations:default:label:none' => "niemand",
			'invitations:default:label:admin' => "admin",
			'invitations:default:desc:all' => "Alle Benutzer d&uuml;rfen - au&szlig;er denen, die explizit auf nein gesetzt wurden",
			'invitations:default:desc:none' => "Keine Benutzer d&uuml;rfen - au&szlig;er denen, die explizit auf ja gesetzt wurden",
			'invitations:default:desc:admin' => "Nur Admins d&uuml;rfen",
			
			//admin actions: give permission to users, if restriction is set in plugin settings
		 	'invitations:usersetting:label:allow' => "Einladungen erlauben",
		 	'invitations:usersetting:label:disallow' => "Einladungen nicht erlauben",	 	
		 	'invitations:usersetting:allow:yes' => "Der Benutzer darf ab jetzt Einladungen verschicken.",
			'invitations:usersetting:allow:no' => "Fehler: Einstellungen konnten nicht ge&auml;ndert werden.",
			'invitations:usersetting:disallow:yes' => "Der Benutzer darf ab jetzt KEINE Einladungen mehr verschicken.",
			'invitations:usersetting:disallow:no' => "Fehler: Einstellungen konnten nicht ge&auml;ndert werden.",
					
			'invitations:status' => "Status",
			'invitations:status:pending' => "offen",
			'invitations:status:expired' => "abgelaufen",
			'invitations:status:used' => "angenommen",
			'invitations:status:usedby' => "angenommen von",
			'invitations:status:usednotconfirmed' => "angenommen, aber account noch nicht bestŠtigt",
		
		/**
		 * Widget
		 */
		 
		 	'invitations:widget:moreinfo' => "mehr",
		 	'invitations:widget:label:status' => "Status: ",
		 	'invitations:widget:label:invitee' => "Eingeladener: ",
		 	'invitations:widget:label:inviteemail' => "E-Mail des Eingeladenen: ",
		 	'invitations:widget:label:message' => "Nachricht: ",
		 	'invitations:widget:label:sentas' => "Verschickt als: ",
		 	'invitations:widget:label:sentby' => "Verschickt von: ",
		 	'invitations:widget:label:registered' => "Angemeldet als: ",
		 	'invitations:widget:label:delete' => "l&ouml;schen",
		 	'invitations:widget:delete:confirm' => "Diese Einladung wirklich l&ouml;schen?",
		 	'invitations:widget:delete:deleted' => "Die Einladung wurde gelšscht.",
		 	'invitations:widget:delete:deleted:error' => "Ein fehler ist aufgetreten.Die Einladung konnte nicht gelšscht werden.",
		 	'invitations:widget:link:yourinvitations' => "Deine Einladungen",

		 	
		/**
		 * Object list and single view elements
		 */
		 
		 	'invitations:moreinfo' => "mehr",
		 	'invitations:label:status' => "Status: ",
		 	'invitations:label:invitee' => "Eingeladener: ",
		 	'invitations:label:inviteemail' => "E-Mail des Eingeladenen: ",
		 	'invitations:label:message' => "Nachricht: ",
		 	'invitations:label:sentas' => "Verschckt als: ",
		 	'invitations:label:sentby' => "Verschickt von: ",
		 	'invitations:label:registered' => "Angemeldet als: ",
		 	'invitations:label:delete' => "l&ouml;schen",
		 	

		 
		 /**
		 * Plugin button, menu title, page title
		 */
	
			'invitation' => "Einladung",
			'invitations:invitation' => "Einladung",
			'invitations:plugin:name' => "Einladungen",
			'invitations:page:title' => "Freunde in dieses Netzwerk einladen",			
			'invitations:button:send' => "Einladung verschicken",
			'invitations:widget:description' => "Zeigt die letzten Einladungen an, die du verschickt hast, um Freunde in dieses Netzwerk einzuladen.",
			
			'invitations:submenu:yours' => "Deine Einladungen",
			'invitations:submenu:new' => "Neue Einladung",
			'invitations:submenu:admin' => "Alle Einladungen",
		 	'invitations:list:title:yours' => "Deine Einladungen",
		 	'invitations:entity:notallowed' => "Du darfst keine weiteren Inhalte sehen",
			
		
		/**
		 * E-Mail elements
		 */
			
			'invitations:email:subject' => "%s hat dich zu %s eingeladen",
			
			'invitations:email:mailbody' => "Hallo %s,
			
%s hat dich ins Netzwerk der Website %s eingeladen.
Wenn du teilnemen m&ouml;chtest, klicke folgenden Link: 
%s

Diese E-Mail wurde automatisch erzeugt. Bitte nicht darauf antworten.

",

			
			'invitations:email:mailbodyuser:message' => "Hier die Nachricht des Users, der Dich eingelden hat:

%s",
			
			
			
		/**
		 * Errors
		 */
		 
		 	'invitations:register:error:expired' => "Die Einlading ist abgelaufen. Sie war nur %s age g&uuml;ltig.",
		 	'invitations:register:error:coderror' => "Bei der &Uuuml;berpr&uuml;fung des Best&auml;tigungscodes ist ein Fehler aufgetreten. Stele sicher, dass Du den kompletten Link verwendet hast, der mit der Einladungs-Mail geschickt wurde.",
		 	'invitations:register:error:used' => "Diese Einladung wurde schon benutzt und ist deshalb nicht mehr g&uuml;ltig.",
			'invitations:error:notallowed' => "Du hast nicht die n&ouml;tigen Rechte, um Einladungen zu verschicken.",
			
			
			
		/**
		 * Input Form elements
		 */
			
			'invitations:formintrotrext' => "Hier kannst Du Freunde einladen, an diesem Netzwerk teilzunehmen. F&uuml;lle einfach das Formular aus. Die Nachricht, die verschickt wird kanst Du optional durch eine eigene Nachricht erg&auml;nzen.",
			'invitations:label:fromname' => "Dein Name",
			'invitations:label:toname' => "Empf&auml;nger Name",
			'invitations:label:mailto' => "Empf&auml;nger E-Mail",
			'invitations:label:subject' => "Betreff",
			'invitations:label:message' => "Nachricht (optional)",
		
		
		
		/**
		 * Plugin action feedback
		 */
			
			'invitations:send:successful' => "Die Einladung wurde erfolgreich verschickt. Vielen Dank.",
			'invitations:send:unsuccessful' => "Die Einladung konnte nicht verschickt werden. Wurden alle Felder korekt ausgef&uuml;llt?.",
			'invitations:email:invalid' => "Die angegebene E-Mail-Adresse war nicht g&uuml;ltig. Bite versuche es noch einmal mit einer g&uuml;ltigen E-Mail-Adresse.",
			

		/**
		 * Registration Form content elements
		 */
		 
			'invitations:register:content:headline' => "Willkommen",
			'invitations:register:content:body:invitedby' => "Du wurdest eingeladen von %s",
			'invitations:register:content:body:knownas' => "Benutzername in dieser Community: %s",
			'invitations:register:content:body:confirmationmail' => "F&uuml;lle das Formular aus und Du erh%auml;ltst eine E-mail mit einem Best&auml;tigungslink. Klicke diesen Link, um Deine hinterlegte E-Mail-Adresse zu bestŠtigen und den Account zu aktivieren.",
	
         
			
		/**
		 * Not used yet
		 */
		 	
		 	
			
	
	);
					
	add_translation("de",$german);

?>