<template>
    <div class="tabs">
			<el-tabs v-model="activeName" @tab-click="handleClick">
				<el-tab-pane label="Label" name="first">
                    <div v-if="calcType=='mortgage_calculator'">
                        <el-row>
                            <el-col :span="24">
                                <label>{{ homePrice }}</label>
                                <el-input v-model="homePrice" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ downPament }}</label>
                                <el-input v-model="downPament" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ mortgageTerm }}</label>
                                <el-input v-model="mortgageTerm" type="text"></el-input>
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
                                <label>{{annualInterestRate}}</label>
                                <el-input v-model="annualInterestRate" type="text"></el-input>
                            </el-col>
                        </el-row>
                    </div>
                </el-tab-pane>
				<el-tab-pane label="Default" name="second">
                    <div v-if="calcType=='mortgage_calculator'">
                        <el-row>
                            <el-col :span="24">
                                <label>{{ homePrice }}</label>
                                <el-input v-model="homePriceDef" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ downPament }}</label>
                                <el-input v-model="downPamentDef" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{ mortgageTerm }}</label>
                                <el-input v-model="mortgageTermDef" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{mortgageTermMonth}}</label>
                                <el-input v-model="mortgageTermMonthDef" type="text"></el-input>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <label>{{annualInterestRate}}</label>
                                <el-input v-model="annualInterestRateDef" type="text"></el-input>
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
    props: ['calcType'],
    data() {
        return {
            activeName: 'first',
            homePrice: 'Home Price',
            downPament: 'Down Pament',
            mortgageTerm: 'Mortgage Term', 
            mortgageTermMonth: 'Mortgage Term Month',
            annualInterestRate: 'Annual Interest Rate',
            homePriceDef: 0,
            downPamentDef: 0,
            mortgageTermDef: 0,
            mortgageTermMonthDef: 0,
            annualInterestRateDef: 0
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
