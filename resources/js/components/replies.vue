<template>
    <div class="reply">
        <div class="reply-itself" v-for="reply in replies.data">
        <div class="avatar-label">
                <avatar :username="reply.user.name" class='mr-3' :size="35"></avatar>
          </div>
            <div class="reply-body">
                <h6>{{ reply.user.name }}</h6>
                <p>{{ reply.body }}</p>
                
            </div>
            <likes :default_likes="reply.likes" :entity_id="reply.id" :entity_owner="reply.user.id"></likes>
        </div>

        <div v-if="comment.repliesCount > 0 && replies.next_page_url" class="load-replies">
            <button @click="fetchReplies" class="button">Load Replies</button>
        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar'
    export default {
        props: ['comment'],
        components: {
            Avatar,
        },
        data() {
            return {
                replies: {
                    data: [],
                    next_page_url: `/comments/${this.comment.id}/replies`
                }
            }
        },
        methods: {
            fetchReplies() {
                axios.get(this.replies.next_page_url).then(({ data }) => {
                    this.replies = {
                        ...data,
                        data: [
                            ...this.replies.data,
                            ...data.data
                        ]
                    }
                })
            },
            addReply(reply) {
                this.replies = {
                    ...this.replies,
                    data: [
                        reply,
                        ...this.replies.data
                    ]
                }
            }
        }
    }
</script>

<style scoped>

.reply .reply-itself {
    margin: 10px 0 10px 65px;
}

.reply .reply-itself .avatar-label {
    float: left;
    margin-right: 10px;
}

.reply .reply-itself .reply-body h6 {
    font-weight: normal;
}

.reply .load-replies button.button {
    cursor: pointer;
    color: #0633ff;                
    font-size: 1.5rem;
    letter-spacing: 1px;
    border: none;
    background-color: transparent;
    margin: 10px 0 0 0;
    outline: none;
}

.reply .load-replies button.button:hover {
    color: #e71d43;
    transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
}

</style>