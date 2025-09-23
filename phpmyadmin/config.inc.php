<?php
/**
 * phpMyAdmin configuration file.
 */

$cfg['blowfish_secret'] = 'scrumappdmlsae22436t346';

/* Servers configuration */
$i = 0;

$i++;
$cfg['Servers'][$i]['host'] = 'mariadb';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['auth_type'] = 'cookie'; // Use cookie-based authentication
$cfg['Servers'][$i]['AllowNoPassword'] = false; // Ensure passwords are required

/* Directories for saving/loading files */
$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';

/* Enable advanced features */
$cfg['PmaAbsoluteUri'] = '/phpmyadmin';
