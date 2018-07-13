<template>
	<el-row>
        <el-col :span="8">
            <label>Show Amortization Field</label>
            <el-switch
              v-model="amortization"
              active-color="#13ce66"
              inactive-color="#ff4949">
            </el-switch>
        </el-col>
    </el-row>
</template>

<script>
export default {
	name: 'ShowAmortization',
	data() {
		return {
			amortization: true
		}
	}
}
</script>