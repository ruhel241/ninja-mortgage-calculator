<template>
<div>

	<el-row class="header">
		<el-col :span="24">
			<el-col :span="20">
				<h1>{{ table.post_title }} <span><code>[ninja_mortgage_cal id="{{ table_id }}"]</code></span></h1>
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
						<label>{{ all_mort_calc_table.homePrice }}</label>
						<el-input type="text"  v-model="all_mort_calc_table.homePrice" disabled></el-input>
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
						<label>Mortgage Amount</label>
						<el-input type="text" placeholder="Home Price" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>Term in years</label>
						<el-input type="text" placeholder="Down Payment" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>Interest Rate</label>
						<el-input type="text" placeholder="Down Payment" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>Annual property taxes</label>
						<el-input type="text" placeholder="Down Payment" disabled></el-input>
					</el-col>
				</el-row>
				<el-row :gutter="15">
					<el-col :span="24">
						<label>Annual Home Insurance</label>
						<el-input type="text" placeholder="Down Payment" disabled></el-input>
					</el-col>
				</el-row>
			</div>
		</el-col>
		<el-col :span="8" class="tabs_col">
			<!-- Tabs Component -->
			<app-tabs :calcType="calc_type" :allMortCalcTable="all_mort_calc_table" :allRefinanceCalcTable="all_refinance_calc_table"></app-tabs>
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
				calc_type: '',
				activeName: '',
				all_mort_calc_table: {
					homePrice: 'Home Price',
					downPament: 'Down Pament',
					mortgageTerm: 'Mortgage Term',
					annualInterestRate: 'Annual Interest Rate'
				},
				all_refinance_calc_table: {
					currentlyMonthlyPayment: 'Currently Monthly Payment',
					loanIntRate: 'Current Loan interest rate',
					balanceMortgage: 'Balance left on mortgage',
					newIntRate: 'New Interest Rate',
					remainingLoanTerm: 'Remaining Loan Term',
					newLoanTerm: 'New Loan Term'
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
			updatedData: {}
			}
		},
		methods: {
			fetchTable() {
				jQuery.get(ajaxurl, {
					action: 'ninja_mortgage_ajax_actions',
					route: 'get_table',
					table_id: this.table_id
				}).then(
					response => {
						this.table = response.data.table;
						this.calc_type = this.table.post_content;
					}
				).fail(
                error => {
                    console.log(error)
                }
            )
			},

			updateTableConfig() {
				this.updatedData = {
					name: this.table.post_title,
					type: this.table.post_content,
					mortgage_table_label: this.all_mort_calc_table
				}
				console.log(this.updatedData)
				jQuery.post(ajaxurl, {
                    action: 'ninja_mortgage_ajax_actions',
                    route: 'update_table_config',
					table_config: this.updatedData
                })
                    .then(response => {
                        this.$notify.success({
                            title: 'Updated',
                            message: response.data.message
						});
						console.log(response)
                    })
			},

			updateHomePrice(updatedHomePrcLabel) {
				this.homePrice = updatedHomePrcLabel;
			},

			updateDownPament(updatedDwnPmtLabel) {
				this.downPament = updatedDwnPmtLabel;
			},

			updateMortgageTerm(updatedMortTerm) {
				this.mortgageTerm = updatedMortTerm;
			},

			updateannualInterestRate(updatedAnnIntRate) {
				this.annualInterestRate = updatedAnnIntRate;
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
