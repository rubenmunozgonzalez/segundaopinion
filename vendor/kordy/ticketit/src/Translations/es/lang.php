<?php

return [

 /*
  *  Constants
  */

  'nav-active-tickets'               => 'Consultas Activas',
  'nav-completed-tickets'            => 'Consultas Completas',

  // Tables
  'table-id'                         => '#',
  'table-subject'                    => 'Asunto',
  'table-owner'                      => 'Paciente',
  'table-status'                     => 'Estado',
  'table-last-updated'               => 'Última Actualización',
  'table-priority'                   => 'Prioridad',
  'table-agent'                      => 'Especialista',
  'table-category'                   => 'Especialidad',
  'table-unit'                       => 'Unidad',
  'table-price'                      => 'Precio',

  // Datatables
  'table-decimal'                    => '',
  'table-empty'                      => 'No hay data esta tabla',
  'table-info'                       => 'Mostrando _START_ a _END_ de _TOTAL_ entradas',
  'table-info-empty'                 => 'Mostrando 0 de 0 a 0 records',
  'table-info-filtered'              => '(filtrados de _MAX_ totales)',
  'table-info-postfix'               => '',
  'table-thousands'                  => ',',
  'table-length-menu'                => 'Mostrar _MENU_ entradas',
  'table-loading-results'            => 'Cargando...',
  'table-processing'                 => 'Procesando...',
  'table-search'                     => 'Buscar:',
  'table-zero-records'               => 'No hemos encontrado entradas que correspondan',
  'table-paginate-first'             => 'Primera',
  'table-paginate-last'              => 'Última',
  'table-paginate-next'              => 'Siguiente',
  'table-paginate-prev'              => 'Anterior',
  'table-aria-sort-asc'              => ': activar para ordernar por esta columna ascendentemente',
  'table-aria-sort-desc'             => ': activar para ordernar por esta columna descendentemente',

  'btn-back'                         => 'Regresar',
  'btn-cancel'                       => 'Cancelar', // NEW
  'btn-close'                        => 'Cerrar',
  'btn-delete'                       => 'Borrar',
  'btn-edit'                         => 'Editar',
  'btn-mark-complete'                => 'Marcar como Completa',
  'btn-submit'                       => 'Enviar',
  'btn-submit-pay'                   => 'Enviar y pagar',
  'btn-download-payments'            => 'Descargar tabla',

  'agent'                            => 'Especialista',
  'category'                         => 'Especialidad',
  'unit'                             => 'Unidad',
  'colon'                            => ': ',
  'comments'                         => 'Respuestas',
  'created'                          => 'Creado',
  'description'                      => 'Descripción',
  'flash-x'                          => '×', // &times;
  'last-update'                      => 'Última Actualización',
  'no-replies'                       => 'Sin respuestas.',
  'owner'                            => 'Dueño',
  'priority'                         => 'Prioridad',
  'reopen-ticket'                    => 'Reabrir Consulta',
  'reply'                            => 'Responder',
  'responsible'                      => 'Responsable',
  'status'                           => 'Estado',
  'subject'                          => 'Asunto',
  'nid'                              => 'NIF/Pasaporte',

 /*
  *  Page specific
  */

// ____
  'index-title'                      => 'Soporte página principal',

// tickets/____
  'index-my-tickets'                 => 'Mis Consultas',
  'index-my-payments'                => 'Control de pagos',
  'btn-create-new-ticket'            => 'Crear nueva consulta',
  'index-complete-none'              => 'No hay consultas completadas',
  'index-active-check'               => 'Asegúrate de revisar las Consultas Activas si no puedes encontrar la consulta.',
  'index-active-none'                => 'No hay consultas activas,',
  'index-create-new-ticket'          => 'crear una consulta nueva',
  'index-complete-check'             => 'Asegúrate de revisar las Consultas Completadas si no puedes encontrar la consulta.',

  'create-ticket-title'              => 'Formulario de Nueva Consulta',
  'create-new-ticket'                => 'Crear Nueva Consulta',
  'create-ticket-brief-issue'        => 'Un resumen del problema que tienes',
  'create-ticket-describe-issue'     => 'Describe en detalle el problema que tienes',

  'show-ticket-title'                => 'Consulta',
  'show-ticket-js-delete'            => '¿Estás seguro que quieres borrar?: ',
  'show-ticket-modal-delete-title'   => 'Borrar consulta',
  'show-ticket-modal-delete-message' => '¿Estás seguro que quieres borrar: :subject?',

 /*
  *  Controllers
  */

// AgentsController
  'agents-are-added-to-agents'                      => 'Especialistas :names fueron añadidos a especialistas',
  'administrators-are-added-to-administrators'      => 'Administradores :names fueron añadidos a administradores', //New
  'agents-joined-categories-ok'                     => 'Te agregaste a unidades',
  'agents-is-removed-from-team'                     => 'Eliminamos agente\s :name del equipo de especialistas',
  'administrators-is-removed-from-team'             => 'Eliminamos administrador\es :name del equipo de administradores', // New
  'user-is-removed-from-team'                       => 'Eliminamos usuario\s :name de la base de datos',

// CategoriesController
  'category-name-has-been-created'   => 'La categoría :name fue creada!',
  'category-name-has-been-modified'  => 'La cateogría :name fue modificada!',
  'category-name-has-been-deleted'   => 'La categoría :name fue borrada!',

// PrioritiesController
  'priority-name-has-been-created'   => 'La prioridad :name fue creada!',
  'priority-name-has-been-modified'  => 'La prioridad :name fue modificada!',
  'priority-name-has-been-deleted'   => 'La prioridad :name fue borrada!',
  'priority-all-tickets-here'        => 'Todas las consultas relacionadas a la cateogoría aquí',

// StatusesController
  'status-name-has-been-created'   => 'El estado :name fue creado!',
  'status-name-has-been-modified'  => 'El estado :name fue modificado!',
  'status-name-has-been-deleted'   => 'El estado :name fue borrado!',
  'status-all-tickets-here'        => 'Todas las consultas relacionadas al estado aquí',

// CommentsController
  'comment-has-been-added-ok'        => 'La respuesta fue añadida de forma correcta',

// NotificationsController
  'notify-new-comment-from'          => 'Nueva respuesta de ',
  'notify-on'                        => ' en ',
  'notify-status-to-complete'        => ' estado a Completado ',
  'notify-status-to'                 => ' estado a ',
  'notify-transferred'               => ' transferido ',
  'notify-to-you'                    => ' a usted ',
  'notify-created-ticket'            => ' creó consulta ',
  'notify-updated'                   => ' actualizado ',

 // TicketsController
  'the-ticket-has-been-created'      => 'La consulta fue creada!',
  'the-ticket-has-been-modified'     => 'La consulta fue modificado!',
  'the-ticket-has-been-deleted'      => 'La consulta :name fue borrado!',
  'the-ticket-has-been-completed'    => 'La consulta :name fue completado!',
  'the-ticket-has-been-reopened'     => 'La consulta :name fue reabierto!',
  'you-are-not-permitted-to-do-this' => 'No tienes los permisos necesarios para realizar esta acción!',

 /*
 *  Middlewares
 */

 //  IsAdminMiddleware IsAgentMiddleware ResAccessMiddleware
  'you-are-not-permitted-to-access'     => 'No tienes los permisos necesarios para acceder esta página!',

];
