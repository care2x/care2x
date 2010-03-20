<?php

/*
 * Nombre: lang_es_or.php
 * Revisado por: Daniel Hinostroza <care2x@cerebroperiferico.com>
 * Versión: CARE2X 2nd Generation Deployment 2.2
 * Fecha: 07.09.2006
 */

$LDOr='Quirófanos';
$LDLOGBOOK='BIT�CORA';
$LDOrDocument='Documentación quirófanos';
$LDOrDocumentTxt='Documentando los servicios quirúrgicos';

/**
*  A tiny dictionary:
*  DOC = doctor on call duty
*  ORNOC = Operating room nurse on call duty
*  OR = operating room (surgery room)
*/
$LDDOC='Médico de llamada';
$LDORNOC='Enfermera de llamada en quirófanos';
$LDScheduler='Organizador de itinerario';

$LDQuickView='Vista rápida';
$LDQviewTxtDocs='Vista rápida del médico de llamada';
$LDOrLogBook='Bitácora de la enfermera de quirófanos';
$LDOrLogBookTxt='Documentando los servicios de enfermería en quirófanos, documentos de archivo';
$LDOrProgram='Programa de quirófanos';
$LDOrProgramTxt='Mostrar, editar, crear, etc. un programa de quirófanos';
$LDQviewTxtNurse='Vista rápida de las actividades en standby de las enfermeras de hoy';
$LDDutyPlanTxt='Mostrar, editar, crear actividades para la enfermera de llamada en quirófanos';
$LDOnCallDuty='Actividades en standby';
$LDOnCallDutyTxt='Documentando el trabajo durante una actividad de llamada';
$LDAnaLogBook='Bitácora de anestesia';
$LDAnaLogBookTxt='Documentando los servicios de anestesia, documentos de archivo';
$LDQviewTxtAna='Vista rápida de las actividades de la enfermera de llamada en quirófanos para anestesia';
$LDNewDocu='Nuevo documento';
$LDSearch='Buscar';
$LDArchive='Archivo';
$LDSee='Ver';
$LDUpdate='Actualizar';
$LDCreate='Crear';
$LDCreatePersonList='Crear una lista para enfermeras de quirófano';
$LDDoctor='Médico/cirujano';
$LDNursing='Enfermera';
$LDAna='Anestesia';

$LDClose='Cerrar';
$LDSave='Guardar';
$LDCancel='Cancelar';
$LDReset='Reiniciar';
$LDContinue='Continuar...';

$LDHideCat='Guarde el gato';
$LDPatientsFound='Se hallaron varios pacientes!';
$LDPlsClk1='Por favor, dé clic en el apropiado.';
$LDShowCat='¡Quiero ver el gato, por favor!';
$LDResearchArchive='Investigue en los archivos';
$LDSearchDocu='Busque un documento';

$LDMinor='menor';
$LDMiddle='intermedia';
$LDMajor='mayor';
$LDOperation='Procedimiento quirúrgico';

$LDLastName='Apellido';
$LDName='Nombre';
$LDBday='Fecha de nacimiento';
$LDPatientNr='Paciente No.';
$LDMatchCode='Nombre para empatar con el código';
$LDOpDate='Fecha de la cirugía';
$LDOperator='Cirujano';
$LDStationary='Paciente hospitalizado';
$LDAmbulant='Paciente ambulatorio';
$LDInsurance='Seguro';
$LDPrivate='Privado';
$LDSelfPay='Paga por cuenta propia';

$LDDiagnosis='Diagnóstico/ICD-10';
$LDLocalization='Localización';
$LDTherapy='Terapia';
$LDSpecials='Aviso especial';
$LDClassification='Clasificación';

/**
*  A tiny dictionary:
*  OP = operation (surgical operation)
*/
$LDOpStart='Inicio de la Qx.';
$LDOpEnd='Fín de la Qx.';
/**
*  A tiny dictionary:
*  Scrub nurse =  the nurse in sterile clothing assisting the surgeon, in charge of the sterile instruments and surgical materials
*/
$LDScrubNurse='Enfermera instrumentadora';
$LDOpRoom='Sala de operaciones';
$LDResetAll='Borre todas las entradas';
$LDUpdateData='Actualice los datos';
$LDStartNewDocu='Empiece un nuevo documento';
$LDSearchKeyword='Palabras clave de búsqueda: por ej., nombre o apellido';

$LDSrcListElements=array(
'',
'Apellido',
'Nombre',
'Fecha de nacimiento',
'No. de paciente',
'Fecha de la cirugía',
'Departamento de Cirugía',
'No. de procedimiento quirúrgico'
);
$LDClk2Show='Dé clic para mostrar';
$LDSrcCondition='Buscar palabra clave y/o condición';
$LDNewArchiveSearch='Nueva investigación en archivo';
$tage=array(
				'Domingo',
				'Lunes',
				'Martes',
				'Miércoles',
				'Jueves',
				'Viernes',
				'Sábado');
