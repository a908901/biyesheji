<template>
    <div class="ms-login">
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="0px" class="demo-ruleForm">
            <el-form-item prop="username">
                <label style="width:60px;display: inline-block;">名字</label>
                <el-input v-model="ruleForm.username" placeholder="请输入用户名"  style="width:192px;"></el-input>
            </el-form-item>
            <el-form-item prop="password">
                <label  style="width:60px;display: inline-block;">密码</label>
                <el-input type="password" placeholder="请输入密码" v-model="ruleForm.password" style="width:192px;" @></el-input>
            </el-form-item>
            <el-form-item prop="password01">
                <label  style="width:60px;display: inline-block;">确认密码</label>
                <el-input type="password01" placeholder="请再次确认密码" v-model="ruleForm.password01" style="width:192px;" ></el-input>
            </el-form-item>
            <el-form-item prop="email">
                <label style="width:60px;display: inline-block;" >邮箱</label>
                <el-input type="email" placeholder="请邮箱" v-model="ruleForm.email" style="width:192px;"></el-input>
            </el-form-item>
            <el-form-item prop="tel">
                <label  style="width:60pxdisplay: inline-block;;">手机号</label>
                <el-input type="tel" placeholder="请输入手机号码" v-model="ruleForm.tel" style="width:192px;"></el-input>
            </el-form-item>

            <div class="login-btn">
                <el-button type="primary" @click="submitForm('ruleForm')">添加</el-button>
            </div>
            <!--<p style="font-size:12px;line-height:30px;color:#999;">Tips : 用户名和密码随便填。</p>-->
        </el-form>
    </div>
</template>

<script>
    import { XHRGet, XHRPost } from "../../api/ajax";
    export default {
        data: function(){
            return {
                ruleForm: {
                    username: '',
                    password: '',
                    password01: '',
                    tel:'',
                    email:'',
                    role:'员工'
                }
            }
        },

        methods: {
            submitForm(formName) {
        const self = this;
        let data = this.ruleForm;

        XHRGet('./regin.php',data, function (response) {
            self.$message({
                message: '删除成功',
                type: 'success'
            });

        })

    }
    }
    }
</script>

<style>
    /*头部样式*/


    .rlt{
        position: relative;
    }
    .abs{
        position: absolute;
    }
    .font30{
        font-size:30px;
    }
    /**/
    .login-wrap{
        position: relative;
        width:100%;
        height:100%;
    }
    .ms-title{
        position: absolute;
        top:50%;
        width:100%;
        margin-top: -230px;
        text-align: center;
        font-size:30px;
        color: #fff;

    }
    .ms-login01{
        position: absolute;
        left:50%;
        top:50%;
        width:300px;
        height:300px;
        margin:-150px 0 0 -190px;
        padding:40px;
        border-radius: 5px;
        background: #fff;
    }
    .login-btn{
        text-align: center;
    }
    .login-btn button{
        width:100%;
        height:36px;
    }
</style>
