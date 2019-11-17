<template>
	<div class="comment">
<div class="comment-itself">
<h6>Volodymyr Kozak</h6>
<p></p>
</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				body: '',
				addingReply: false
			}
		},
		props: {
			comment: {
				required: true,
				default: () => ({})
			},
			video: {
				required: true,
				default: () => ({})
			}
		},
	}
</script>

<style scoped>

</style>