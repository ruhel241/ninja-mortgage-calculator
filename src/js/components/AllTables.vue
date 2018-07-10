<template>
    <div class="editor">
        <div class="editor_header">
            <div class="section_header">
                <h1>All Mortgage Tables</h1>
            </div>
            <div class="section_action">
                <el-button size="mini" type="primary" @click="addTableModal = true">Add Table</el-button>
            </div>
        </div>
    
        <hr>


        <el-table :data="tableData"
                  style="width: 100%; margin-top: 10px;">
            
            <el-table-column 
                prop="id"
                label="ID"
                width="60">
            </el-table-column>

            <el-table-column label="Name">
                <template slot-scope="scope">
                    {{ scope.row.name }}
                </template>
            </el-table-column>

            <el-table-column 
                label="ShortCode">
                <template slot-scope="scope">
                    {{ scope.row.shortCode }}
                </template>
            </el-table-column>

            <el-table-column  label="Actions" width="190">
                <template slot-scope="scope">
                    <i class="el-icon-edit"></i>
                    <a href=""  target="_blank" class="el-button el-button--info el-button--mini">
                        <i class="el-icon-view"></i>
                    </a>
                </template>
            </el-table-column>


        </el-table>

        <!-- Dialog -->
        <el-dialog
            title="Add New Pricing Table"
            :visible.sync="addTableModal"
            width="60%">
                <label for="new_table_name">Table Name</label>
                <el-input id="new_table_name" type="text" placeholder="Your Table Name" v-model="table_name"></el-input>

                <el-select v-model="selected_table_type" placeholder="Select Calculator Type" class="select_calc_type">
                    
                    <el-option
                        v-for="(item, i) in table_type"
                        :key="i"
                        :label="item.label"
                        :value="item.value">
                    </el-option>
                
                </el-select>

                <span slot="footer" class="dialog-footer">

                    <el-button @click="addTableModal = false">Cancel</el-button>
                    <el-button type="primary" @click="addNewTable">Add New</el-button>

                </span>
            </el-dialog>
    </div>
</template>

<script>
export default {
    name: 'all_mortgage_tables',
    data() {
        return {
            addTableModal: false,
            table_type: [
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
            tableData: [],
            selected_table_type: '',
            table_name: ''
        }
    },
    methods: {

        addNewTable() {

            this.tableData.push({
                id: '20',
                name: this.table_name,
                shortCode: '[wp_price_table id="1070"]'
            });

            this.$notify({
                title: 'Success',
                message: 'This is a success message',
                type: 'success'
            });

            this.table_name = '';

            this.addTableModal = false;

        }

    }
}
</script>


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #F1F1F1;
    }

    /* .section_header {
        float: left;
    } */

    .section_action {
        float: right;
        margin-top: -32px;
    }

    .select_calc_type {
        margin-top: 10px;
    }

    .editor {
        width: 100%;
        float: right;
    }

    hr {
        color: #DDDDDD;
    }
</style>