$monat=array('',
				'Enero',
				'Febrero',
				'Marzo',
				'Abril',
				'Mayo',
				'Junio',
				'Julio',
				'Agosto',
				'Septiembre',
				'Octubre',
				'Noviembre',
				'Diciembre');
$LDPrevDay='Día anterior';
$LDNextDay='Día siguiente';
$LDChange='Cambio';
$LDOpMainElements=array(
										nr_date=>'Número/Fecha',
										patient=>'Paciente',
										diagnosis=>'Diagnóstico',
										operator=>'Surgeon/Asistente',
										ana=>'Anestesia',
										cutclose=>'Corte/Sutura',
										therapy=>'Terapia',
										result=>'Resultado',
										inout=>'Ingreso/Salida'
										);
$LDOpCut='Corte';
$LDOpClose='Sutura';
$LDOpIn='Ingreso';
$LDOpOut='Salida';
$LDOpInFull='Ingreso';
$LDOpOutFull='Salida';
$LDEditPatientData='Editar los datos de la bitácora de ~tagword~';
$LDOpenPatientFolder='Abra la carpeta de enfermería de ~tagword~';

$tbuf=array('C','A','I','R');
$cbuf=array('Cirujano','Ayudante','Instrumentadora','Enfermera rotante');

/**
*  A tiny dictionary:
*  Enfermera rotante =  la enfermera con ropa no-estéril asistiendo a la instrumentadora, a cargo de instrmentos no-estériles y materiales quirúrgicos
*/
$LDOpPersonElements=array(
											operator=>'Cirujano',
											assist=>'Ayudante',
											scrub=>'Instrumentadora',
											rotating=>'Enfermera rotante',
											ana=>'Anestesiólogo'
											);

$LDPatientNotFound='El paciente no fue hallado!';
$LDPlsEnoughData='Por favor, ingrese suficiente información.';
$LDOpNr='No. de procedimiento quirúrgico';
$LDDate='Fecha';
$LDClk2DropMenu='Dé clic para desplegar el menú';
$LDSaveLatest='Guarde los últimos ingresos de información';
$LDHelp='Abra la ventana de ayuda';

$LDSearchPatient='Buscar un paciente';
$LDUsedMaterial='Materiales quirúrgicos usados';
$LDContainer='Instrumentos y contenedores usados';
$LDDRG='GRD (Grupos rel. con el Dg.)';
$LDShowLogbook='Mostrar la bitácora';

/**
*  A tiny dictionary:
*  AIT = Anestesia intratraqueal 
*  NIT = Narcótico intratraqueal
*  AL =  Anestesia local (inyectado localmente o aplicado)
*  DS = Daemmerschlaf (sedación analgésica)
*  SA = Sedación analgésica
*  Plexo = Anestesia en los nervios del plexo 
*/

$LDAnaTypes=array(
					'ITN'=>'AIT',
					'ITN-Jet'=>'NIT-Jet',
					'ITN-Mask'=>'AIT-Máscara',
					'LA'=>'AL',
					'DS'=>'SA',
					'AS'=>'SA',
					'Plexus'=>'Plexo',
					'Standby'=>'Standby'
					);

$LDAnaDoc='Anestesiólogo';
$LDAnaPrefix='NA';
$LDEnterPerson='Ingrese una nueva ~tagword~';
$LDExtraInfo='Información adicional';
$LDFrom='De';
$LDTo='Para';
$LDFunction='Función';
$LDCurrentEntries='Entradas actuales';
$LDDeleteEntry='Borre las entradas';
$LDSearchNewPerson='Busque una nueva ~tagword~';
$LDSorryNotFound='Lo siento. No he hallado nada. Por favor, intente con otra palabra clave.';
$LDSearchPerson='Busque ~tagword~';
$LDJobId='Profesión';
$LDSearchResult='Resultados de búsqueda';
$LDUseData='Ingrese esta persona como ~tagword~';
$LDJobIdTag=array(
						nurse=>'Enfermera',
						doctor=>'Médico/Cirujano'
						);
$LDQuickSelectList='Lista rápida de selección';
$LDTimes='Tiempo';
$LDPlasterCast='Enyesamiento';
/**
*  Reposición = reposicionamiento de una dislocación ósea o fractura
*/
$LDReposition='Reposición';
$LDWaitTime='Tiempo de espera';
$LDStart='Inicio';
$LDEnd='Finalización';
$LDPatNoExist='El paciente no ha ingresado aún a la bitácora. Por favor, cierre esta ventana e inicie la bitácora desde el principio. Si este problema persiste, por favor notifique al Departamento de Admin. Sistemas.';
$opts=array('-',
					'Paciente llegó tarde al quirófano',
       				'Anestesiólogos llegaron tarde al quirófano',
       				'Enfermeras de quirófano llegaron tarde al quirófano', 
					'El equipo de limpieza terminó tarde',
       				'Razón especial');
