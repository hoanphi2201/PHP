<?php
    // ====================== PATHS ===========================
	define ('DS'				, DIRECTORY_SEPARATOR);
	define ('ROOT_PATH'			, dirname(__FILE__));						// Định nghĩa đường dẫn đến thư mục gốc
	define ('LIBRARY_PATH'		, ROOT_PATH . DS . 'libs' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện
	define ('CONTROLLER_PATH'	, ROOT_PATH . DS . 'controller' . DS);		// Định nghĩa đường dẫn đến thư mục controllers
	define ('MODEL_PATH'		, ROOT_PATH . DS . 'models' . DS);			// Định nghĩa đường dẫn đến thư mục models
	define ('VIEW_PATH'			, ROOT_PATH . DS . 'views' . DS);			// Định nghĩa đường dẫn đến thư mục views
	define ('PUBLIC_PATH'		, ROOT_PATH . DS . 'publics' . DS);			// Định nghĩa đường dẫn đến thư mục public							
	
	define	('ROOT_URL'			, DS . 'OOP-MVC');
	define	('PUBLIC_URL'		, 'publics' . DS);
	define	('VIEW_URL'			, 'views' . DS);

	// ====================== DATABASE ===========================
	define ('DB_HOST'			, 'localhost');
	define ('DB_USER'			, 'root');						
	define ('DB_PASS'			, '');						
	define ('DB_NAME'			, 'manage_user');						
	define ('DB_TABLE'			, 'user');						
