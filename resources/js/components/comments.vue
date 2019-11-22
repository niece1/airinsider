<template>
    <div class="comments">
        <h4>Комментарии</h4>
    	<div v-if="auth" class="comments-form">
    		<textarea v-model="newComment" type="text" placeholder="Ваш комментарий"></textarea>
    		<button class="button" @click="addComment">Добавить комментарий</button>
    	</div>

        <comment v-for='comment in comments.data' :key="comment.id" :comment="comment" :post="post" ></comment>

    	<div class="more-comment">
            <button v-if="comments.next_page_url" @click="fetchComments" class="button">
                Load More
            </button>         
        </div>
    	
    </div>

  
</template>

<script>
 
    import Comment from './comment.vue'
    export default {
        props: ['post'],
        components: {
            Comment
        },
        mounted() {
            this.fetchComments()
        },
        computed: {
            auth() {
                return __auth()
            }
        },
        data: () => ({
            comments: {
                data: []
            },
            newComment: ''
        }),
        methods: {
            fetchComments() {
                const url = this.comments.next_page_url ? this.comments.next_page_url : `/posts/${this.post.id}/comments`
                axios.get(url).then(({ data }) => {
                    this.comments = {
                        ...data,
                        data: [
                            ...this.comments.data,
                            ...data.data
                        ]
                    }
                })
            },
            addComment() {
                if (! this.newComment) return
                axios.post(`/comments/${this.post.id}`, {
                    body: this.newComment
                }).then(({ data }) => {
                    this.comments = {
                        ...this.comments,
                        data: [
                            data,
                            ...this.comments.data
                        ]
                    };
                    this.newComment= "";
                })
            }
        }
    }
    
</script>

<style scoped>
    .comments h4 {
        margin: 50px 0 20px 0;
        font-weight: normal;
    }
	.comments .comments-form textarea {
		border: none;
		border-bottom: 2px solid #000;
        outline: none; 
        width: 100%; 
        font-size: 1.8rem;       
	}

    .comments .comments-form textarea::placeholder {
        color: #4e4e4e;
        opacity: 1;
    }

    .comments .comments-form textarea::-webkit-input-placeholder {
        color: #4e4e4e;
    }

	.comments .comments-form button.button {
		border: 2px solid #e71d43;
        padding: 14px 30px;
        cursor: pointer;                
        font-size: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 3px; 
        background-color: transparent;
        color: #000;
        margin: 10px 0 20px 0;
	}

	.comments .comments-form button.button:hover {
		background-color: #e71d43;
        color: #fff;
        border: 2px solid #e71d43;
        transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
	}

	.comments .comments-form button.button:not(:hover) {
		background-color: transparent;
        color: #000;
        transition: all 0.3s ease-in-out;
	}

    .comments .more-comment button.button {
        cursor: pointer;
        border: 2px solid #e71d43;
        padding: 14px 30px;
        font-size: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 3px; 
        background-color: transparent;
        color: #000;
        margin: 5px 0;
    }

    .comments .more-comment button.button:hover {
        background-color: #e71d43;
        color: #fff;
        border: 2px solid #e71d43;
        transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
    }
	
</style>