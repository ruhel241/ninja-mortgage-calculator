<template>
	<div id="mortgage_calculator">

		<!-- Field Section -->
		<div>
            <h3>{{ tableTitle }}</h3>
			<div class="loanAmountSection">
				<label>{{ mortgageCalcLabel.loanAmount }}</label><br />
				<input type="number" min=0 id="loanAmount" 
									class="typeNumber"
						   	 	   name="loanAmount" 
						           v-model="loanAmount"
						           pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;"
						           v-validate="rules"
                                   :class="{'error': errors.has('loanAmount') }">
                <span v-if="errors.has('loanAmount')" style="color: red;">
                    {{ errors.first('loanAmount') }}
                </span>
			</div>
			<div class="downPamentSection">
				<div class="downPament">
					<label>{{ mortgageCalcLabel.downPament }}</label><br />
					<input type="number" min=0 id="downPament"
										class="typeNumbers" 
							   	   	   name="downPament" 
							           placeholder="Down Pament"
							           v-model="downPament"
							           >
				</div>
				<div class="downPamentPerc">
					<label>{{ mortgageCalcLabel.downPament }} Percentage</label>
					<input type="number" min=0 id="downPamentPerc" 
								   class="typeNumbers"
						   	   	   name="downPamentPerc" 
						           placeholder="Down Pament Percentage"
						           v-model="downPamentPerc">
				</div>
			</div>
			<div class="mortgageTermSection">
				<div class="mortgageTerm">
					<label>{{ mortgageCalcLabel.mortgageTerm }}</label>
					<input type="number" min=0 id="mortgageTerm" 
									   class="typeNumbers"
							   	   	   name="mortgageTerm" 
							           placeholder="Mortgage Term"
							           v-model="mortgageTerm"
							           pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;"
							           v-validate="term_rule"
                                	   :class="{'error': errors.has('mortgageTerm') }">
                    <span v-if="errors.has('mortgageTerm')" style="color: red;">
	                    {{ errors.first('mortgageTerm') }}
	                </span>
				</div>
				<div class="mortgageTermMonth">
					<label>{{ mortgageCalcLabel.mortgageTerm }} Month</label>
					<input type="number" min=0 id="mortgageTermMonth"
									   class="typeNumbers" 
							   	  	   name="mortgageTermMonth" 
							           placeholder="Mortgage Term Month"
							           v-model="mortgageTermMonth"
							           pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;"
							           v-validate="term_rule_month"
                                       :class="{'error': errors.has('mortgageTermMonth') }">
                    <span v-if="errors.has('mortgageTermMonth')" style="color: red;">
	                    {{ errors.first('mortgageTermMonth') }}
	                </span>
				</div>
			</div>
			<div class="annualIntRateSection">
				<label>{{ mortgageCalcLabel.annualInterestRate }}</label><br />
				<input type="number" min=0 id="annualInterestRate" 
								   class="typeNumber"
						   	 	   name="annualInterestRate" 
						           placeholder="Annual Interest Rate"
						           v-model="annualInterestRate"
						           pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;"
						           v-validate="annual_int_rate_term"
                                   :class="{'error': errors.has('annualInterestRate') }">
                <span v-if="errors.has('annualInterestRate')" style="color: red;">
                    {{ errors.first('annualInterestRate') }}
                </span>  
			</div>
		</div>
		<!-- End Field Section -->

		<!-- All Cost Section -->


        <div style="margin-top: 10px; margin-left: 0;">

            <p>Your estimated monthly payment:</p>
            <h1><span>$</span> {{ (monthlyPayment).toFixed(2) }}</h1>
            <p>Total principal paid: ${{ principalPaid }}</p>
            <p>Total interest paid: ${{ (total_interest).toFixed(2) }}</p>
        
        </div>

        <div class="btns" v-if="amortizationTable==true">
            <button @click="paymentSchedule()" v-if="showAmortBtn" class="paymentBtn">Payment Schedule</button>
            <button @click="hidePaymentSchedule()" v-if="!showAmortBtn" class="hidePaymentBtn">Hide Payment Schedule</button>
        </div>

        <div class="ammortization_section" v-if="showTable">

            <p>
                <strong>Amortization Schedule</strong>
            </p>

            <div class="est_payoff">
                    
                    <label>Start Date</label>
                    <input type="text" v-model="date" name="date" v-on:blur="myBlurFun()">
                    <p>Estimated Payoff Date</p>
                    <h4 class="date_est">{{ date_selected }} {{ estPayOffDate }}</h4>

            </div>

            <table>

                <thead>

                    <tr>

                        <th v-for="key in gridColumns"
                               :key="key">
                            
                            {{ key | capitalize }}

                        </th>

                    </tr>

                </thead>
                <tbody>
                    
                    <tr v-for="(entry, i) in gridData" :key="i">

                        <td v-for="(key, j) in gridColumns" :key="j">

                            {{ entry[key] }}

                        </td>

                    </tr>

                </tbody>

            </table>


        </div>

	</div>
