<template>
	<div class="mortgage_payment_calc">
		<h1>{{ tableTitle }}</h1> 
		<div class="loan-info">
			<p><strong>Loan Information:</strong></p>
			<div class="mortgage_amount">
				<label>{{ mortgagePaymentLabel.mortgageAmount }}</label>
				<input type="number" min=0 name="mortgage_amount"
					   id="mortgage_amount" v-model="mortgage_amount_def_val"
					   class="typeNumbersField">
			</div>
			<div class="term_in_years">
				<label>{{ mortgagePaymentLabel.termInYears }}</label>
				<input type="number" min=0 name="term_in_years"
					   id="term_in_years" v-model="term_in_years_def_val"
					   class="typeNumbersField">
			</div>
			<div class="interest_rate">
				<label>{{ mortgagePaymentLabel.interestRate }}</label>
				<input type="number" min=0 name="interest_rate"
					   id="interest_rate" v-model="interest_rate_def_val"
					   class="typeNumbersField">
			</div>
			<div class="annual_property_taxes">
				<label>{{ mortgagePaymentLabel.annualPropertyTaxes }}</label>
				<input type="number" min=0 name="annual_property_taxes"
					   id="annual_property_taxes" v-model="annual_property_taxes_def_val"
					   class="typeNumbersField" placeholder="Annual Property Taxes">
			</div>
			<div class="annual_property_insurance">
				<label>{{ mortgagePaymentLabel.annualHomeInsurance }}</label>
				<input type="number" min=0 name="annual_property_insurance"
					   id="annual_property_insurance" v-model="annual_property_insurance_def_val"
					   class="typeNumbersField" placeholder="Annual Property Taxes">
			</div>
			<div class="mortgage_payment_pi">
				<label><strong>Monthly Payment(PI):</strong></label>
                <p>${{ pi.toFixed(2) }}</p>
			</div>
			<div class="mortgage_payment_piti">
				<label><strong>Monthly Payment(PITI):</strong></label>
                 <p>${{ piti.toFixed(2) }}</p>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: [
		'tableTitle',
		'mortgagePaymentLabel',
		'mortgagePaymentDefault'
	],
    data() {
        return {
        	mortgage_amount: 'Mortgage Amount',
            mortgage_amount_def_val: 120000,
            term_in_years: 'Term in years',
            term_in_years_def_val: 30,
            interest_rate: 'Interest rate',
            interest_rate_def_val: 12,
            annual_property_taxes: 'Annual Property Taxes',
            annual_property_taxes_def_val: 15,
            annual_property_insurance: 'Annual Property Insurance',
            annual_property_insurance_def_val: 15
        }
    },
    created() {
    	console.log(this.mortgagePaymentLabel);
    	this.mortgage_amount = this.mortgagePaymentLabel.mortgageAmount;
    	this.mortgage_amount_def_val = this.mortgagePaymentDefault.mortgageAmountDefVal;
    	this.term_in_years = this.mortgagePaymentLabel.termInYears;
    	this.term_in_years_def_val = this.mortgagePaymentDefault.termInYearsDefVal;
    	this.interest_rate = this.mortgagePaymentLabel.interestRate;
    	this.interest_rate_def_val = this.mortgagePaymentDefault.interestRateDefVal;
    	this.annual_property_taxes = this.mortgagePaymentLabel.annualPropertyTaxes;
    	this.annual_property_taxes_def_val = this.mortgagePaymentDefault.annualPropertyTaxesDefVal;
    	this.annual_property_insurance = this.mortgagePaymentLabel.annualHomeInsurance;
    	this.annual_property_insurance_def_val = this.mortgagePaymentDefault.annualHomeInsuranceDefVal;
    },
    computed: {
        pi() {
            if( this.interest_rate_def_val != 0 && this.mortgage_amount_def_val != 0 && this.term_in_years_def_val != 0 ) {
                var interest_rate_perc = parseFloat( this.interest_rate_def_val ) / 12;
                var interest_rate_ans = parseFloat( interest_rate_perc ) / 100;
                var int_rate_amnt = parseFloat(interest_rate_ans * this.mortgage_amount_def_val);
                var total_month = parseFloat( this.term_in_years_def_val ) * 12;
                var pi = int_rate_amnt / (  1 - (Math.pow((1 + interest_rate_ans), -(total_month) )));
                return pi;
            } else {
                return 0;
            }
        },
        piti() {
            if( this.interest_rate_def_val != 0 && this.mortgage_amount_def_val != 0 && this.term_in_years_def_val != 0 && ( this.annual_property_taxes_def_val != 0 || this.annual_property_insurance_def_val != 0 )) {
                var interest_rate_perc = parseFloat( this.interest_rate_def_val ) / 12;
                var interest_rate_ans = parseFloat( interest_rate_perc ) / 100;
                var int_rate_amnt = parseFloat(interest_rate_ans * this.mortgage_amount_def_val);
                var total_month = parseFloat( this.term_in_years_def_val ) * 12;
                var pi = int_rate_amnt / (  1 - (Math.pow((1 + interest_rate_ans), -(total_month) )));
                
                
                var piti = pi + ( this.annual_property_taxes_def_val / 12 ) + (this.annual_property_insurance_def_val / 12);
                return piti;
            } else {
                return 0;
            }
        }
    }
}
</script>

<style>
	.loan-info {
	    background-color: #E7EDF5;
	    padding: 30px;
	}

	.typeNumbersField {
		width: 100%;
		padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
    	box-sizing: border-box;
	}
</style>