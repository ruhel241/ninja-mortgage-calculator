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
                prop="ID"
                label="ID"
                width="60">
            </el-table-column>

            <el-table-column label="Name">
                <template slot-scope="scope">
                    {{ scope.row.post_title }}
                </template>
            </el-table-column>

            <el-table-column 
                label="ShortCode">
                <template slot-scope="scope">
                    <code>[ninja_mortgage_cal id="{{ scope.row.ID }}"]</code>
                </template>
            </el-table-column>

            <el-table-column  label="Actions" width="190">
                <template slot-scope="scope">
                    <i class="el-icon-edit"></i>
                    <a :href="scope.row.demo_url"  target="_blank" class="el-button el-button--info el-button--mini">
                        <i class="el-icon-view"></i>
                    </a>
                </template>
            </el-table-column>


        </el-table>

        <!-- Dialog -->
        <el-dialog
            title="Add New Mortgage Table"
            :visible.sync="addTableModal"
            width="60%">
                <label for="new_table_name">Table Name</label>
                <el-input id="new_table_name" type="text" placeholder="Your Table Name" v-model="table_name"></el-input>
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
            table_name: '',
            per_page: 10,
            page_number: 1
        }
    },
    methods: {

        addNewTable() {

            jQuery.post(ajaxurl, {
                action: 'ninja_mortgage_ajax_actions',
                route: 'add_table',
                post_title: this.table_name
            }).then(
                response => {
                    this.$notify.success({
                        title: 'Success',
                        message: response.data.message
                    });
                  
                }
            ).fail(
                
                error => {
                    this.$notify.error({
                        title: 'Error',
                        message: error.responseJSON.data.message
                    });
                }


            ).always(
                () => {
                    this.addTableModal = false;
                }
            )
           

        },
        fetchTables() {
                this.doingAjax = true;
                jQuery.get(ajaxurl, {
                    action: 'ninja_mortgage_ajax_actions',
                    route: 'get_tables',
                    per_page: this.per_page,
                    page_number: this.page_number
                })
                    .then(response => {
                        this.tableData = response.data.tables;
                        console.log(response)
                    })
                    .fail(error => {
                         console.log(error);
                    })
            }

    },
    created() {
        this.fetchTables();
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
