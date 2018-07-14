<template>
<div>

	<el-row class="header">
		<el-col :span="24">
			<el-col :span="20">
				<h1>{{ post_title }} <span><code>[ninja_mortgage_cal id="{{ table_id }}"]</code></span></h1>
			</el-col>
			<el-col :span="4">
				<el-button class="common_btn" @click="updateTableConfig()">Update</el-button>
				<el-button class="common_btn">Preview</el-button>
			</el-col>
		</el-col>
	</el-row>


	<el-row>
		<el-col :span="15" class="fields">

			<h2 v-if="calc_type==='mortgage_payment'">Mortgage Payment</h2>
			<h2 v-if="calc_type==='mortgage_calculator'">Mortgage Calculator</h2>
			<h2 v-if="calc_type==='mortgage_refinance'">Mortgage Refinance</h2>

			<div class="change_type">
				<el-select v-model="calc_type" placeholder="Calculator Type">
					<el-option
							v-for="(type, i) in calc_types"
							:key="i"
							:label="type.label"
							:value="type.value">
						</el-option>
				</el-select>
			</div>

			<div v-if="calc_type=='mortgage_calculator'"  style="margin-top: 20px">
				<el-row :gutter="15">
					<el-col :span="24">
						<label>{{ all_mort_calc_table.loanAmount }} </label>
						<el-input type="text"  v-model="all_mort_calc_table.loanAmount" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="12">
						<label>{{ all_mort_calc_table.downPament }}</label>
						<el-input type="text" v-model="all_mort_calc_table.downPament" disabled></el-input>
					</el-col>
					<el-col :span="12">
						<label>Down Pament Percentage</label>
						<el-input type="text" placeholder="Down Pament Percentage" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="12">
						<label>{{ all_mort_calc_table.mortgageTerm }}</label>
						<el-input type="text" placeholder="Mortgage Term" v-model="all_mort_calc_table.mortgageTerm" disabled></el-input>
					</el-col>
					<el-col :span="12">
						<label>Mortgage term month</label>
						<el-input type="text" 
										placeholder="Mortgage Term Month" 
										disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>{{ all_mort_calc_table.annualInterestRate }}</label>
						<el-input type="text" disabled v-model="all_mort_calc_table.annualInterestRate"></el-input>
					</el-col>
				</el-row>
			</div>

			<div v-if="calc_type==='mortgage_refinance'">
				<el-row :gutter="15" style="margin-top: 20px">
					<el-col :span="24">
						<label>{{ all_refinance_calc_table.currentlyMonthlyPayment }}</label>
						<el-input type="text" placeholder="Current monthly payment" v-model="all_refinance_calc_table.currentlyMonthlyPayment" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="12">
						<label>{{ all_refinance_calc_table.loanIntRate }}</label>
						<el-input type="text" placeholder="Current loan interest rate" v-model="all_refinance_calc_table.loanIntRate" disabled></el-input>
					</el-col>
					<el-col :span="12">
						<label>{{ all_refinance_calc_table.balanceMortgage }}</label>
						<el-input type="text" placeholder="Balance left on mortgage" v-model="all_refinance_calc_table.balanceMortgage" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="12">
						<label>{{ all_refinance_calc_table.newIntRate }}</label>
						<el-input type="text" placeholder="New Interest Rate" v-model="all_refinance_calc_table.newIntRate" disabled></el-input>
					</el-col>
					<el-col :span="12">
						<label>{{ all_refinance_calc_table.remainingLoanTerm }}</label>
						<el-input type="text" placeholder="Remaining loan term" v-model="all_refinance_calc_table.remainingLoanTerm" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>{{ all_refinance_calc_table.newLoanTerm }}</label>
						<el-input type="text" placeholder="New Loan Term" v-model="all_refinance_calc_table.newLoanTerm" disabled></el-input>
					</el-col>
				</el-row>
			</div>


			<div v-if="calc_type==='mortgage_payment'">
				<el-row :gutter="15" style="margin-top: 20px">
					<el-col :span="24">
						<label>{{ all_payment_calc_table.mortgageAmount }}</label>
						<el-input type="text" v-model="all_payment_calc_table.mortgageAmount" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>{{ all_payment_calc_table.termInYears }}</label>
						<el-input type="text" v-model="all_payment_calc_table.termInYears" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>{{ all_payment_calc_table.interestRate }}</label>
						<el-input type="text" v-model="all_payment_calc_table.interestRate" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>{{ all_payment_calc_table.annualPropertyTaxes }}</label>
						<el-input type="text" v-model="all_payment_calc_table.annualPropertyTaxes" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>{{ all_payment_calc_table.annualHomeInsurance }}</label>
						<el-input type="text" v-model="all_payment_calc_table.annualHomeInsurance" disabled></el-input>
					</el-col>
				</el-row>
			</div>
		</el-col>
		<el-col :span="8" class="tabs_col">
			<!-- Tabs Component -->
			<app-tabs :calcType="calc_type" 
					  :allMortCalcTable="all_mort_calc_table" 
					  :allRefinanceCalcTable="all_refinance_calc_table"
					  :allPaymentCalcTable="all_payment_calc_table"
					  :allMortCalcDefVal="all_mort_calc_table_def_val"
					  :allRefinanceDefVal="all_refinance_calc_table_def_val"
					  :allPaymentCalcTableDefVal="all_payment_calc_table_def_val"
					  :amortTable="amortization_table"
					  @changedAmort="updateAmort($event)"></app-tabs>
		</el-col>
	</el-row>
