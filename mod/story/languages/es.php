<?php
/**
 * Story Spanish language file.
 *
 */

$spahish = array(
	'story' => 'Storys',
	'story:storys' => 'Storys',
	'story:revisions' => 'Revisiones',
	'story:archives' => 'Archivos',
	'story:story' => 'Story',
	'item:object:story' => 'Storys',

	'story:title:user_storys' => 'Storys de %s',
	'story:title:all_storys' => 'Todos los storys del sitio',
	'story:title:friends' => 'Storys de amigos',

	'story:group' => 'Story del grupo',
	'story:enablestory' => 'Habilitar story del grupo',
	'story:write' => 'Agregar una entrada al story',
	
	'story:shortnormal' => 'Historia',
	'story:shortgamebook' => 'Propia aventura',
	'story:shortexquisitecorpse' => 'Cadaver Exquisito',
	
	'story:access' => 'Acceso',
	'story:storytype' => 'Tipo de Historia',
	'story:comments' => 'Comentarios',
	
	'story:normal' => 'Historia lineal',
	'story:gamebook' => 'Historia de Librojuego (Sigue tu propia aventura)',
	'story:exquisitecorpse' => 'Historia de Cadaver Exquisito',

	// Editing
	'story:add' => 'Agregar una entrada al story',
	'story:edit' => 'Editar entrada del story',
	'story:excerpt' => 'Extracto',
	'story:body' => 'Cuerpo',
	'story:save_status' => 'Guardado: ',
	'story:never' => 'Nunca',

	// Statuses
	'story:status' => 'Estado',
	'story:status:draft' => 'Borrador',
	'story:status:published' => 'Publicado',
	'story:status:unsaved_draft' => 'Borrador no guardado',

	'story:revision' => 'Revisi&oacute;n',
	'story:auto_saved_revision' => 'Revisi&oacute;n guardada automaticamente',

	// messages
	'story:message:saved' => 'Entrada del story guardada.',
	'story:error:cannot_save' => 'No se pudo guardar la entrada del story.',
	'story:error:cannot_write_to_container' => 'No posee los permisos necesarios para a&ntilde;adir el story al grupo.',
	'story:error:post_not_found' => 'Esta entrada ha sido quitada, es inv&aacute;lida, o no tiene los permisos necesarios para poder verla.',
	'story:messages:warning:draft' => 'Hay un borrador sin guardar para esta entrada!',
	'story:edit_revision_notice' => '(Versi&oacute;n anterior)',
	'story:message:deleted_post' => 'Entrada del story eliminada.',
	'story:error:cannot_delete_post' => 'No se pudo eliminar la entrada del story.',
	'story:none' => 'No hay entradas en el story',
	'story:error:missing:title' => 'Debe ingresar un t&iacute;tulo para el story!',
	'story:error:missing:description' => 'Debe ingresar el cuerpo de su story!',
	'story:error:cannot_edit_post' => 'La publicaci&oacute;n no existe o no posee los permisos necesarios sobre ella.',
	'story:error:revision_not_found' => 'No se pudo encontrar la revisi&oacute;n.',

	// river
	'river:create:object:story' => '%s public&oacute; una entrada en el story %s',
	'river:comment:object:story' => '%s coment&oacute; en el story %s',

	// notifications
	'story:newpost' => 'Una nueva entrada de story',

	// widget
	'story:widget:description' => 'Mostrar las &uacute;ltimas entradas de story',
	'story:morestorys' => 'M&aacute;s entradas de story',
	'story:numbertodisplay' => 'Cantidad de entradas de story a mostrar',
	'story:nostorys' => 'No hay entradas de story'
);

add_translation('es', $spahish);
