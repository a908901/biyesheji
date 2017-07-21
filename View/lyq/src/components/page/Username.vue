<template>
    <div class="table">
        <el-table :data="users" border style="width: 100%"  highlight-current-row >
            <el-table-column prop="uid" label="编号"  width="150">
            </el-table-column>
            <el-table-column prop="uname" label="姓名" width="120">
            </el-table-column>
            <el-table-column prop="upwd" label="密码" >
            </el-table-column>
            <el-table-column prop="role" label="职务" >
            </el-table-column>
            <el-table-column prop="email" label="邮箱" >
            </el-table-column>
            <el-table-column prop="tel" label="电话" >
            </el-table-column>
            <el-table-column label="操作" width="180">
                <template scope="scope" >
                    <el-button size="small"
                               @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button size="small" type="danger"
                               @click="handleDel(scope.$index, scope.row)">删除</el-button>
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
        <el-dialog title="修改" v-model="editFormVisible" :close-on-click-modal="false">
            <el-form  :model="editForm" label-width="80px"  :rules="editFormRules" ref="editForm">
                <el-form-item label="编号" prop="uid">
                    <el-input v-model="editForm.uid" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="姓名" prop="uname">
                    <el-input v-model="editForm.uname" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="upwd">
                    <el-input v-model="editForm.upwd" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="职务" prop="role">
                    <el-input v-model="editForm.role" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="邮箱" prop="email">
                    <el-input v-model="editForm.email" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="电话" prop="tel">
                    <el-input v-model="editForm.tel" auto-complete="off" ></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer" >
                <el-button @click.native="editFormVisible = false">取消</el-button>
                <el-button @click.native="editSubmit()" type="primary">确认</el-button>
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
                users: "",
                //编辑界面数据
                editForm: {
                    id:'',
                   uname: '',
                   pwd: '',
                   role: '',
                    email: '',
                    tel: ''
                },
                editFormRules: {
                    name: [
                        { required: true, message: '请输入姓名', trigger: 'blur' }
                    ]
                },
                pageNum: 1,
                total: 0,
                editFormVisible: false,//编辑界面是否显示
            }
        },
        mounted: function () {
            const _this = this;
            let data = this.pageNum;
            console.log(data);
            XHRGet('./uname.php',{pageNum:data} , function (response) {
                _this.users = response.data.data;
                _this.total = response.data.pageCount;
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
                    XHRGet('./unameP.php',data01, function (response) {
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

            //审核
            editSubmit: function () {
                this.$refs.editForm.validate((valid) => {
                    if (valid) {
                        const _this= this;
                        this.$confirm('通过审核吗？', '提示', {}).then((row) => {
                            //
                            let para = Object.assign({}, this.editForm);
                            console.log(para)

                            XHRGet('./unameD.php',para, function (response) {
                                console.log(response);
                                _this.editFormVisible = false;

                            })

                            //

                        });
                    }
                });
            },

        }

    }
</script>
