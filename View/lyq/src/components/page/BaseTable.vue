<template>
    <el-form ref="form" :model="form" label-width="80px" @submit.prevent="onSubmit" style="margin:20px;width:60%;min-width:600px;">
        <el-form-item label="机器编号">
            <el-input v-model="form.number"></el-input>
        </el-form-item>
        <el-form-item label="机器名称">
            <el-input v-model="form.jqname"></el-input>
        </el-form-item>
        <el-form-item label="损坏类型">
            <el-select v-model="form.region" placeholder="请选择">
                <el-option label="私损" value="私损"></el-option>
                <el-option label="公损" value="公损"></el-option>
                <el-option label="其他" value="其他"></el-option>
            </el-select>
        </el-form-item>
        <el-form-item label="损坏日期">
            <el-col :span="11">
                <input type="date" placeholder="选择日期" v-model="form.gdate" style="width:238px;height:36px;">
            </el-col>

        </el-form-item>

        <el-form-item label="是否保修">
            <el-switch on-text="" off-text="" v-model="form.delivery"></el-switch>
        </el-form-item>

        <el-form-item label="详细介绍">
            <el-input type="textarea" v-model="form.gdesc"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" v-on:click="onSubmit">立即创建</el-button>
            <el-button @click.native.prevent>取消</el-button>
        </el-form-item>
    </el-form>
</template>

<script type="text/jsx">
    import { XHRGet, XHRPost } from "../../api/ajax";
    export default {
        data() {
            return {
                form: {
                    jqname: '',
                    region: '',
                    gdate: '',
                    delivery: false,
                    gdesc: '',
                    number:'',
                    tdata:'待维修中',
                    name:'待维修人员',
                    tag:'未修好',
                    detailed:'等待维修人员到达现场，待维修状态下'
                }
            }
        },
        methods: {
            onSubmit() {
                this.$message.success('提交成功！');
                let data = this.form;
                XHRGet('./basetable.php',data, function (response) {
                    console.log(response);
                })
            }
        }
    }

</script>
