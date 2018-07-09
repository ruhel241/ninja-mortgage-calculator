<?php namespace NinjaMortgage\Classes;


class Menu
{

	public static function addAdminMenuPages() 
	{
	 	add_menu_page(
            __( 'Mortgage Calculator', 'ninja_mortgage' ),
            __( 'Mortgage Calculator', 'ninja_mortgage' ),
            static::managePermission(),
            'ninja-mortgage-calculator.php',
            array( static::class, 'renderMortgage'),
            '',
            6
        );
	}


	public static function managePermission()
	{	
		return apply_filters('ninja_mortgage_menu_manager_permission','manage_options');
	}


	public static function renderMortgage()
	{
		
	}



	
}

 