</div>
</template>

<script>
import Tabs from './Tabs.vue'
export default {
		name: 'editTable',
		components: {
			'app-tabs': Tabs
		},
		data() {
			return {
				table_id: this.$route.params.table_id,
				table: {},
				post_title: '',
				calc_type: '',
				tableConfig:'',
				activeName: '',
				MortgageCalConfig: {},
				amortization_table: true,
				all_mort_calc_table: {
					loanAmount: 'Loan Amount', 
					downPament: 'Down Pament',
					mortgageTerm: 'Mortgage Term', 
					annualInterestRate: 'Annual Interest Rate'
				},
				all_mort_calc_table_def_val: {
					loanAmountDefVal: 120000,
					downPamentDefVal: 20000,
					mortgageTermDefVal: 30,
					annualInterestRateDefVal: 12
				},
				all_refinance_calc_table: {
					currentlyMonthlyPayment: 'Currently Monthly Pament', 
					loanIntRate: 'Current loan interest rate',
					balanceMortgage: 'Balance left on mortgage',
					newIntRate: 'New Interest Rate', 
					remainingLoanTerm: 'Remaining Loan Term',
					newLoanTerm: 'New Loan Term'
				},
				all_refinance_calc_table_def_val: {
					currentlyMonthlyPaymentDefVal: 1200,
					loanIntRateDefVal: 25,
					balanceMortgageDefVal: 25000,
					newIntRateDefVal: 15,
					remainingLoanTermDefVal: 20,
					newLoanTermDefVal: 26
				},
				all_payment_calc_table: {
					mortgageAmount: 'Mortgage Amount',
					termInYears: 'Term in Years',
					interestRate: 'Interest Rate', 
					annualHomeInsurance: 'Annual Home Insurance',
					annualPropertyTaxes: 'Annual Property Taxes'
				},
				all_payment_calc_table_def_val: {
					mortgageAmountDefVal: 2500,
					termInYearsDefVal: 5,
					interestRateDefVal: 25,
					annualHomeInsuranceDefVal: 3500,
					annualPropertyTaxesDefVal: 1500
				},
				calc_types: [
                {
                    value: 'mortgage_calculator',
                    label: 'Mortgage Calculator'
                }, 
                {
                    value: 'mortgage_refinance',
                    label: 'Mortgage Refinance Calculator'
                }, 
                {
                    value: 'mortgage_payment',
                    label: 'Mortgage Payment Calculator'
                }
            ],
			updatedData: {},
			bool: false
			}
		},
		methods: {
			fetchTable() {
				jQuery.get(ajaxurl, {
					action: 'ninja_mortgage_ajax_actions',
					route: 'get_table',
					table_id: this.table_id,

				}).then(
					(response) => {
						console.log(response)
						if(response.data.table_config.amortization_table) {
							this.amortization_table = response.data.table_config.amortization_table;
						}

						if(response.data.table_config.post_content) {
							this.calc_type = response.data.table_config.post_content;
						} else {
							this.calc_type = response.data.table.post_content;
						}
						
						this.post_title = response.data.table.post_title;

						if(this.calc_type == 'mortgage_calculator' ) {
							
							console.log("Amortization table " + response.data.table_config.amortization_table)
							if(response.data.table_config.selectedLabel) {
								this.all_mort_calc_table = response.data.table_config.selectedLabel;
							}

							if(response.data.table_config.selectedDefault) {
								this.all_mort_calc_table_def_val = response.data.table_config.selectedDefault;
							}

						}
						else if(this.calc_type == 'mortgage_refinance') {
							
							if(response.data.table_config.selectedLabel) {
								this.all_refinance_calc_table = response.data.table_config.selectedLabel;
							}

							if(response.data.table_config.selectedDefault) {
								this.all_refinance_calc_table_def_val = response.data.table_config.selectedDefault;
							}

						}

						else if(this.calc_type == 'mortgage_payment') {
							
							if(response.data.table_config.selectedLabel) {
								this.all_payment_calc_table = response.data.table_config.selectedLabel;
							}

							if(response.data.table_config.selectedDefault) {
								this.all_payment_calc_table_def_val = response.data.table_config.selectedDefault;
							}

						}
					}
				).fail(
	                error => {
	                    console.log(error)
	                }
            	)
			},

			updateTableConfig() {

				this.bool = true;

				console.log(this.all_mort_calc_table_def_val)

				if( this.calc_type === 'mortgage_calculator' ) {
					var selected_label = this.all_mort_calc_table;
					var selected_default = this.all_mort_calc_table_def_val;
				}
				else if( this.calc_type === 'mortgage_refinance' ) {
					var selected_label = this.all_refinance_calc_table;
					var selected_default = this.all_refinance_calc_table_def_val;
				}
				else {
					var selected_label = this.all_payment_calc_table;
					var selected_default = this.all_payment_calc_table_def_val;
				}



				console.log(selected_label);



				this.updatedData = {
					post_title: this.post_title,
					post_content: this.calc_type,
					selectedLabel: selected_label ,
					selectedDefault: selected_default,
					amortization_table: this.ammortization_table
				}

				console.log(this.updatedData)

				jQuery.post(ajaxurl, {
                    action: 'ninja_mortgage_ajax_actions',
                    route: 'update_table_config',
                    table_id: this.table_id,
					table_config: this.updatedData
                }).then(response => {
                    this.$notify.success({
                        title: 'Updated',
                        message: response.data.message
					});
					console.log(response)
					if( this.calc_type == 'mortgage_calculator' ) {
						this.all_mort_calc_table = response.data.updatedData.selectedLabel;
						this.all_mort_calc_table_def_val = response.data.updatedData.selectedDefault;
					}
					else if( this.calc_type == 'mortgage_refinance' ) {
						this.all_refinance_calc_table = response.data.updatedData.selectedLabel;
						this.all_refinance_calc_table_def_val = response.data.updatedData.selectedDefault
					}
					else if( this.calc_type == 'mortgage_payment' ) {
						this.all_payment_calc_table = response.data.updatedData.selectedLabel;
						this.all_payment_calc_table_def_val = response.data.updatedData.selectedDefault
					}
                })
			},
			updateAmort(ammortization) {
				this.ammortization_table = ammortization;
				console.log(this.ammortization_table)
			}
		},
		created() {
			this.fetchTable();
		}
	}
</script>


<style>
.header {
	font-size: 20px;
    padding-bottom: 10px;
    background: #fff;
    margin-top: -20px;
    padding-top: 22px;
    margin-right: -20px;
    margin-left: -20px;
    padding-left: 24px;
}

.inputFields {
	width: 100%;
	margin: 0 auto;
}

.title {
	float: left;
}

.change_type {
	float: right;
    /* margin-right: 436px; */
	margin-top: -36px;
}

.tabs_col {
	background: #fff;
    margin-top: 15px;
    padding-right: 12px;
	padding-left: 10px;
	padding-bottom: 10px;
}

.common_btn {
	margin: 0 !important;
}

.fields {
	background: #fff;
	margin-top: 15px;
	margin-right: 20px;
	padding: 20px;
}

.fields h2{
	margin-top: 0;
}

</style>
