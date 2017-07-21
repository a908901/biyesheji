<template>
    <div class="login-wrap" style="background:#20a0ff;">
        <div class="index_header font30 rlt">
            <div class="index_header_title">天宇集团高层注册</div>
        </div>
        <div class="ms-login01">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="0px" class="demo-ruleForm">
                <el-form-item prop="username">
                    <el-input v-model="ruleForm.username" placeholder="请输入用户名" ></el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input type="password" placeholder="请输入密码" v-model="ruleForm.password" @></el-input>
                </el-form-item>
                <el-form-item prop="password01">
                    <el-input type="password01" placeholder="请再次确认密码" v-model="ruleForm.password01" ></el-input>
                </el-form-item>
                <el-form-item prop="tel">
                    <el-input type="tel" placeholder="请输入手机号码" v-model="ruleForm.tel"></el-input>
                </el-form-item>
                <el-form-item prop="email">
                    <el-input type="email" placeholder="请邮箱" v-model="ruleForm.email"></el-input>
                </el-form-item>

                <div class="login-btn">
                    <el-button type="primary" @click="submitForm('ruleForm')">注册</el-button>
                </div>
                <!--<p style="font-size:12px;line-height:30px;color:#999;">Tips : 用户名和密码随便填。</p>-->
            </el-form>
        </div>
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
                    role:'管理员'
                }
            }
        },

        methods: {
            submitForm(formName) {
        const self = this;
        let data = this.ruleForm;

        XHRGet('./guanli.php',data, function (response) {
            self.$router.push('/login');

        })

    }
    }
    }
</script>

<style>
    /*头部样式*/
    .index_header{
        width:100%;
        height:100px;
        /*background-image: linear-gradient(90deg, #224157 0%, #324157 100%);*/
        backround:#324157;
        line-height:100px;
        text-align: center;
        font-weight: bold;
        color:#fff;
        top:50px;
    }
    .index_header_title{
        width:100%;
        height:100%;
    }
    .time{
        width:30%;
        height:30px;
        line-height:30px;
        top:60px;
        left:60%;
    }
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