</template>

<script>
	export default {
    props: [
        'tableTitle', 
        'mortgageCalcLabel',
        'mortgageCalcDef',
        'amortizationTable'
    ],
    data() {
        return {
            loanAmount: 0,
            downPament: 0,
            downPamentPerc: 0,
            mortgageTerm: 0,
            mortgageTermMonth: 0,
            annualInterestRate: 0,
            monthlyPayment: 0,
            principalPaid: 0,
            annualInterestRateUpd: 0,
            newValue: 0,
            date: "",
            showAmortBtn: true,
            showTable: true,
            gridColumns: [
                'PaymentDate', 'payment', 'principal', 'interest', 'totalInterest', 'balance'
            ],
            gridData: [],
            months: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ],
            month: 0,
            date_selected: 0,
            year_selected: 0,
            estPayOffDate: '',
            acceptedValue: '',
            acceptedTerm: '',
            acceptedTermMonth: '',
            acceptAnnInterestRate: ''
        }
    },
    created() {
        console.log("My Component " + this.mortgageCalcLabel);
        //this.showAmort = this.amortizationTable;
        this.loanAmount = this.mortgageCalcDef.loanAmountDefVal;
        this.downPament = this.mortgageCalcDef.downPamentDefVal;
        this.mortgageTerm = this.mortgageCalcDef.mortgageTermDefVal;
        this.annualInterestRate = this.mortgageCalcDef.annualInterestRateDefVal;
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() +  1;
        var year = today.getFullYear();
        this.month = mm;
        this.year_selected = year;
        if( dd < 10 ) {
            dd = '0' + dd;
        }
        this.date_selected= dd;
        if( mm < 10 ) {
            mm = '0' + mm;
        }
        today = dd + '/' + mm + "/" + year;
        console.log(today)
        this.date = today;
        // Generating Amortization Schedule
        var ann_int_rate = ( this.annualInterestRate / 12);
        ann_int_rate /= 100;
        var principalPaid = this.downPament;
        var loanAmount = this.loanAmount - this.downPament;
        this.principalPaid = loanAmount;
        this.monthlyPayment = parseFloat( ( ( loanAmount * ann_int_rate ) / ( 1 - ( 1 / Math.pow( ( 1 + ann_int_rate ), this.mortgageTermMonth ) ) ) ) );
        this.acceptedValue = 10000000;
        this.acceptedTerm = 40;
        this.acceptedTermMonth = 480;
        this.acceptAnnInterestRate = 90;
    },
    computed: {
        total_interest() {
            if( this.monthlyPayment != 0 && this.mortgageTermMonth != 0 && this.principalPaid != 0 ) {
                console.log( "Monthly Payment " + this.monthlyPayment );
                console.log( " Mortgage Term Month " + this.mortgageTermMonth );
                console.log( " Principal Paid " + this.principalPaid );
                var total_interest = parseFloat( ( this.monthlyPayment * this.mortgageTermMonth ) - this.principalPaid );
                return total_interest;
            } else {
                return 0;
            }
        },
        rules() {
            if( !this.acceptedValue ) {
                return 'required';
            }
            return `required|max_value:${this.acceptedValue}`;
        },
        term_rule() {
            if( !this.acceptedTerm ) {
                return 'required';
            }
            return `required|max_value:${this.acceptedTerm}`;
        },
        term_rule_month() {
            if( !this.acceptedTermMonth ) {
                return 'required';
            }
            return `required|max_value:${this.acceptedTermMonth}`;
        },
        annual_int_rate_term() {
            if( !this.acceptAnnInterestRate ) {
                return 'required';
            }
            return `required|max_value:${this.acceptAnnInterestRate}`;
        }
    },
    
    watch: {
        loanAmount: function() {
            this.showTable = false;
            
            if( this.principalPaid <= 0 ) {
                this.principalPaid = this.loanAmount;
            
            }
            
            if( this.principalPaid != 0 ) {
                
                this.principalPaid = parseFloat( this.loanAmount - this.downPament );
            
            }
            if( this.annualInterestRate != 0 ) {
                this.annualInterestRateUpd = parseFloat(( this.annualInterestRate / 12 ) / 100);
            
            }
            if( this.mortgageTerm != 0 ) {
                this.mortgageTermMonth = parseFloat( this.mortgageTerm ) * 12;
            
            }
            if( this.annualInterestRateUpd != 0 && this.mortgageTermMonth != 0 && this.principalPaid != 0 ) {
                
                this.monthlyPayment = parseFloat( ( ( this.principalPaid * this.annualInterestRateUpd ) / ( 1 - ( 1 / Math.pow( ( 1 + this.annualInterestRateUpd ), this.mortgageTermMonth ) ) ) ) );
            
            }
            if( this.loanAmount == 0 || this.loanAmount == '') {
                this.monthlyPayment = 0;
                this.principalPaid = 0;
            }
        },
        downPament() {
            this.showTable = false;
            if( this.principalPaid == 0 ) {
                
                this.principalPaid = this.loanAmount;
            
            }
            if( this.loanAmount != 0 ) {
                this.principalPaid = parseFloat( this.loanAmount - this.downPament );
            
            }
            if( this.annualInterestRate != 0 ) {
                this.annualInterestRateUpd = parseFloat(( this.annualInterestRate / 12 ) / 100);
            
            }
            if( this.mortgageTerm != 0 ) {
                this.mortgageTermMonth = parseFloat( this.mortgageTerm ) * 12;
            
            }
            if( this.annualInterestRateUpd != 0 && this.mortgageTermMonth != 0 && this.loanAmount != 0 && this.principalPaid != 0 ) {
                this.monthlyPayment =  parseFloat( ( ( this.principalPaid * this.annualInterestRateUpd ) / ( 1 - ( 1 / Math.pow( ( 1 + this.annualInterestRateUpd ), this.mortgageTermMonth ) ) ) ) );
            
            }
        },
        mortgageTerm() {
            this.showTable = false;
            if( this.mortgageTerm != 0 ) {
                this.mortgageTermMonth = parseFloat( this.mortgageTerm ) * 12;
            
            }
            if( this.loanAmount != 0 ) {
                this.principalPaid = parseFloat( this.loanAmount - this.downPament );
            }
            
            if( this.annualInterestRate != 0 ) {
                this.annualInterestRateUpd = parseFloat(( this.annualInterestRate / 12 ) / 100);
            
            }
            if( this.loanAmount == 0 && this.annualInterestRateUpd == 0 ) {
                this.monthlyPayment = 0;
            
            }
            if( this.loanAmount != 0 && this.annualInterestRateUpd != 0 && this.principalPaid > 0 ) {
                this.monthlyPayment = parseFloat( ( this.principalPaid * this.annualInterestRateUpd ) / ( 1 - ( 1 / Math.pow( ( 1 + this.annualInterestRateUpd ), this.mortgageTermMonth ) ) ) );
            
            }
            if( this.mortgageTerm == 0 || this.mortgageTerm == '' ) {
                this.monthlyPayment = 0;
                this.principalPaid = 0;
            }
            
            else {
                this.monthlyPayment =  parseFloat( ( ( this.principalPaid * this.annualInterestRateUpd ) / ( 1 - ( 1 / Math.pow( ( 1 + this.annualInterestRateUpd ), this.mortgageTermMonth ) ) ) ) );
            
            }
        },
        mortgageTermMonth() {
            this.showTable = false;
            if( this.mortgageTermMonth != 0 ) {
                this.mortgageTerm = this.mortgageTermMonth / 12;
            }
            if( this.mortgageTermMonth == '' ) {
                this.mortgageTerm = 0;
            }
        },
        annualInterestRate() {
            this.showTable = false;
            
            this.annualInterestRateUpd = parseFloat(( this.annualInterestRate / 12 ) / 100); 
            if( this.principalPaid == 0 ) {
                this.principalPaid = this.loanAmount;
            }

            if( this.loanAmount != 0 ) {
                this.principalPaid = parseFloat( this.loanAmount - this.downPament );
            }
            
            if( this.annualInterestRate == 0 || this.annualInterestRate == '' ) {
                this.monthlyPayment = 0;
                this.principalPaid = 0;
            }       
            if( this.loanAmount != 0 && this.annualInterestRateUpd != 0 && this.mortgageTerm != 0 && this.principalPaid != 0) {
                this.monthlyPayment = parseFloat( ( this.principalPaid * this.annualInterestRateUpd ) / ( 1 - ( 1 / Math.pow( ( 1 + this.annualInterestRateUpd ), this.mortgageTermMonth ) ) ) ); 
            
            }
        },
        // downPamentPerc() {
        //     if( this.loanAmount != 0 ) {
        //         if(this.downPamentPerc == '' ) {
        //             this.downPamentPerc = 0;
        //         }
        //         let res = ( this.loanAmount / 100 );
        //         this.newValue = res * this.downPamentPerc;
        //         console.log(this.newValue);
        //         this.downPament = this.newValue;
                
        //     }
        // }
    },
    filters: {
        capitalize: function (str) {
            
            return str.charAt(0).toUpperCase() + str.slice(1)
        
        }
    },
    methods: {
        paymentSchedule() {
            this.showTable= true;
            this.showAmortBtn = false;
            var p;
            var i = 0;

            while( i <= this.monthlyPayment ) {

                var root_year = this.year_selected;

                this.gridData.push({
                    PaymentDate: '',
                    payment: 0,
                    principal: 0,
                    interest: 0,
                    totalInterest: 0,
                    balance: 0
                });

                p = this.principalPaid;
                var ann_int = this.annualInterestRate;
                var total_interest = 0;
                var monthIndex = this.month;

                this.gridData.forEach(element => {
                    
                    if( this.months[monthIndex] == 'Jan' || monthIndex == 12) {
                        
                        if( monthIndex == 12 ){
                            monthIndex = 0
                        }
                        
                        element.PaymentDate = this.months[monthIndex] + ' ' + ((root_year + 1).toString());
                        
                        root_year = root_year + 1;
                    } else {
                        element.PaymentDate = this.months[monthIndex]+ ' ' + ((root_year).toString());
                    }
                    
                    element.payment = (this.monthlyPayment).toFixed(3);
                    var interest = parseFloat( ( p * (  ann_int / 100 ) ) / 12 );
                    element.interest = interest.toFixed(2);
                    total_interest = (parseFloat(interest) + parseFloat(total_interest));
                    element.totalInterest = total_interest.toFixed(2);
                    element.principal = ( this.monthlyPayment - element.interest ).toFixed(2);
                    var principal_upd = ( this.monthlyPayment - element.interest );

                    if(  p - principal_upd < 1  ) {
                        var balance_final = 0;
                        element.balance = balance_final.toFixed(2);
                        this.estPayOffDate = element.PaymentDate;
                    
                    } 
                    else {
                        element.balance = ( p - principal_upd ).toFixed(2); 
                    
                    }
                    
                    var balance_upd = ( p - principal_upd );
                    p = balance_upd;
                    monthIndex+=1;

                    if(monthIndex == 12) {
                        monthIndex = 0;
                    }
                });

                if( p < 1 ) {
                    break;
                }

                i = this.monthlyPayment - p;
            
            }
        },
        hidePaymentSchedule() {
            this.showTable = false;
            this.showAmortBtn = true;
            this.gridData.length = 0;
        },
        myBlurFun() {
            var str = this.date;
            var month = str.substring(3, 5);
            var date = str.substring(0, 2);
            this.date_selected = date;
            this.month = parseInt(month);
            this.gridData = [];
            this.paymentSchedule();
        }
    }
}
</script>

<style scoped>
	input[type=text] {
	    width: 100%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
    	box-sizing: border-box;
	}
	
	.typeNumber {
		width: 100%;
		padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
    	box-sizing: border-box;
	}

	.typeNumbers {
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

	.error {
	    border-color: red;
	    box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 5px rgba(232,68,68,.6);
	}

    .paymentBtn {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .hidePaymentBtn {
        background-color: #f44336;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    table {
      border: 2px solid #42b983;
      border-radius: 3px;
      background-color: #fff;
      width: 100%;
    }

    th {
      background-color: #4CAF50;
      color: rgba(255,255,255,0.66);
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    td {
      background-color: #f9f9f9;
    }

    th, td {
      padding: 10px 18px;
    }

    th.active {
      color: #fff;
    }

    th.active .arrow {
      opacity: 1;
    }

    tr {
        text-align: center;
    }

    .date_est {
        padding: 0;
        margin-top: -17px;
    }
</style>