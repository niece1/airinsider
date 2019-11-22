<template>
	<div class="comment">
		<div class="comment-itself">
			<div class="avatar-label">
		<avatar :username="comment.user.name" :size="50"></avatar>
		</div>
			<h6>{{ comment.user.name }}</h6>
			<p>{{ comment.body }}</p>
		</div>

		<div class="replies">
			<button @click="addingReply = !addingReply" class="button">Добавить ответ</button>
			<div v-if="addingReply" class="add-reply">
                <textarea v-model='body' type="text" placeholder="Ваш ответ"></textarea>
                <button @click="addReply" class="button">Ответить</button>
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

.comment {
	width: 100%;
	margin: 30px 0;
}

.comment .comment-itself h6 {
	font-weight: normal;
}

.comment .replies button.button {	
    cursor: pointer;                
    font-size: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: none;
    background-color: transparent;
    outline: none;
}

.comment .replies .add-reply textarea {
	margin: 0 0 0 65px;
	border: none;
	border-bottom: 2px solid #000;
    outline: none; 
    width: 100%; 
    font-size: 1.8rem;
}

.comment .replies .add-reply button.button {
	border: 2px solid #e71d43;
    padding: 14px 30px;
    cursor: pointer;                
    font-size: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 3px; 
    background-color: transparent;
    color: #000;
    margin: 10px 0 20px 65px;
}

.comment .replies .add-reply button.button:hover {
	background-color: #e71d43;
    color: #fff;
    border: 2px solid #e71d43;
    transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
}

.comment .comment-itself .avatar-label {
	float: left;
	margin-right: 15px;
}

</style>