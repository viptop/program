<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
*/
$active_group = 'develop';
$query_builder = TRUE;

$db['develop'] = array(
	'dsn'	=> '',
	'hostname' => '121.201.7.33',
	'port'	   => 5433,
	'username' => 'zero',
	'password' => 'ridezjndprs',
	'database' => '',
	'dbdriver' => 'pdo',
	'dbprefix' => 'zero_',
	'pconnect' => FALSE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
$db['production'] = array(
	'dsn'	=> '',
	'hostname' => '121.201.7.33',
	'port'	   => 5433,
	'username' => 'zero',
	'password' => 'ridezjndprs',
	'database' => 'zero_dev',
	'dbdriver' => 'pdo',
	'dbprefix' => 'zero_',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(
		array(
            'hostname' => 'h1',
            'username' => '',
            'password' => '',
            'database' => '',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => TRUE,
            'db_debug' => TRUE,
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE
        ),
        array(
            'hostname' => 'h2',
            'username' => '',
            'password' => '',
            'database' => '',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => TRUE,
            'db_debug' => TRUE,
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE
        )
	),
	'save_queries' => TRUE
);
//$db['production']['failover'] = array();
$db['develop']['dsn'] = 'pgsql:host=121.201.7.33;port=5433;dbname=zero_dev';
$db['production']['dsn'] = 'pgsql:host=121.201.7.33;port=5433;dbname=zero_dev';


/**
 * 控制器中的导入
 * $DB1 = $this->load->database('group_one', TRUE);
 * $DB2 = $this->load->database('group_two', TRUE);
*/
