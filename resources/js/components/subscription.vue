<template>
    <div>
        <form class="input-wrapper" v-if="form" @submit.prevent="submit" autocomplete="off">
            <div class="form-group">
                <input id="newsletter" name="email" type="email" v-model="email" placeholder="Your email">
                <button type="submit" :class="{ disabledButton: !checked }" :disabled="!checked">
                <svg xmlns="http://www.w3.org/2000/svg" class="envelope" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
                </button>
            </div>
            <div v-if="errors && errors.email" class="invalid-feedback">
                {{ errors.email[0] }}
            </div>
            <div class="policy-consent">
                <label class="checkbox-container">
                    <input type="checkbox" v-model="checked">
                    <span class="checkmark"></span>
                    <small>
                        By sending email you accept the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy.</a>
                    </small>
                </label>
            </div>
        </form>
        <h2 v-if="sent" class="sent-success">You are subscribed!</h2>
    </div>
</template>

<script>
export default {
    data: () => ({
        email: "",
        checked: false,
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

<style lang='scss' scoped>
form.input-wrapper {
    width: 100%;
    font-family: "Open Sans", sans-serif;
    margin: 5px auto;
    .form-group {
        position: relative;
        input {
            color: #000;
            border-radius: 0;
            outline: none;
            width: 100%;
            border: none;
            padding: 10px 0;
            border-bottom: 1px solid #000;
            background-color: transparent;
            font-size: 1.6rem;
            &::placeholder {
                opacity: 1;
                color: #000;
            }
        }
        button {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            border: none;
            background: transparent;
            outline: none;
            cursor: pointer;
            color: #0084ff;
            .envelope {
                width: 3rem;
                height: 3rem;
            }
        }
        .disabledButton {
            cursor: not-allowed;
            color: #4e4e4e;
        }
    }
    .invalid-feedback {
        color: #f75679;
        font-size: 1.3rem;
        text-align: left;
        margin-top: 3px;
    }
    .policy-consent {
        text-align: left;
        margin-top: 3px;
        .checkbox-container {
            display: inline-block;
            position: relative;
            padding-left: 30px;
            font-size: 1.4rem;
            cursor: pointer;
            user-select: none;
            margin-top: 5px;
            input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
                &:checked ~ .checkmark {
                    background-color: #0084ff;
                    &:after {
                        display: block;
                    }
                }
            }
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 1.8rem;
                width: 1.8rem;
                background-color: #cccccc;
                &:after {
                    content: "";
                    position: absolute;
                    display: none;
                }
            }
        }
        .checkbox-container .checkmark:after {
            width: 5px;
            height: 10px;
            left: 5px;
            top: 1px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }
        small {
            font-size: 1.3rem;
            color: #4e4e4e;
            a {
                color: #f75679;
            }
        }
    }
}
.sent-success {
    font-weight: normal;
    color: #000;
}
</style>