$LDReason='Razón';
$LDMaterialElements=array(
									'No. de orden',
    								'Nombre artíc.',
    								'&nbsp;',
    								'Genérico',
    								'Licencia No.',
    								'Unidades',
    								'&nbsp;'
									);
$LDSearchElements=array(
									'&nbsp;',
									'No. artíc.',
    								'Nombre artíc.',
    								'Descripción;',
 									'&nbsp;',
   									'Genérico',
    								'Licencia No.'
									);
$LDContainerElements=array(
									'Contenedor No.',
    								'Nombre/Descripción',
									'&nbsp;',
    								'No. industrial',
    								'No. de orden',
    								'Unidades',
    								'&nbsp;'
									);
$LDArticleNr='Artículo No.';			
$LDContainerNr='Contenedor No.';							
$LDArticleNotFound='¡El artículo no fue hallado!';
$LDNoArticleTxt='El artículo no está en la lista de la base de datos o usted escribió el número incorrectamente.';
$LDClk2ManualEntry='Para ingresar el artículo manualmente, <b>dé clic aquí.</b>';
$LDPlsClkArticle='¡Por favor, dé clic en el artículo deseado!';
$LDSelectArticle='Dé clic para seleccionar este artículo';
$LDDbInfo='Info desde la base de datos';
$LDRemoveArticle='Remover el artículo de esta lista';
$LDArticleNoList='El artículo no está en la lista de la base de datos';
$LDPromptSearch='Por favor, ingrese una palabra clave.<br>Como por ejemplo, un apellido, nombre, fecha de nacimiento, etc. (Lea también los <a href=\'ucons.php\'>Consejos</a>.)';
$LDKeyword='Palabra clave';
$LDOtherFunctions='Otras funciones';
$LDInfoNotFound='¡La información necesaria no ha sido hallada!';
$LDButFf='Pero el/las siguiente/s';
$LDSimilar=' entrada es';
$LDSimilarMany=' entradas son';
$LDNeededInfo=' similar/es a la palabra clave.';
$LDPatLogbook='El paciente está documentado en la siguiente bitácora.';
$LDPatLogbookMany='El paciente está documentado en las siguientes bitácoras.';
$LDDepartment='Departamento';
$LDRoom='Habitación';
$LDLastEntry='La siguiente es el último registro en la bitácora';
$LDLastEntryMany='Los siguientes son los últimos registros en la bitácora';
$LDFrom='de';
$LDFromMany='de';
$LDYesterday='ayer';
$LDVorYesterday='hace dos días';
$LDDays='días pasados';
$LDChangeDept='Cambie el departamento o sala de quirófanos';

$LDTabElements=array('Departamento de quirófanos',
								 'En espera',
								 'Buscapersonas/ Teléfono',
								 'De llamada',
								 'Buscapersonas/ Teléfono',
								 'Plan de actividades'
								 );
$LDStandbyPerson='Persona en espera';
$LDOnCallPerson='De llamada';
$LDMonth='Mes';
$LDYear='Año';
$LDDutyElements = array('Fecha','&nbsp;','Apellido, Nombre','de','para','Sala quirófanos','Diagnóstico y terapia');
$LDPrint='Imprimir';
$LDAlertNoPrinter='Debe imprimirlo manualmente.  Dé clic con el botón derecho sobre la ventana, luego seleccione "Imprimir".';
$LDAlertNotSavedYet='Los últimos datos ingresados no se han guardado todavía.  ¿Desea grabar primero?';
$LDPhone='Teléfono';
$LDBeeper='Buscapersonas';
$LDOn='en';
$LDNoPersonList='La lista de Personal no se ha creado todavía.';
$LDNoEntryFound='¡No se ha hallado un ingreso de datos en el plan!';
$LDShow='Mostrar';
$LDShowPrevLog='Muestre los registros previos de la bitácora';
$LDShowNextLog='Muestr los siguientes registros de la bitácora';
$LDShowGuideCal='Muestre el calendario guía';

$LDPerformance='Rendimiento';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='Por favor, halle al paciente primero.';
$LD_ddpMMpyyyy='dd.mm.yyyy';
$LD_yyyyhMMhdd='yyyy-mm-dd';
$LD_MMsddsyyyy='mm/dd/yyyy';
/* 2002-10-15 EL */
$LDStandbyInit='E'; /* E = En espera */
$LDOncallInit='L'; /* L = De llamada */
$LDDutyPlan='Plan de actividades';
/* 2003-03-18 EL */
$LDSearchInAllDepts='Buscar en todos los Departamentos';
$LDAddNurseToList='Añada una enfermera a la lista';
$LDNursesList='Lista de enfermeras';
/* 2003-03-19 EL */
$LDPlsSelectDept='Por favor, seleccione un Departamento.';
$LDSelectORoomNr='...y un quirófano.';
$LDAlertNoDeptSelected=$LDPlsSelectDept;
$LDAlertNoORSelected='¡Por favor, seleccione un quirófano!';
?>