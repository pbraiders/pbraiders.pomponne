<?php
/*************************************************************************
 *                                                                       *
 * Copyright (C) 2010   Olivier JULLIEN - PBRAIDERS.COM                  *
 * Tous droits réservés - All rights reserved                            *
 *                                                                       *
 *************************************************************************
 *                                                                       *
 * Except if expressly provided in a dedicated License Agreement,you     *
 * are not authorized to:                                                *
 *                                                                       *
 * 1. Use,copy,modify or transfer this software component,module or      *
 * product,including any accompanying electronic or paper documentation  *
 * (together,the "Software").                                            *
 *                                                                       *
 * 2. Remove any product identification,copyright,proprietary notices    *
 * or labels from the Software.                                          *
 *                                                                       *
 * 3. Modify,reverse engineer,decompile,disassemble or otherwise         *
 * attempt to reconstruct or discover the source code,or any parts of    *
 * it,from the binaries of the Software.                                 *
 *                                                                       *
 * 4. Create derivative works based on the Software (e.g. incorporating  *
 * the Software in another software or commercial product or service     *
 * without a proper license).                                            *
 *                                                                       *
 * By installing or using the "Software",you confirm your acceptance     *
 * of the hereabove terms and conditions.                                *
 *                                                                       *
 *************************************************************************/
/*************************************************************************
 * file encoding: UTF-8
 * description: contains configuration parameters
 * author: Olivier JULLIEN - 2010-05-24
 *************************************************************************/

 /**************************
 * Réglages serveur
***************************/
date_default_timezone_set('Europe/Paris');

/**************************
 * Réglages accès
***************************/

// Adresse url d'accès au site (par exemple: 'http://www.votre-site.com/le_dossier_pbraiders/')
define('PBR_URL','http://www.votre-site.com/le_dossier_pbraiders/');

/**************************
 * Réglages MySQL
***************************/

// Nom de la base de données pbraiders.
define('PBR_DB_DBN','votre_nom_de_bdd');

// Utilisateur de la base de données pbraiders.
define('PBR_DB_USR','votre_utilisateur');

// Mot de passe de la base de données pbraiders.
define('PBR_DB_PWD','votre_mot_de_passe');

/// Adresse de l'hébergement MySQL. Dans la plupart des cas, vous n'avez pas à modifier cette valeur.
define('PBR_DB_HOST','localhost');

// Drivers - ne pas modifier
define('PBR_DB_DSN','mysql:host='.PBR_DB_HOST.';dbname=');

/**************************
 * Réglages application
***************************/

// LIFETIME
define('PBR_LIFETIME_COOKIE',36000);
define('PBR_LIFETIME_SESSION',36000);

// PAGING - Number of contacts and rents to display per page.
define('PBR_PAGE_CONTACTS',50);
define('PBR_PAGE_RENTS',50);
define('PBR_PAGE_LOGS',50);

// PRINT PAGING - Number of rents to display before break page.
define('PBR_PRINT_BREAK',6);

// LOG - Positionnez la valeur à 1 si vous souhaitez écrire les erreurs dans un fichier.
define('PBR_LOG',0);

// DEBUG MODE - Positionnez la valeur à 1 si vous souhaitez afficher les erreurs à l'écran.
define('PBR_DEBUG',0);
