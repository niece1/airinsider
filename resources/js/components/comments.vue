<template>
  <div class="comments">        
    <div v-if="auth" class="comments-form">
      <textarea v-model="newComment" type="text" placeholder="Comment here"></textarea>
      <div v-if="errors && errors.body" class="invalid-feedback">
        {{ errors.body[0] }}
      </div>
      <button class="button" @click="addComment">Add comment</button>
    </div>
    <!-- Comment Vue Component -->
    <comment v-for="comment in comments.data" :key="comment.id" :comment="comment" :post="post"></comment>
    <div class="more-comments">
      <button v-if="comments.next_page_url" @click="fetchComments" class="button">Load More</button>
    </div>
  </div>
</template>

<script>
import Comment from "./comment.vue";
export default {
  props: ["post"],
  components: {
    Comment
  },
  mounted() {
    this.fetchComments();
  },
  computed: {
    auth() {
      return __auth();
    }
  },
  data: () => ({
    comments: {
      data: []
    },
    newComment: "",
    errors: {}
  }),
  methods: {
    fetchComments() {
      const url = this.comments.next_page_url ? this.comments.next_page_url : `/posts/${this.post.id}/comments`;
      axios.get(url).then(({ data }) => {
        this.comments = {
          ...data,
          data: [...this.comments.data, ...data.data]
        };
      });
    },
    addComment() {
      if (!this.newComment) return;
      axios.post(`/comments/${this.post.id}`, {
        body: this.newComment
      }).then(({ data }) => {
        this.comments = {
          ...this.comments,
          data: [data, ...this.comments.data]
        };
        this.newComment = "";
      }).catch(error => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        }
      });
    }
  }
};
</script>

<style scoped>
.comments .comments-form textarea {
  border: none;
  border-bottom: 1px solid #000;
  outline: none;
  width: 100%;
  font-size: 1.6rem;
  font-family: "Open Sans", sans-serif;
}

.comments .comments-form textarea::placeholder {
  color: #4e4e4e;
  font-size: 1.6rem;
  opacity: 1;
}

.comments .comments-form textarea::-webkit-input-placeholder {
  color: #4e4e4e;
  font-size: 1.6rem;
}

.comments .comments-form button.button {
  border: 2px solid #f75679;
  padding: 7px 16px;
  cursor: pointer;
  font-size: 1.2rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 3px;
  background-color: transparent;
  color: #000;
  outline: none;
  margin: 10px 0;
}

.comments .comments-form button.button:hover {
  background-color: #f75679;
  color: #fff;
  border: 2px solid #f75679;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
}

.comments .comments-form button.button:not(:hover) {
  background-color: transparent;
  color: #000;
  transition: all 0.3s ease-in-out;
}

.comments .more-comments button.button {
  cursor: pointer;
  border: 2px solid #f75679;
  padding: 14px 25px 12px;
  font-size: 1.3rem;
  outline: none;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 3px;
  background-color: transparent;
  color: #000;
  margin: 5px 0;
}

.comments .more-comments button.button:hover {
  background-color: #f75679;
  color: #fff;
  border: 2px solid #f75679;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
}

.comments .comments-form .invalid-feedback {
  color: #f75679;
  font-size: 1.2rem;
  text-align: left;
}
</style>