<?php namespace NinjaMortgage\Classes;


class MortgageCalculatorHandler 
{
	

	public static function handleAjaxCalls()
	{
		$route = sanitize_text_field( $_REQUEST['route'] );

		if($route == 'add_table'){
			$tableTitle = sanitize_text_field($_REQUEST['post_title']); 
			$selectCalculator = sanitize_text_field($_REQUEST['post_content']); 
			static::addTable($tableTitle, $selectCalculator);
		}

		if($route == 'get_tables'){
			$pageNumber = intval($_REQUEST['page_number']);
			$perPage 	= intval($_REQUEST['per_page']);
			static::getTables($pageNumber, $perPage);
		}

		if ($route == 'get_table') {
            $tableId = intval($_REQUEST['table_id']);
            static::getTable($tableId, 'ajax');
        }


        if ($route == 'delete_table') {
            $tableId = intval($_REQUEST['table_id']);
            static::deleteTable($tableId);
        }

        if ($route == 'update_table_config') {
            $tableId = intval($_REQUEST['table_id']);
            $table_config = wp_unslash($_REQUEST['table_config']);
            static::updateTableConfig($tableId, $table_config);
        }


	}
	


	public static function addTable($tableTitle = '', $selectCalculator = '')
	{
		if( ! $tableTitle ){
			wp_send_json_error(array(
				'message' => __( "Please Provide Table Title", 'ninja_mortgage')
			), 423);
		}
 
		if( ! $selectCalculator ){
			wp_send_json_error(array(
				'message' => __("Please Select Calculator Type", 'ninja_mortgage')
			), 423);
		}
	

		$tableData = array(
			'post_title' => $tableTitle,
			'post_content' => $selectCalculator,
			'post_type' => CPT::$CPTName,
			'post_status' => 'publish',
		);

		$tableId = wp_insert_post($tableData);

		do_action('ninja_mortgage_added_new_table', $tableId);
		if(is_wp_error($tableId)){
			wp_send_json_error(array(
				'message' => $tableId->get_error_message()
			), 423);
		}

		wp_send_json_success(array(
            'message'  => __('Table Successfully created'),
            'table_id' => $tableId
        ), 200);


      
	}



	public  static function getTable($tableId, $returnType = 'ajax')
	{
		$table = get_post($tableId);

		$formattedTable = (object)array(
			'ID' => $table->ID,
			'post_title' => $table->post_title,
			'post_content' => $table->post_content
		);
		$tableConfig = get_post_meta($tableId, '_ninija_mortgage_table_config', true);
		 wp_send_json_success(array(
            'table'        => $formattedTable,
            'table_config' => $tableConfig,
            'MortgageCalConfig' => static::getMortgageCalConfig(),
           'demo_url' => home_url().'?ninja_mortgage_calculator_preview='.$tableId.'#ninja_mortgage_demo'
        ));

		 // wp_send_json_success(array(
		 // 	'MortgageCalConfig' => $MortgageCalConfig
		 // ));
	}


	public static function getTables($pageNumber = 1 , $perPage = 10)
	{
		$offset = ($pageNumber - 1 ) * $perPage;

		$tables = get_posts(array(
			'post_type' => CPT::$CPTName,
			'offset' => $offset,
			'posts_per_page' => $perPage
		));
		
		$totalCount = wp_count_posts(CPT::$CPTName);
	
	    $formattedTables = array();
        foreach ($tables as $table) {
            $formattedTables[] = array(
                'ID'         => $table->ID,
                'post_title' => $table->post_title,
                'post_content' => $table->post_content,
                'demo_url' => home_url().'?ninja_mortgage_calculator_preview='.$table->ID.'#ninja_mortgage_demo'
            );
        }
        wp_send_json_success(array(
            'tables' => $formattedTables,
            'total' => intval($totalCount->publish)
        ), 200);
	}


	public static function deleteTable($tableId)
	{
		delete_post_meta($tableId, '_ninija_mortgage_table_config');	
		wp_delete_post($tableId);
		wp_send_json_success(array(
            'message' => __('The Table successfully deleted!', 'ninja_mortgage')
        ), 200);
	}


	public static function updateTableConfig($tableId, $table_config)
	{
		 update_post_meta($tableId, '_ninija_mortgage_table_config', $table_config);

		// $updatedData = get_post_meta($tableId, '_ninija_mortgage_table_config', true);

		do_action('ninija_mortgage_table_config_updated', $tableId, $table_config);
		wp_send_json_success(array(
            'message' => __('Table Content has been updated', 'ninja_mortgage'),
             // 'updatedData' => $updatedData
        ));

        
	}


	public static function populateDemoData($tableId) //add meta label etc
    {
        update_post_meta($tableId, '_ninija_mortgage_table_config', static::getMortgageCalConfig());
    }



    public static function getMortgageCalConfig()
    {
    	return array(
			
			'all_mort_calc_table' => array(
                'homePrice' 	     => 'Home Price',
                'downPament'	     => 'Down Pament',
                'mortgageTerm'	     => 'Mortgage Term',
                'annualInterestRate' => 'Annual Interest Rate'
            ),

			'all_refinance_calc_table' => array(
				'currentlyMonthlyPayment' => 'Currently Monthly Payment',
				'loanIntRate' 			  => 'Current Loan interest rate',
				'balanceMortgage'		  => 'Balance left on mortgage',
				'newIntRate' 			  => 'New Interest Rate',
				'remainingLoanTerm'		  => 'Remaining Loan Term',
				'newLoanTerm' 			  => 'New Loan Term'
			),
			
			'all_payment_calc_table' => array(
				'mortgageAmount' 	  => 'Mortgage Amount',
				'termInYears' 		  => 'Term in years',
				'interestRate' 		  => 'Interest Rate',
				'annualPropertyTaxes' => 'Annual Property Taxes',
				'annualHomeInsurance' => 'Annual Home Insurance'
			),

			'component_settings' => array(
                array('key' => 'all_mort_calc_table'),
                array('key' => 'all_refinance_calc_table'),
                array('key' => 'all_payment_calc_table'),
            ),

		);
    }










}






