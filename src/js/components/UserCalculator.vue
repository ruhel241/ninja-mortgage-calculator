<template>
    <div>
        <div v-if="table_id && calculator_type=='mortgage_calculator'">
            <app-mortgage-calc :tableTitle="table_title" 
                               :mortgageCalcLabel="mortgage_calculator_label" 
                               :mortgageCalcDef="mortgage_calculator_default"/>
        </div>
        <div v-if="table_id && calculator_type=='mortgage_refinance'">
            <app-mortgage-refinance :tableTitle="table_title"
                                    :mortgageRefinanceLabel="mortgage_refinance_label"
                                    :mortgageRefinanceDef="mortgage_refinance_default"/>
        </div>
        <div v-if="table_id && calculator_type=='mortgage_payment'">
            <app-mortgage-payment />
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
                mortgage_refinance_default: {}
            }
        },
        components: {
            'app-mortgage-calc': MortgageCalculator,
            'app-mortgage-refinance': MortgageRefinance,
            'app-mortgage-payment': MortgagePayment
        },
        created() {
            console.log(window.ninja_mortgage_cal_vars)
            var res = window.ninja_mortgage_cal_vars.post;
            this.calculator_type = res.post_content;
            console.log(this.calculator_type);
            this.table_id = res.ID;
            console.log(this.table_id);
            this.table_title = res.post_title;
            console.log(this.table_title);
            if( this.calculator_type === 'mortgage_calculator' ) {
                this.mortgage_calculator_label = window.ninja_mortgage_cal_vars.settings.selectedLabel;
                console.log(this.mortgage_calculator_label);
                this.mortgage_calculator_default = window.ninja_mortgage_cal_vars.settings.selectedDefault;
                console.log(this.mortgage_calculator_default);
            }
            else if( this.calculator_type === 'mortgage_refinance' ) {
                this.mortgage_refinance_label = window.ninja_mortgage_cal_vars.settings.selectedLabel;
                console.log(this.mortgage_refinance_label);
                this.mortgage_refinance_default = window.ninja_mortgage_cal_vars.settings.selectedDefault;
                console.log(this.mortgage_refinance_default);
            }
        }   
    }
</script>