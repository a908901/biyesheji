<template>
    <div class="table">
        <el-table :data="users" border style="width: 100%"  highlight-current-row >
            <el-table-column prop="ldate" label="日期"  width="150">
            </el-table-column>
            <el-table-column prop="number" label="编号" width="120">
            </el-table-column>
            <el-table-column prop="username" label="领用人" >
            </el-table-column>
            <el-table-column prop="tag" label="标签" width="120"
                             :filters="[{ text: '通过', value: '通过' }, { text: '未通过', value: '未通过' }]"
                             :filter-method="filterTag">
                <template scope="scope">
                    <el-tag :type="scope.row.tag === '通过' ? 'primary' : 'success'" close-transition>{{scope.row.tag}}
                    </el-tag>
                </template>
            </el-table-column>
            <el-table-column label="操作" width="180" v-if="bianji === '符合身份' ">
                <template scope="scope" >
                    <el-button size="small"
                               @click="handleEdit(scope.$index, scope.row)">审核</el-button>
                    <el-button size="small" type="danger"
                               @click="handleDel(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
            <el-table-column label="操作" width="180"  v-else>
                <template scope="scope">
                    <el-button size="small"
                               @click="detailsEdit(scope.$index, scope.row)">详情</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="pagination">
            <el-pagination
                layout="prev, pager, next"
                @current-change="handleCurrentChange"
                :total="1000">
            </el-pagination>
        </div>

        <!--编辑界面-->
        <el-dialog title="审核" v-model="editFormVisible" :close-on-click-modal="false">
            <el-form  :model="editForm" label-width="80px"  :rules="editFormRules" ref="editForm">
                <el-form-item label="领用日期" prop="ldate">
                    <el-input v-model="editForm.ldate" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="编号" prop="number">
                    <el-input v-model="editForm.number" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="领用人" prop="name">
                    <el-input v-model="editForm.name" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="是否通过" prop="tag">
                    <el-input v-model="editForm.tag" auto-complete="off"></el-input>
                </el-form-item>

                <el-form-item label="详细说明">
                    <el-input v-model="editForm.detailed" type="textarea" ></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer"  scope="scope">
                <el-button @click.native="editFormVisible = false">取消</el-button>
                <el-button @click.native="editSubmit" type="primary">审核通过</el-button>
            </div>
        </el-dialog>

        <!--详情界面-->
        <el-dialog title="编辑" v-model="detailsFormVisible" :close-on-click-modal="false">
            <el-form  :model="editForm" label-width="80px"  :rules="editFormRules" ref="editForm">
                <el-form-item label="领用日期" prop="ldate">
                    <el-input v-model="editForm.ldate" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="编号" prop="number">
                    <el-input v-model="editForm.number" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="领用人" prop="name">
                    <el-input v-model="editForm.name" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="是否归还" prop="tag">
                    <el-input v-model="editForm.tag" auto-complete="off"></el-input>
                </el-form-item>

                <el-form-item label="详细说明">
                    <el-input v-model="editForm.detailed" type="textarea" ></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer"  scope="scope">
                <el-button @click.native="detailsFormVisible = false">取消</el-button>
            </div>
        </el-dialog>



    </div>
</template>

<script type="text/jsx">
    import util from '../../common/js/util'
    import { getUserListPage, removeUser, batchRemoveUser, editUser, addUser } from '../../api/api.js';
    import { XHRGet, XHRPost } from "../../api/ajax";
    export default {
        data() {
            return {
                bianji:"",
                users: "",
                //编辑界面数据
                editForm: {
                    id:1,
                    ldate: '',
                    number: '',
                    name: -1,
                    tag: 0,
                    detaialed: ''
                },
                editFormRules: {
                    name: [
                        { required: true, message: '请输入姓名', trigger: 'blur' }
                    ]
                },
                pageNum: 1,
                total: 0,
                editFormVisible: false,//编辑界面是否显示
                detailsFormVisible:false //详情界面
            }
        },
        mounted: function () {
            const _this = this;
            let data = this.pageNum;
            console.log(data);
            XHRGet('./username.php',{username:localStorage.getItem('ms_username')} , function (res) {
                _this.bianji = res.data;
                console.log(_this.bianji)

            });
            XHRGet('./Markdown.php',{pageNum:data} , function (response) {
                _this.users = response.data.data;
                _this.total = response.data.pageCount;
                console.log(response.data.data.lid)
            });

        },

        methods: {
            //分页设计
            handleCurrentChange(val) {
                this.pageNum = val;
                this.getUsers();
            },
            //获取用户列表
            getUsers() {
                let para = this.pageNum;
                const _this= this;
                XHRGet('./Markdown.php',{pageNum:para}, function (response) {
                    _this.total = response.data.pageCount;
                    _this.users = response.data.data;
                })
            },

            formatter(row, column) {
                return row.address;
            },
            filterTag(value, row) {
                return row.tag === value;
            },

            handleDel: function (index, row) {
                this.editForm = Object.assign({}, row);
                const _this= this;
                this.$confirm('确认删除该记录吗?', '提示', {
                    type: 'warning'
                }).then(() => {
                    let para = { id: row.id };
                    this.users.splice(para,1);//删掉表的某一行
                    let data01 = Object.assign({}, this.editForm);
                    XHRGet('./markp.php',data01, function (response) {
                        console.log(response);
                        _this.editFormVisible = false;
                        history.go(0);
                    })

                }).catch(() => {

                });
            },

            //显示编辑页面
            handleEdit: function (index,row) {
                this.editFormVisible = true;
                this.editForm = Object.assign({}, row);
            },

            //显示详情页面
            detailsEdit: function (index,row) {
                this.detailsFormVisible = true;
                this.editForm = Object.assign({}, row);
            },
            goshuju(){
                const _this = this;
                let data = this.pageNum;
                console.log(data);
                XHRGet('./Markdown.php',{pageNum:data} , function (response) {
                    _this.users = response.data.data;
                    _this.total = response.data.pageCount;
                    console.log(response.data.data.lid)
                });
            },
            //审核
            editSubmit: function () {
                this.$refs.editForm.validate((valid) => {
                    if (valid) {
                        const _this= this;
                        this.$confirm('通过审核吗？', '提示', {}).then((row) => {
                            //
                            let para = Object.assign({}, this.editForm);
                            console.log(para)

                            XHRGet('./markD.php',para, function (response) {
                                console.log(response);
                                _this.editFormVisible = false;
                                let data = _this.pageNum;
                               const myself = _this;
                                XHRGet('./Markdown.php',{pageNum:data} , function (response) {
                                    myself.users = response.data.data;
                                    myself.total = response.data.pageCount;

                                });

                            })

                            //

                        });
                    }
                });
            }

        }

    }
</script>
