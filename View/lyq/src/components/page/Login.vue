<template>
    <div class="login-wrap">
        <div class="index_header font30 rlt">
            <div class="index_header_title">小型企业财产管理系统</div>
            <div class="time abs">
                <marquee style="color:#fff; font-size:large">
                    {{time.nowYear}}年{{time.nowMonth}}月{{time.nowDate}}日
                    &nbsp;&nbsp;星期{{time.nowStr}}
                </marquee>
            </div>
        </div>
        <div class="ms-login">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="0px" class="demo-ruleForm">
                <el-form-item prop="username">
                    <el-input v-model="ruleForm.username" placeholder="请输入用户名" ></el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input type="password" placeholder="请输入密码" v-model="ruleForm.password" @keyup.enter.native="submitForm('ruleForm')"></el-input>
                </el-form-item>
                <el-form-item prop="region">
                    <select style="width:100px;height:26px;" v-model="ruleForm.region">
                        <option value ="gly">管理员</option>
                        <option value ="yg">员工</option>
                    </select>
                </el-form-item>
                <el-form-item>
                    <el-checkbox v-model="checked" checked class="remember">记住密码</el-checkbox>
                </el-form-item>
                <div class="login-btn">
                    <el-button type="primary" @click="submitForm('ruleForm')" style="background-color: #e4393c;border-color:#e4393c;" >登录</el-button>
                </div>

                <div class="region-btn" style="margin-top:10px;">
                    <el-button class=" regin" type="primary"  @click="GoToRegion()">高层注册</el-button>
                </div>
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
                    region:'gly'
                },
                rules: {
                    username: [
                        { required: true, message: '请输入用户名', trigger: 'blur' }
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur' }
                    ]
                },
                time:{
                    nowYear: "",
                    nowMonth: "",
                    nowDate: "",
                    nowStr: ""
                },
                checked: true
            }
        },
        mounted: function(){
            var date = new Date();
            var a = new Array("日","一","二","三","四","五","六");
            var week =new Date().getDay();
            var str = a[week];
            this.time.nowYear = date.getFullYear();
            this.time.nowMonth = date.getMonth()+1;
            this.time.nowDate = date.getDate();
            this.time.nowStr = str;
        },
        methods: {
            GoToRegion(){
        this.$router.push('/regin');
    },
            submitForm(formName) {
                const self = this;
                let data = this.ruleForm;

               XHRGet('./login.php',data, function (response) {
                   console.log(response)
                   //console.log(response.data)
                   if (response.data === "登录成功") {
                        localStorage.setItem('ms_username',self.ruleForm.username);
                        self.$router.push('/readme');
                    } else {
                         console.log('error submit!!');
                        return false;
                    }
                })

            },


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
    .ms-login{
        position: absolute;
        left:50%;
        top:50%;
        width:350px;
        height:300px;
        margin:-150px 0 0 -190px;
        padding:40px;
        border-radius: 5px;
        background: #fff;
    }
    .login-btn,.region-btn{
        text-align: center;
    }
    .login-btn button,.region-btn button{
        width:100%;
        height:36px;
    }
</style>
