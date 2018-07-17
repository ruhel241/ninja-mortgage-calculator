<template>
    <div>
        <div v-if="table_id && calculator_type=='mortgage_calculator'">
            <app-mortgage-calc :tableTitle="table_title" 
                               :mortgageCalcLabel="mortgage_calculator_label" 
                               :mortgageCalcDef="mortgage_calculator_default"
                               :amortizationTable="amortization_table" />
        </div>
        <div v-if="table_id && calculator_type=='mortgage_refinance'">
            <app-mortgage-refinance :tableTitle="table_title"
                                    :mortgageRefinanceLabel="mortgage_refinance_label"
                                    :mortgageRefinanceDef="mortgage_refinance_default" />
        </div>
        <div v-if="table_id && calculator_type=='mortgage_payment'">
            <app-mortgage-payment :tableTitle="table_title"
                                  :mortgagePaymentLabel="mortgage_payment_label"
                                  :mortgagePaymentDefault="mortgage_payment_default" />
        </div>
    </div>
</template>

<script>
    import MortgageCalculator from './_MortgageCalculator.vue'
    import MortgageRefinance from './_MortgageRefinance.vue'
    import MortgagePayment from './_MortgagePayment.vue'

    export default {
        name: 'user_calculator',
        data() {
            return {
                calculator_type: '',
                table_id: 0,
                table_title: '',
                mortgage_calculator_label: {},
                mortgage_calculator_default: {},
                mortgage_refinance_label: {},
                mortgage_refinance_default: {},
                mortgage_payment_label: {},
                mortgage_payment_default: {},
                amortization_table: true
            }
        },
        components: {
            'app-mortgage-calc': MortgageCalculator,
            'app-mortgage-refinance': MortgageRefinance,
            'app-mortgage-payment': MortgagePayment
        },
        created() {
            console.log(window.ninja_mortgage_cal_vars);
            var res = window.ninja_mortgage_cal_vars.mortgageMetaData;
            var post = window.ninja_mortgage_cal_vars.post;
            this.calculator_type = post.post_content;
            this.table_id = post.ID;
            this.table_title = post.post_title;


            if( this.calculator_type === 'mortgage_calculator' ) {
                console.log("All Mortgage Calculator" + content.all_mort_calc_table)
                this.mortgage_calculator_label = res.selectedLabel;
                this.mortgage_calculator_default = res.selectedDefault;
                this.amortization_table = res.settings;
                console.log("Amortization Table is " + this.amortization_table);
            }
            // this.calculator_type = res.post_content;
            // this.table_id = res.ID;
            // var res = window.ninja_mortgage_cal_vars.post;
            // this.table_title = res.post_title;
            // this.calculator_type = res.post_content;
            // this.table_id = res.ID;
            // var content = window.ninja_mortgage_cal_vars.settings;
            // console.log(content);

            // if( this.calculator_type === 'mortgage_calculator' ) {
            //     console.log("All Mortgage Calculator" + content.all_mort_calc_table)
            //     this.mortgage_calculator_label = content.all_mort_calc_table;
            //     this.mortgage_calculator_default = content.all_mort_calc_table_def_val;
            //     this.amortization_table = content.all_mort_calc_table.amortizationTable;
            //     console.log("Amortization Table is " + this.amortization_table);
            // }
            // else if( this.calculator_type === 'mortgage_refinance' ) {
            //     alert("Mortgage Refinance")
            // }
            /*
            var res = window.ninja_mortgage_cal_vars.post;
            console.log(res);
            this.calculator_type = res.post_content;
            this.table_id = res.ID;
            this.table_title = res.post_title;

            jQuery.get(ajaxurl, {
                    action: 'ninja_mortgage_ajax_actions',
                    route: 'get_table',
                    table_id: this.table_id
                }).then(
                    (response) => {
                        console.log(response)
            })

            
            if( this.calculator_type === 'mortgage_calculator' ) {
                this.mortgage_calculator_label = window.ninja_mortgage_cal_vars.settings.selectedLabel;
                this.mortgage_calculator_default = window.ninja_mortgage_cal_vars.settings.selectedDefault;
                this.amortization_table = window.ninja_mortgage_cal_vars.settings.settings;
            }
            else if( this.calculator_type === 'mortgage_refinance' ) {
                this.mortgage_refinance_label = window.ninja_mortgage_cal_vars.settings.selectedLabel;
                this.mortgage_refinance_default = window.ninja_mortgage_cal_vars.settings.selectedDefault;
                
            }
            else if( this.calculator_type === 'mortgage_payment' ) {
                this.mortgage_payment_label = window.ninja_mortgage_cal_vars.settings.selectedLabel;
                this.mortgage_payment_default = window.ninja_mortgage_cal_vars.settings.selectedDefault;
            }*/
        }   
    }
</script>