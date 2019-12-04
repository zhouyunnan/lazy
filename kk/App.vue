<script>
export default {
	onLaunch: function() {
		console.log('App Launch');
	},
	onShow: function() {
		console.log('App Show');
	},
	onHide: function() {
		console.log('App Hide');
	},
	onError: function(err) {
		var json = JSON.stringify(err);  
		uni.request({
			method: 'GET',
			url: this.myconfig.url + 'qq.php/home/error/add',
			data: {
				"e":json,
			
			},
			header: {
				'content-type': 'application/x-www-form-urlencoded;charset=utf-8'
			},
			success: res => {}
		});
	}
};
</script>

<style lang="scss">
page {
	background: #F0F0F0;
}

</style>
