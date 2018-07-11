<template>
    <div class="tabs">
			<el-tabs v-model="activeName" @tab-click="handleClick">
				<el-tab-pane label="Label" name="first">
                    <div v-if="calcType=='mortgage_calculator'">
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allMortCalcTable.homePrice }}</label>
                                <el-input v-model="allMortCalcTable.homePrice" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allMortCalcTable.downPament }}</label>
                                <el-input v-model="allMortCalcTable.downPament" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ allMortCalcTable.mortgageTerm }}</label>
                                <el-input v-model="allMortCalcTable.mortgageTerm" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{mortgageTermMonth}}</label>
                                <el-input v-model="mortgageTermMonth" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{allMortCalcTable.annualInterestRate}}</label>
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

                </el-tab-pane>
                    
				<el-tab-pane label="Settings" name="third">Settings</el-tab-pane>
			</el-tabs>
		</div>
</template>

<script>
export default {
    name: 'tabs',
    props: ['calcType', 'allMortCalcTable', 'allRefinanceCalcTable'],
    data() {
        return {
            activeName: 'first',
            mortgageTermMonth: 'Mortgage Term Month',
            homePriceDef: 120000,
            downPamentDef: 20000,
            mortgageTermDef: 30,
            mortgageTermMonthDef: 360,
            annualInterestRateDef: 12
        }
    },
    methods: {
        handleClick(tab, event) {
				console.log(tab, event);
			}
    },
    watch: {
        homePrice() {
            this.$emit('homePriceUpd', this.homePrice);
        },
        downPament() {
            this.$emit('downPamentUpd', this.downPament);
        },
        mortgageTerm() {
            this.$emit('mortgageTermUpd', this.mortgageTerm);
        },
        annualInterestRate() {
            this.$emit('annualInterestRateUpd', this.annualInterestRate);
        }
    }
}
</script>
