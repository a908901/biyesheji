<template>
    <div class="table">
        <el-table :data="tableData" border style="width: 100%"  highlight-current-row>
            <el-table-column prop="kdate" label="日期" sortable width="150">
            </el-table-column>

            <el-table-column prop="region" label="款项来源" >
            </el-table-column>

            <el-table-column label="操作" width="120">
                <template scope="scope">
                    <el-button size="small"
                               @click="handleDetail(scope.$index, scope.row)">详情</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="pagination">
            <el-pagination
                layout="prev, pager, next"
                @current-change="handleCurrentChange"
                :page-size="10"
                :total="1000">
            </el-pagination>
        </div>

        <!--详情界面-->
        <el-dialog title="详情" v-model="detailFormVisible" :close-on-click-modal="false">
            <el-form  :model="detailForm" label-width="80px"   ref="detailForm">
                <el-form-item label="编号" prop="number">
                    <el-input v-model="detailForm.number" auto-complete="off" readonly="readonly"></el-input>
                </el-form-item>
                <el-form-item label="来源" prop="region">
                    <el-input v-model="detailForm.region" auto-complete="off" readonly="readonly"></el-input>
                </el-form-item>
                <el-form-item label="时间" prop="kdate">
                    <el-input v-model="detailForm.kdate" auto-complete="off" readonly="readonly"></el-input>
                </el-form-item>
                <el-form-item label="数额" prop="resource">
                    <el-input v-model="detailForm.resource" auto-complete="off" readonly="readonly"></el-input>
                </el-form-item>
                <el-form-item label="详细说明">
                    <el-input v-model="detailForm.adesc" type="textarea" readonly="readonly"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer"  scope="scope">
                <el-button @click.native="detailFormVisible = false">取消</el-button>
                <!--<el-button @click.native="editSubmit(scope.row)" type="primary">提交</el-button>-->
            </div>
        </el-dialog>
    </div>
</template>
<style>
    input[readonly="readonly"]:focus{
        border:1px solid #bfcbd9;/*这里你可以自己调节边框样式*/
    }
</style>

<script type="text/jsx">
    import { XHRGet, XHRPost } from "../../api/ajax";
    export default {
        data() {
            return {
                tableData:"",
                //详情界面数据
                detailForm: {
                    number: '',
                    region: "",
                    kdate:"",
                    resource: "",//方式
                    adesc: ''
                },
                total: 5,
                pageNum: 1,
                detailFormVisible: false,
            }
        },
        mounted: function () {
            const _this = this;
            let data = this.pageNum;
            console.log(data);
            XHRGet('./Upload.php',{pageNum:data}, function (response) {
                _this.tableData = response.data.data;
                _this.total = response.data.pageCount;
                console.log(_this.tableData);
                console.log(_this.tableData.tdate);
                console.log(_this.total);
            })

        },
        methods: {
            formatter(row, column) {
                return row.address;
            },
            filterTag(value, row) {
                return row.tag === value;
            },

            //显示详情页面
            handleDetail: function (index, row) {
                this.detailFormVisible = true;
                this.detailForm = Object.assign({}, row);
                console.log(row)
            },
            //分页设计
            handleCurrentChange(val) {
                this.pageNum = val;
                this.getUsers();
            },
            //获取用户列表
            getUsers() {
                let para = this.pageNum;
                const _this= this;
                XHRGet('./Upload.php',{pageNum:para}, function (response) {
                    _this.total = response.data.pageCount;
                    _this.tableData = response.data.data;

                })
            }

        }
    }
</script>
