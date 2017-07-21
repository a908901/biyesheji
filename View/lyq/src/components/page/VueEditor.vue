<template>
    <div>
        <div class="form-box">
            <el-form ref="form" :model="form" label-width="80px">
                <el-form-item label="帐单号">
                    <el-input v-model="form.number"></el-input>
                </el-form-item>
                <el-form-item label="款项来源">
                    <el-select v-model="form.region" placeholder="请选择">
                        <el-option label="公司盈利" value="公司盈利"></el-option>
                        <el-option label="借贷融资" value="借贷融资"></el-option>
                        <el-option label="接受资助" value="接受资助"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="日期时间">
                    <el-col :span="11">
                        <input type="date" placeholder="选择日期" v-model="form.kdate" style="width:520px;height:36px;">
                    </el-col>
                </el-form-item>
                <!--<el-form-item label="选择开关">-->
                <!--<el-switch on-text="" off-text="" v-model="form.delivery"></el-switch>-->
                <!--</el-form-item>-->
                <el-form-item label="款额">
                    <el-radio-group v-model="form.resource">
                        <el-radio label="0-500"></el-radio>
                        <el-radio label="500-1000"></el-radio>
                        <el-radio label="1000-5000"></el-radio>
                        <el-radio label="5000-10000"></el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="详细说明">
                    <el-input type="textarea" v-model="form.adesc"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit">提交</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
            </el-form>
        </div>

    </div>
</template>

<script>
    import { XHRGet, XHRPost } from "../../api/ajax";
    export default {
        data: function(){
            return {
                form: {
                    number: '',
                    region: '',
                    kdate: '',
                    resource: '0-500',
                    adesc: ''
                },

            }
        },
        methods: {
            onSubmit() {
                this.$message.success('提交成功！');
                let data = this.form;
                XHRGet('./VueEditor.php',data, function (response) {
                    console.log(response);
                })
            }
        }
    }
</script>
