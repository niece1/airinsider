<template>
	<div class="comment">
		<avatar :username="comment.user.name" :size="35"></avatar>
		<div class="comment-itself">
			<h6>{{ comment.user.name }}</h6>
			<p>{{ comment.body }}</p>
		</div>

		<div class="replies">
			<button @click="addingReply = !addingReply" class="button">Add reply</button>
			<div v-if="addingReply" class="form-inline my-4 w-full">
                <input v-model='body' type="text" class="form-control form-control-sm w-80">
                <button @click="addReply" class="button">
                    <small>Add reply</small>
                </button>
            </div>
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
		methods: {
         addReply() {
             if (! this.body) return
             axios.post(`/comments/${this.post.id}`, {
                 comment_id: this.comment.id,
                 body: this.body
             }).then(({ data }) => {
                 this.body = ''
                 this.addingReply = false
                 this.$refs.replies.addReply(data)
             })
         }
     }

	}
</script>

<style scoped>

</style>