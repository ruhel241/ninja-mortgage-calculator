<?php


	function CalculatorRenderItems($attributes)
	{
		extract($attributes);
		$calculatorItems = calculatorGetItems($attributes);

		if(!$display){
			$display = 'mortgage_calculator';
		}
		return NinjaMortgage\Classes\View::makeView($view_file, array(
			'calculators' => $calculatorItems, 
			'display' => $display,
		));

	}

	function calculatorGetItems($attributes)
	{
		$queryArgs = array(
			'post_type' =>'ninja_mortgage_cpt',
			'meta_key'  => '_ninija_mortgage_table_config',
			'offset' 	=> intval($attributes['offset'])
		);
		$queryArgs = apply_filters('mortgage_calculator_post_query_args', $queryArgs, $attributes);
		$calculators =  get_posts($queryArgs);
		return $calculators;
	}


