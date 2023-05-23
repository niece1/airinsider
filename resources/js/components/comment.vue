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
      <div class="comment-likes">
        <!-- Likes Vue Component -->
        <likes :default_likes="comment.likes" :entity_id="comment.id" :entity_owner="comment.user.id"></likes>
      </div>
      <button @click="addingReply = !addingReply" class="add-reply-button">Add reply</button>
      <div v-if="addingReply" class="add-reply">
        <div v-if="auth">
          <textarea v-model="body" type="text" placeholder="Reply here"></textarea>
          <div v-if="errors && errors.body" class="invalid-feedback">
            {{ errors.body[0] }}
          </div>
          <button @click="addReply" class="button">Reply</button>
        </div>
        <div v-else>
          <p class="login-to-answer">Sign in to reply</p>
        </div>
      </div>
    </div>
    <!-- Replies Vue Component -->
    <replies ref="replies" :comment="comment"></replies>
  </div>
</template>

<script>
import Avatar from "vue-avatar";
import Replies from "./replies.vue";

export default {
  components: {
    Avatar,
    Replies
  },
  data() {
    return {
      body: "",
      addingReply: false,
      errors: {}
    };
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
  computed: {
    auth() {
      return __auth();
    }
  },
  methods: {
    addReply() {
      if (!this.body) return;
      axios.post(`/comments/${this.post.id}`, {
        comment_id: this.comment.id,
        body: this.body
      }).then(({ data }) => {
        this.body = "";
        this.addingReply = false;
        this.$refs.replies.addReply(data);
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
.comment {
  width: 100%;
}

.comment .comment-itself {
  margin: 30px 0 20px 0;
}

.comment .comment-itself h6 {
  font-weight: normal;
  font-size: 1.6rem;
}

.comment .comment-itself p {
  font-size: 1.4rem;
}

.comment .replies {
  margin-top: 7px;
}

.comment .replies button.add-reply-button {
  cursor: pointer;
  font-size: 1.2rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: none;
  background-color: transparent;
  outline: none;
  color: #0084ff;
}

.comment .replies button.add-reply-button:hover {
  color: #f75679;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
}

.comment .replies .add-reply {
  margin: 40px 0 0 0;
}

.comment .replies .login-to-answer {
  color: #f75679;
}

.comment .replies .add-reply textarea {
  margin: 0 0 0 65px;
  border: none;
  border-bottom: 1px solid #000;
  outline: none;
  width: 100%;
  font-size: 1.6rem;
  font-family: "Open Sans", sans-serif;
}

.comment .replies .comment-likes {
  margin: 0 10px 0 65px;
  float: left;
}

.comment .replies .add-reply button.button {
  border: 2px solid #f75679;
  padding: 7px 16px;
  cursor: pointer;
  font-size: 1.2rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 3px;
  background-color: transparent;
  color: #000;
  margin: 10px 0 20px 65px;
}

.comment .replies .add-reply button.button:hover {
  background-color: #f75679;
  color: #fff;
  border: 2px solid #f75679;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
}

.comment .comment-itself .avatar-label {
  float: left;
  margin-right: 15px;
}

.comment .replies .invalid-feedback {
  color: #f75679;
  font-size: 1.2rem;
  text-align: left;
  margin-left: 65px;
}
</style>