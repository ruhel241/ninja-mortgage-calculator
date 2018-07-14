<template>
	<div id="mortgage_calculator">

		<!-- Field Section -->
		<div>
			<div class="loanAmountSection">
				<label>Loan Amount</label>
				<input type="text" id="loanAmount" 
						   	 	   name="loanAmount" 
						           placeholder="Loan Amount"
						           v-model="loanAmount">
			</div>
			<div class="downPamentSection">
				<div class="downPament">
					<label>Down Pament</label>
					<input type="text" id="downPament" 
							   	   	   name="downPament" 
							           placeholder="Down Pament"
							           v-model="downPament"
							           >
				</div>
				<div class="downPamentPerc">
					<label>Down Pament Percentage</label>
					<input type="text" id="downPamentPerc" 
						   	   	   name="downPamentPerc" 
						           placeholder="Down Pament Percentage"
						           v-model="downPamentPerc">
				</div>
			</div>
			<div class="mortgageTermSection">
				<div class="mortgageTerm">
					<label>Mortgage Term</label>
					<input type="text" id="mortgageTerm" 
							   	   	   name="mortgageTerm" 
							           placeholder="Mortgage Term"
							           v-model="mortgageTerm">
				</div>
				<div class="mortgageTermMonth">
					<label>Mortgage Term Month</label>
					<input type="text" id="mortgageTermMonth" 
							   	   	   name="mortgageTermMonth" 
							           placeholder="Mortgage Term Month"
							           v-model="mortgageTermMonth">
				</div>
			</div>
			<div class="annualIntRateSection">
				<label>Annual Interest Rate</label>
				<input type="text" id="annualInterestRate" 
						   	 	   name="annualInterestRate" 
						           placeholder="Annual Interest Rate"
						           v-model="annualInterestRate">
			</div>
		</div>
		<!-- End Field Section -->

		<!-- All Cost Section -->


        <div style="margin-top: 10px; margin-left: 0;">

            <p>Your estimated monthly payment:</p>
            <h3><span>$</span> 5.66</h3>
            <p>Total principal paid: $5.68</p>
            <p>Total interest paid: $5.99</p>
        
        </div>

	</div>
</template>

<script>
	export default {
		data() {
			return {
				loanAmount: 120000,
	            downPament: 20000,
	            downPamentPerc: 0,
	            mortgageTerm: 30,
	            mortgageTermMonth: 360,
	            annualInterestRate: 12
			}
		}
	}
</script>

<style>
	input[type=text] {
	    width: 100%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
    box-sizing: border-box;
}

	.downPament {
		width: 50%;
		float: left;
	}

	.downPamentPerc {
		width: 50%;
		float: left;
	}

	.mortgageTerm {
		width: 50%;
		float: left;
	}

	.mortgageTermMonth {
		width: 50%;
		float: left;
	}
</style>