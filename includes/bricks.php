<script type="text/javascript">
	const bricks = Bricks({
		container: '.columns',
		packed: 'data-packed',
		sizes: [
			{ columns: 1, gutter: 20 },
			{ mq: '760px', columns: 2, gutter: 20 },
			{ mq: '1020px', columns: 3, gutter: 30 }
		],
		position: false
	});
	$(document).ready(function () {
		bricks.pack();
	});
</script>