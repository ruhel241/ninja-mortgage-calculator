<template>
    <div class="tabs">
            <el-tabs v-model="activeName" @tab-click="handleClick">
                <el-tab-pane label="Label" name="first">
                    <div v-if="calcType=='mortgage_calculator'">
                        <el-row>
                            <el-col :span="24">
                                <label>Loan Amount</label>
                                <el-input v-model="allMortCalcTable.loanAmount" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>Down Pament</label>
                                <el-input v-model="allMortCalcTable.downPament" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>Mortgage Term</label>
                                <el-input v-model="allMortCalcTable.mortgageTerm" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>Annual Interest Rate</label>
                                <el-input v-model="allMortCalcTable.annualInterestRate" type="text"></el-input>
                            </el-col>
                        </el-row>
                    </div>

                    <div v-if="calcType=='mortgage_refinance'">
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.currentlyMonthlyPayment }}</label>
                                <el-input type="text" v-model="allRefinanceCalcTable.currentlyMonthlyPayment"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.loanIntRate }}</label>
                                <el-input type="text" v-model="allRefinanceCalcTable.loanIntRate"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.balanceMortgage }}</label>
                                <el-input type="text" v-model="allRefinanceCalcTable.balanceMortgage"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.newIntRate }}</label>
                                <el-input type="text" v-model="allRefinanceCalcTable.newIntRate"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.remainingLoanTerm }}</label>
                                <el-input type="text" v-model="allRefinanceCalcTable.remainingLoanTerm"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.newLoanTerm }}</label>
                                <el-input type="text" v-model="allRefinanceCalcTable.newLoanTerm"></el-input>
                            </el-col>
                        </el-row>
                    </div>

                    <div v-if="calcType=='mortgage_payment'">
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.mortgageAmount }}</label>
                                <el-input type="text" v-model="allPaymentCalcTable.mortgageAmount"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.termInYears }}</label>
                                <el-input type="text" v-model="allPaymentCalcTable.termInYears"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.interestRate }}</label>
                                <el-input type="text" v-model="allPaymentCalcTable.interestRate"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.annualPropertyTaxes }}</label>
                                <el-input type="text" v-model="allPaymentCalcTable.annualPropertyTaxes"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.annualHomeInsurance }}</label>
                                <el-input type="text" v-model="allPaymentCalcTable.annualHomeInsurance"></el-input>
                            </el-col>
                        </el-row>
                    </div>

                </el-tab-pane>

                <el-tab-pane label="Default Values" name="second">
                    <div v-if="calcType=='mortgage_calculator'">
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allMortCalcTable.loanAmount }}</label>
                                <el-input type="text" v-model="allMortCalcDefVal.loanAmountDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allMortCalcTable.downPament }}</label>
                                <el-input type="text" v-model="allMortCalcDefVal.downPamentDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allMortCalcTable.mortgageTerm }}</label>
                                <el-input type="text" v-model="allMortCalcDefVal.mortgageTermDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allMortCalcTable.annualInterestRate }}</label>
                                <el-input type="text" v-model="allMortCalcDefVal.annualInterestRateDefVal"></el-input>
                            </el-col>
                        </el-row>
                    </div>


                    <div v-if="calcType=='mortgage_refinance'">
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.currentlyMonthlyPayment }}</label>
                                <el-input type="text" v-model="allRefinanceDefVal.currentlyMonthlyPaymentDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.loanIntRate }}</label>
                                <el-input type="text" v-model="allRefinanceDefVal.loanIntRateDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.balanceMortgage }}</label>
                                <el-input type="text" v-model="allRefinanceDefVal.balanceMortgageDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.newIntRate }}</label>
                                <el-input type="text" v-model="allRefinanceDefVal.newIntRateDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.remainingLoanTerm }}</label>
                                <el-input type="text" v-model="allRefinanceDefVal.remainingLoanTermDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allRefinanceCalcTable.newLoanTerm }}</label>
                                <el-input type="text" v-model="allRefinanceDefVal.newLoanTermDefVal"></el-input>
                            </el-col>
                        </el-row>
                    </div>


                    <div v-if="calcType=='mortgage_payment'">
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.mortgageAmount }}</label>
                                <el-input type="text" v-model="allPaymentCalcTableDefVal.mortgageAmountDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.termInYears }}</label>
                                <el-input type="text" v-model="allPaymentCalcTableDefVal.termInYearsDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.interestRate }}</label>
                                <el-input type="text" v-model="allPaymentCalcTableDefVal.interestRateDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.annualPropertyTaxes }}</label>
                                <el-input type="text" v-model="allPaymentCalcTableDefVal.annualPropertyTaxesDefVal"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allPaymentCalcTable.annualHomeInsurance }}</label>
                                <el-input type="text" v-model="allPaymentCalcTableDefVal.annualHomeInsuranceDefVal"></el-input>
                            </el-col>
                        </el-row>
                    </div>
                </el-tab-pane>
                    
                <el-tab-pane label="Settings" name="third">
                    <div v-if="calcType=='mortgage_calculator'">
                        <el-row>
                            <el-col :span="8">
                                <label>Show Amortization Field</label>
                                <el-switch
                                v-model="amortizationtable"
                                active-color="#13ce66"
                                inactive-color="#ff4949">
                                </el-switch>
                            </el-col>
                        </el-row>
                    </div>
                </el-tab-pane>
            </el-tabs>
        </div>
</template>

<script>

export default {
    name: 'tabs',
    props: [
            'calcType', 
            'allMortCalcTable', 
            'allRefinanceCalcTable', 
            'allPaymentCalcTable', 
            'allMortCalcDefVal',
            'allRefinanceDefVal',
            'allPaymentCalcTableDefVal',
            'amortTable'
           ],
    data() {
        return {
            activeName: 'first',
            mortgageTermMonth: 'Mortgage Term Month',
            amortizationtable: this.amortTable
        }
    },
    methods: {
        handleClick(tab, event) {}
    },
    created() {
        console.log("From child " + this.amortizationtable)
    },
    watch: {
        amortizationtable() {
            this.$emit('changedAmort', this.amortizationtable);
        }
    }
}
</script>
