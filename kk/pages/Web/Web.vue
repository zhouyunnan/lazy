<template>
	<view>
		<web-view  :src="src"></web-view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				src:""
			}
		},
		onLoad(op){
			this.src = decodeURIComponent(op.url); 
		},
		methods: {
			
		}
	}
</script>

<style>

</style>
