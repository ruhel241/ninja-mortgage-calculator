<template>
	<div class="mortgage_payment_calc">
		<h1>Mortgage Payment Calculator</h1>
		<div class="loan-info">
			<p><strong>Loan Information:</strong></p>
			<div class="mortgage_amount">
				<label>Mortgage Amount</label>
				<input type="number" min=0 name="mortgage_amount"
					   id="mortgage_amount" v-model="mortgage_amount"
					   class="typeNumbersField">
			</div>
			<div class="term_in_years">
				<label>Term in years</label>
				<input type="number" min=0 name="term_in_years"
					   id="term_in_years" v-model="term_in_years"
					   class="typeNumbersField">
			</div>
			<div class="term_in_years">
				<label>Term in years</label>
				<input type="number" min=0 name="term_in_years"
					   id="term_in_years" v-model="term_in_years"
					   class="typeNumbersField">
			</div>
			<div class="interest_rate">
				<label>Interest Rate</label>
				<input type="number" min=0 name="interest_rate"
					   id="interest_rate" v-model="interest_rate"
					   class="typeNumbersField">
			</div>
			<div class="annual_property_taxes">
				<label>Annual Property Taxes</label>
				<input type="number" min=0 name="annual_property_taxes"
					   id="annual_property_taxes" v-model="annual_property_taxes"
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
    data() {
        return {
            mortgage_amount: 120000,
            term_in_years: 30,
            interest_rate: 12,
            annual_property_taxes: 15,
            annual_property_insurance: 15
        }
    },
    computed: {
        pi() {
            if( this.interest_rate != 0 && this.mortgage_amount != 0 && this.term_in_years != 0 ) {
                var interest_rate_perc = parseFloat( this.interest_rate ) / 12;
                var interest_rate_ans = parseFloat( interest_rate_perc ) / 100;
                var int_rate_amnt = parseFloat(interest_rate_ans * this.mortgage_amount);
                var total_month = parseFloat( this.term_in_years ) * 12;
                var pi = int_rate_amnt / (  1 - (Math.pow((1 + interest_rate_ans), -(total_month) )));
                return pi;
            } else {
                return 0;
            }
        },
        piti() {
            if( this.interest_rate != 0 && this.mortgage_amount != 0 && this.term_in_years != 0 && ( this.annual_property_taxes != 0 || this.annual_property_insurance != 0 )) {
                var interest_rate_perc = parseFloat( this.interest_rate ) / 12;
                var interest_rate_ans = parseFloat( interest_rate_perc ) / 100;
                var int_rate_amnt = parseFloat(interest_rate_ans * this.mortgage_amount);
                var total_month = parseFloat( this.term_in_years ) * 12;
                var pi = int_rate_amnt / (  1 - (Math.pow((1 + interest_rate_ans), -(total_month) )));
                
                
                var piti = pi + ( this.annual_property_taxes / 12 ) + (this.annual_property_insurance / 12);
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