<?php
    // ====================== PATHS ===========================
	define ('DS'				, '/');
	define ('ROOT_PATH'			, dirname(__FILE__));						// Định nghĩa đường dẫn đến thư mục gốc
	define ('LIBRARY_PATH'		, ROOT_PATH . DS . 'libs' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện
	define ('PUBLIC_PATH'		, ROOT_PATH . DS 	. 'publics' . DS);			// Định nghĩa đường dẫn đến thư mục public	
	define ('APPLICATION_PATH'	, ROOT_PATH . DS 	. 'application' . DS);	// Định nghĩa đường dẫn đến thư mục public
	define ('MODULE_PATH'		, APPLICATION_PATH . DS . 'module'  . DS);	// Định nghĩa đường dẫn đến thư mục module
	define ('TEMPLATE_PATH'		, PUBLIC_PATH 			. 'template' . DS);	// Định nghĩa đường dẫn đến thư mục public		
	define ('BLOCK_PATH'		, APPLICATION_PATH 		. 'block' . DS);	// Định nghĩa đường dẫn đến thư mục public							

	
	
	define ('DEFAULT_MODULE'		, 'default');	// Định nghĩa đường dẫn đến module mặc định
	define ('DEFAULT_CONTROLLER'	, 'index');	// Định nghĩa đường dẫn đến module mặc định					
	define ('DEFAULT_ACTION'		, 'index');// Định nghĩa đường dẫn đến module mặc định					


	define	('ROOT_URL'			, DS . 'Chap 11 bookstore');
	define ('APPLICATION_URL'		,'application' . DS);
	define	('PUBLIC_URL'		, 'publics' . DS);
	define	('TEMPLATE_URL'		, PUBLIC_URL .'template' . DS);


	// ====================== DATABASE ===========================
	define ('DB_HOST'			, 'localhost');
	define ('DB_USER'			, 'root');						
	define ('DB_PASS'			, '');						
	define ('DB_NAME'			, 'bookstore');						
	define ('DB_TABLE'			, 'group');		
	
	// ====================== DATABASE TABLE===========================
	define ('TBL_GROUP'			, 'group');
	define ('TBL_USER'			, 'user');

