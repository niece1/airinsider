<template>
	<div class="comment">
		<avatar :username="comment.user.name" :size="35"></avatar>
		<div class="comment-itself">
			<h6>{{ comment.user.name }}</h6>
			<p>{{ comment.body }}</p>
		</div>

		<div class="replies">
			<button @click="addingReply = !addingReply" class="button">Add reply</button>
		</div>
		<replies ref='replies' :comment="comment"></replies>
	</div>
</template>

<script>
	import Avatar from 'vue-avatar'
	import Replies from './replies.vue'

	export default {
		components: {
			Avatar,
			Replies
		},
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
			post: {
				required: true,
				default: () => ({})
			}
		},

	}
</script>

<style scoped>

</style>