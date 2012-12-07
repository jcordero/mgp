<?php
/* Archivo definicion menu de la aplicacion
 * Libreria Menu Kendo UI
 * Generado automaticamente 
 * NO MODIFICAR A MANO!
 */
	
	$buff = '<ul id="menu">';
        if($this->haveRight($primary_db,'menu.archivo.inicio')) { 
            $buff.='<li>Inicio';
        	$buff.='<ul>';
        	$buff.="<li><a href=\"/mgp/index.php\">Inicio</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/mydata.php?OP=M')."\">Mis datos</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/logout.php?OP=V')."\">Salir</a>";
        	$buff.='</li>';
        	$buff.='</ul>';
        }
        if($this->haveRight($primary_db,'menu.archivo.ciudadanos')) { 
            $buff.="</li>";
            $buff.='<li>Ciudadanos';
        	$buff.='<ul>';
            if($this->haveRight($primary_db,'menu.archivo.ciudadanos')) { 
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/ciudadanos/ciudadanos.php?OP=V')."\">Ciudadanos</a>";
            	$buff.='</li>';
            }
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/ciudadanos/ciudadanos_maint_n.php?OP=N')."\">Nuevo Ciudadano</a>";
        	$buff.='</li>';
        	$buff.='</ul>';
        }
        if($this->haveRight($primary_db,'menu.archivo.call_saliente')) { 
            $buff.="</li>";
            $buff.='<li>Saliente';
        	$buff.='<ul>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/colallamadas.php?OP=V')."\">Cola de llamadas</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/pendientes.php?OP=V')."\">Tareas Pendientes</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/colallamadasadm.php?OP=V')."\">Contactos realizados</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/ajustes.php?OP=M')."\">Ajustes de campaña</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/llamados.php?OP=V')."\">Números contactados</a>";
        	$buff.='</li>';
        	$buff.="<li>Reportes";
        	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/colallamadasadm.php?OP=V')."\">Contactos</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/rep_operador.php?pagemode=off&OP=M')."\">Por operador</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/rep_barrio.php?pagemode=off&OP=M')."\">Por barrio</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/rep_prestacion.php?pagemode=off&OP=M')."\">Por prestacion</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/rep_horario.php?pagemode=off&OP=M')."\">Por horario</a>";
            	$buff.='</li>';
        	$buff.='</ul>';
        	$buff.='</li>';
        	$buff.="<li>Skills";
        	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/skills.php?OP=V')."\">Consulta de skills</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/call/skill_maint.php?OP=N')."\">Nuevo skill</a>";
            	$buff.='</li>';
        	$buff.='</ul>';
        	$buff.='</li>';
        	$buff.='</ul>';
        }
        if($this->haveRight($primary_db,'menu.archivo.tickets')) { 
            $buff.="</li>";
            $buff.='<li>Tickets';
        	$buff.='<ul>';
            if($this->haveRight($primary_db,'menu.archivo.tickets.nuevo')) { 
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/tickets_maint_n.php?OP=N')."\">Nuevo ticket</a>";
            	$buff.='</li>';
            }
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/tickets.php?OP=V')."\">Búsqueda de tickets</a>";
        	$buff.='</li>';
            if($this->haveRight($primary_db,'menu.archivo.tickets.admin')) { 
            	$buff.="<li>Prestaciones";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.archivo.tickets.admin')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/prestaciones.php?OP=V')."\">Listar prestaciones</a>";
                	$buff.='</li>';
                }
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/prest_maint_n.php?OP=N')."\">Nueva prestacion</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.tickets.admin')) { 
            	$buff.="<li>Organismos";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.archivo.tickets.admin')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/organismos.php?OP=V')."\">Listar organismos</a>";
                	$buff.='</li>';
                }
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/organ_maint_n.php?OP=N')."\">Nuevo organismo</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.tickets.admin')) { 
            	$buff.="<li>Rubros";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.archivo.tickets.admin')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/rubros.php?OP=V')."\">Listar rubros</a>";
                	$buff.='</li>';
                }
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/rubro_maint_n.php?OP=N')."\">Nuevo rubro</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.tickets.admin')) { 
            	$buff.="<li>Georeferencias";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.archivo.tickets.admin')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/georefs.php?OP=V')."\">Listar georeferencias</a>";
                	$buff.='</li>';
                }
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/georef_maint.php?OP=N')."\">Nueva georeferencia</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
        	$buff.='</ul>';
        }
        if($this->haveRight($primary_db,'menu.archivo.denuncias')) { 
            $buff.="</li>";
            $buff.='<li>Denuncias';
        	$buff.='<ul>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/dennovedades.php?OP=V')."\">Consulta de novedades</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/denabiertas.php?OP=V')."\">Consulta de denuncias</a>";
        	$buff.='</li>';
            if($this->haveRight($primary_db,'menu.archivo.denuncias.adm')) { 
            	$buff.="<li>Prestaciones";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.archivo.denuncias.adm')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/denprestaciones.php?OP=V')."\">Listar prestaciones</a>";
                	$buff.='</li>';
                }
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/denprest_maint_n.php?OP=N')."\">Nueva prestación</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.denuncias.adm')) { 
            	$buff.="<li>Rubros";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.archivo.denuncias.adm')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/rubros.php?OP=V')."\">Listar rubros</a>";
                	$buff.='</li>';
                }
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/rubro_maint_n.php?OP=N')."\">Nuevo rubro</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
        	$buff.='</ul>';
        }
        if($this->haveRight($primary_db,'menu.archivo.reclamos')) { 
            $buff.="</li>";
            $buff.='<li>Reclamos';
        	$buff.='<ul>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/recnovedades.php?OP=V')."\">Consulta de novedades</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/recabiertos.php?OP=V')."\">Consulta de reclamos</a>";
        	$buff.='</li>';
            if($this->haveRight($primary_db,'menu.archivo.denuncias.adm')) { 
            	$buff.="<li>Prestaciones";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.archivo.denuncias.adm')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/recprestaciones.php?OP=V')."\">Listar prestaciones</a>";
                	$buff.='</li>';
                }
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/recprest_maint_n.php?OP=N')."\">Nueva prestacion</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
        	$buff.='</ul>';
        }
        if($this->haveRight($primary_db,'menu.archivo.solicitudes')) { 
            $buff.="</li>";
            $buff.='<li>Solicitudes';
        	$buff.='<ul>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/solnovedades.php?OP=V')."\">Consulta de novedades</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/solabiertas.php?OP=V')."\">Consulta de solicitudes</a>";
        	$buff.='</li>';
        	$buff.='</ul>';
        }
        if($this->haveRight($primary_db,'menu.archivo.quejas')) { 
            $buff.="</li>";
            $buff.='<li>Quejas';
        	$buff.='<ul>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/quenovedades.php?OP=V')."\">Consulta de novedades</a>";
        	$buff.='</li>';
        	$buff.="<li><a href=\"".$this->encodeURL('/mgp/lmodules/tickets/queabiertas.php?OP=V')."\">Consulta de quejas</a>";
        	$buff.='</li>';
        	$buff.='</ul>';
        }
        if($this->haveRight($primary_db,'menu.archivo.administracion')) { 
            $buff.="</li>";
            $buff.='<li>Administración';
        	$buff.='<ul>';
            if($this->haveRight($primary_db,'menu.archivo.administracion.home')) { 
            	$buff.="<li>Home page";
            	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/home/contextos.php?OP=X')."\">Listar contextos</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/home/contexto_maint.php?OP=N')."\">Nuevo contexto</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.usuarios')) { 
            	$buff.="<li>Usuarios";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.usuarios.usuarios')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/users.php?OP=X')."\">Listar usuarios</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.usuarios.usuarios')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/users_maint.php?OP=N')."\">Nuevo usuario</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.usuarios.grupousuarios')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/usergroup.php?OP=X')."\">Listar grupos de roles</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.usuarios.grupousuarios')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/usergroup_maint.php?OP=N')."\">Nuevo rol</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.usuarios.derechos')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/rights.php?OP=X')."\">Listar permisos</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.usuarios.derechos')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/rights_maint.php?OP=N')."\">Nuevo permiso</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.usuarios.grupoderechos')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/rightgroup.php?OP=X')."\">Listar grupos de permisos</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.usuarios.grupoderechos')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/rightgroup_maint.php?OP=N')."\">Nuevo grupo de permisos</a>";
                	$buff.='</li>';
                }
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/resetpass.php?OP=X')."\">Pedidos de recupero de clave</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.parametros')) { 
            	$buff.="<li>Parámetros";
            	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/parameters.php?OP=X')."\">Listar parámetros</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/security/parameters_maint.php?OP=N')."\">Nuevo parámetro</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.configuracion')) { 
            	$buff.="<li>Listas de valores";
            	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/setup/val_list.php?OP=X')."\">listar listas de valores</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/setup/val_list_maint.php?OP=N')."\">Nueva lista</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.configuracion')) { 
            	$buff.="<li>Configuración";
            	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/setup/make_modules.php?OP=M')."\">Instalacion de modulos</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/setup/make_menu.php?OP=M')."\">Regeneracion del menu</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/setup/update_plataforma.php?OP=M')."\">Actualizacion de plataforma</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/setup/update_sitio.php?OP=M')."\">Actualizacion del sitio</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.trans')) { 
            	$buff.="<li>Transacciones";
            	$buff.='<ul>';
                if($this->haveRight($primary_db,'menu.trans.bugtrack')) { 
                	$buff.="<li>BugTrack";
                	$buff.='<ul>';
                    if($this->haveRight($primary_db,'menu.trans.bugtrack')) { 
                    	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/bugtrack.php?OP=')."\">Listar Bugs</a>";
                    	$buff.='</li>';
                    }
                    if($this->haveRight($primary_db,'menu.trans.bugtrack.new')) { 
                    	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/bugtrack_maint.php?OP=N')."\">Nueva incidencencia</a>";
                    	$buff.='</li>';
                    }
                	$buff.='</ul>';
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.trans.faq')) { 
                	$buff.="<li>FAQ";
                	$buff.='<ul>';
                    if($this->haveRight($primary_db,'menu.trans.faq')) { 
                    	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/faq.php?OP=')."\">FAQ</a>";
                    	$buff.='</li>';
                    }
                    if($this->haveRight($primary_db,'menu.trans.faq.new')) { 
                    	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/faq_maint.php?OP=N')."\">Nueva pregunta FAQ</a>";
                    	$buff.='</li>';
                    }
                	$buff.='</ul>';
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.trans.projects')) { 
                	$buff.="<li>Proyectos";
                	$buff.='<ul>';
                    if($this->haveRight($primary_db,'menu.trans.projects')) { 
                    	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/proyectos.php?OP=')."\">Listar proyectos</a>";
                    	$buff.='</li>';
                    }
                    if($this->haveRight($primary_db,'menu.trans.projects.new')) { 
                    	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/proyectos_maint.php?OP=N')."\">Nuevo proyecto</a>";
                    	$buff.='</li>';
                    }
                	$buff.='</ul>';
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.trans.reportes')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/reports.php?OP=')."\">Reportes usuarios</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.trans.faq_topic')) { 
                	$buff.="<li>Temas FAQ";
                	$buff.='<ul>';
                    if($this->haveRight($primary_db,'menu.trans.faq_topic')) { 
                    	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/faq_topic.php?OP=')."\">Listar Temas FAQ</a>";
                    	$buff.='</li>';
                    }
                    if($this->haveRight($primary_db,'menu.trans.faq_topic.new')) { 
                    	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/faq_topic_maint.php?OP=N')."\">Nuevo tema FAQ</a>";
                    	$buff.='</li>';
                    }
                	$buff.='</ul>';
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.trans.eventos')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/mensajes.php?OP=')."\">ver avisos</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.trans.eventos')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/events.php?OP=')."\">ver eventos</a>";
                	$buff.='</li>';
                }
                if($this->haveRight($primary_db,'menu.trans.consulta')) { 
                	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/transactions/trans.php?OP=')."\">ver transacciones</a>";
                	$buff.='</li>';
                }
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.docs.admin')) { 
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/docmgr2/docs.php?OP=')."\">Administrar documentos</a>";
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.configuracion.georef')) { 
            	$buff.="<li>GeoReferencias";
            	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/georef/layers.php?OP=')."\">Listar capas</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/georef/zones.php?OP=')."\">Listar zonas</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/georef/layers_maint.php?OP=N')."\">Nueva capa</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/georef/layers_maint_kml.php?OP=N')."\">Nueva capa desde KML</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/georef/zone_maint.php?OP=N')."\">Nueva zona</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.messaging')) { 
            	$buff.="<li>Mensajeria";
            	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/messaging/entrantes.php?OP=')."\">Mensajes entrantes</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/messaging/messages.php?OP=')."\">Mensajes salientes</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/messaging/server_maint_n.php?OP=N')."\">Nuevo Servidor</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/messaging/servers.php?OP=N')."\">Servidores</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.rss')) { 
            	$buff.="<li>RSS";
            	$buff.='<ul>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/rss/articles.php?OP=')."\">Articulos</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/rss/links.php?OP=')."\">Fuentes</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/rss/links_maint.php?OP=N')."\">Nueva fuente</a>";
            	$buff.='</li>';
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/rss/articles_maint.php?OP=N')."\">Nuevo articulo</a>";
            	$buff.='</li>';
            	$buff.='</ul>';
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.administracion.eventos')) { 
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/events/events.php?OP=X')."\">Ver eventos</a>";
            	$buff.='</li>';
            }
            if($this->haveRight($primary_db,'menu.archivo.administracion.eventos')) { 
            	$buff.="<li><a href=\"".$this->encodeURL('/mgp/modules/events/handlers.php?OP=X')."\">Ver manejadores de eventos</a>";
            	$buff.='</li>';
            }
        	$buff.='</ul>';
        }
	$buff.="</li></ul>";

?>
