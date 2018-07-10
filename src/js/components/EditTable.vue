<template>
	<div class="mortgage_calc">
		<div class="title">
			<h2>This is Edit Table</h2>
		</div>
		<div class="change_calc">
			<el-select v-model="calc_type" placeholder="Calculator Type">
				<el-option
                        v-for="(type, i) in calc_types"
                        :key="i"
                        :label="type.label"
                        :value="type.value">
                    </el-option>
			</el-select>
		</div>

		<div class="tabs">
			<el-tabs v-model="activeName" @tab-click="handleClick">
				<el-tab-pane label="Label" name="first">Label</el-tab-pane>
				<el-tab-pane label="Default" name="second">Default</el-tab-pane>
				<el-tab-pane label="Setting" name="third">Setting</el-tab-pane>
			</el-tabs>
		</div>

		<div v-if="calc_type=='mortgage_calculator'">
			<el-row :gutter="15" style="margin-top: 20px">
				<el-col :span="15">
					<label>Home Price</label>
					<el-input type="number" placeholder="Home Price" min=0></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="8">
					<label>Down Pament</label>
					<el-input type="number" placeholder="Down Payment" 
									min=0
									name="downPayment"
									id="downPayment"></el-input>
				</el-col>
				<el-col :span="7">
					<label>Down Pament Percentage</label>
					<el-input type="number" placeholder="Down Pament Percentage"></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="8">
					<label>Mortgage term</label>
					<el-input type="number" placeholder="Mortgage Term" min=0
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;"
									name="mortgageTerm"
									id="mortgageTerm"></el-input>
				</el-col>
				<el-col :span="7">
					<label>Mortgage term month</label>
					<el-input type="number" 
									placeholder="Mortgage Term Month" 
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;"
									min=0></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="15">
					<label>Annual interest rate</label>
					<el-input type="number" placeholder="Annual interest rate" min=0
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;"
									name="annualInterestRate"
									id="annualInterestRate"></el-input>
				</el-col>
			</el-row>
		</div>

		<div v-if="calc_type==='mortgage_refinance'">
			<el-row :gutter="15" style="margin-top: 20px">
				<el-col :span="15">
					<label>Current monthly payment</label>
					<el-input type="number" placeholder="Home Price" min=0></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="8">
					<label>Current loan interest rate</label>
					<el-input type="number" placeholder="Down Payment" 
									min=0
									name="downPayment"
									id="downPayment"></el-input>
				</el-col>
				<el-col :span="7">
					<label>Balance left on mortgage</label>
					<el-input type="number" placeholder="Down Pament Percentage"></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="8">
					<label>New Interest Rate</label>
					<el-input type="number" placeholder="Down Payment" 
									min=0
									name="downPayment"
									id="downPayment"></el-input>
				</el-col>
				<el-col :span="7">
					<label>Remaining loan term</label>
					<el-input type="number" placeholder="Down Pament Percentage"></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="8">
					<label>New Loan Term</label>
					<el-input type="number" placeholder="Down Payment" 
									min=0
									name="downPayment"
									id="downPayment"></el-input>
				</el-col>
			</el-row>
		</div>
		<div v-if="calc_type==='mortgage_payment'">
			<el-row :gutter="15" style="margin-top: 20px">
				<el-col :span="15">
					<label>Mortgage Amount</label>
					<el-input type="number" placeholder="Home Price" min=0></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="15">
					<label>Term in years</label>
					<el-input type="number" placeholder="Down Payment" 
									min=0
									name="downPayment"
									id="downPayment"></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="15">
					<label>Interest Rate</label>
					<el-input type="number" placeholder="Down Payment" 
									min=0
									name="downPayment"
									id="downPayment"></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="15">
					<label>Annual property taxes</label>
					<el-input type="number" placeholder="Down Payment" 
									min=0
									name="downPayment"
									id="downPayment"></el-input>
				</el-col>
			</el-row>
			<el-row :gutter="15">
				<el-col :span="15">
					<label>Annual Home Insurance</label>
					<el-input type="number" placeholder="Down Payment" 
									min=0
									name="downPayment"
									id="downPayment"></el-input>
				</el-col>
			</el-row>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				table_id: this.$route.params.table_id,
				table: {},
				calc_type: 'mortgage_payment',
				activeName: '',
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
            ]
			}
		},
		methods: {
			handleClick(tab, event) {
				console.log(tab, event);
			}
		}
	}
</script>


<style>
.mortgage_calc {
	width: 75%;
	margin: 0 auto;
}

.title {
	float: left;
}

.change_type {
	float: right;
}

.el-select {
	margin-left: 205px;
}

.tabs {
	width: 36%;
	float: right;
}
</style>
