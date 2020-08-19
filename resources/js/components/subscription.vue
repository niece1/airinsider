<template>
    <div>
        <form class="input-wrapper" v-if="form" @submit.prevent="submit" autocomplete="off">
            <input id="newsletter" name="email" type="email" v-model="email" placeholder="Получить новости">
            <button type="submit"><i class="fa fa-envelope-o"></i></button>
            <div v-if="errors && errors.email" class="invalid-feedback">
                {{ errors.email[0] }}
            </div>
        </form>
        <h6 v-if="sent" class="sent-success">Ваш email отправлен</h6>
    </div>
</template>

<script>
export default {
    data: () => ({
        email: "",    
        errors: {},
        form: true,
        sent: false
    }),
    methods: {
        submit() {
            axios
                .post("/subscriptions", {
                    email: this.email,
                })
                .then(response => {
                    this.email = "";
                    this.form = false;
                    this.sent = true;
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
        }
    }
};

</script>

<style scoped>

.input-wrapper {
    width: 100%;
    margin: 5px auto;
    position: relative;
}
.input-wrapper input {
    color: #9c9c9c;
    border-radius: 0;
    outline: none;
    width: 100%;
    border: none;
    padding: 10px 0;
    border-bottom: 2px solid #9c9c9c;
    background-color: transparent;
    font-size: 1.6rem;
}
.input-wrapper input::placeholder {
    color: #9c9c9c;
    opacity: 1;
}
.input-wrapper button {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    border: none;
    background: transparent;
    outline: none;
    font-size: 1.8rem;
    color: #9c9c9c;
    cursor: pointer;
    padding: 0 3px;
}
.input-wrapper .invalid-feedback {
    color: #e71d43;
    font-size: 1.2rem;
    text-align: left;
}
.sent-success {
    font-weight: normal;
    color: #0633ff;
}

</style>
