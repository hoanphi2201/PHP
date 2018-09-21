<?php
    // ====================== PATHS ===========================
	define ('DS'				, DIRECTORY_SEPARATOR);
	define ('ROOT_PATH'			, dirname(__FILE__));						// Định nghĩa đường dẫn đến thư mục gốc
	define ('LIBRARY_PATH'		, ROOT_PATH . DS . 'libs' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện
	define ('PUBLIC_PATH'		, ROOT_PATH . DS . 'publics' . DS);			// Định nghĩa đường dẫn đến thư mục public	
	define ('APPLICATION_PATH'		, ROOT_PATH . DS . 'application' . DS);	// Định nghĩa đường dẫn đến thư mục public
	define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);	// Định nghĩa đường dẫn đến thư mục public							

	
	define ('DEFAULT_MODULE'		, 'default');	// Định nghĩa đường dẫn đến module mặc định
	define ('DEFAULT_CONTROLLER'	, 'index');	// Định nghĩa đường dẫn đến module mặc định					
	define ('DEFAULT_ACTION'		, 'index');// Định nghĩa đường dẫn đến module mặc định					


	define	('ROOT_URL'			, DS . 'Chap 10 -OOP -MVC-02');
	define ('APPLICATION_URL'		,'application' . DS);
	define	('PUBLIC_URL'		, 'publics' . DS);
	define	('TEMPLATE_URL'		, PUBLIC_URL .'template' . DS);


	// ====================== DATABASE ===========================
	define ('DB_HOST'			, 'localhost');
	define ('DB_USER'			, 'root');						
	define ('DB_PASS'			, '');						
	define ('DB_NAME'			, 'manage_user');						
	define ('DB_TABLE'			, 'user');						
