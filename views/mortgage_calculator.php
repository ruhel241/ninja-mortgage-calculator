<html>
<head>
</head>
	<body>
		<div id="app">
			<h2>My Vuejs is awesome</h2>
			<p>{{ value }}</p>
		</div>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js"></script>
	<script type="text/javascript">
		new Vue({
			el: "#app",
			data: {
				value: 'Lahin'
			}
		})
	</script>
</html>