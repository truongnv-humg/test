<template>
    <div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="form-register">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address" v-model="email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nick name" v-model="nickName">
                    </div>
                    <div class="form-group position-relative">
                        <input type="password" class="form-control" placeholder="Password" v-on:keyup="handlePassword" v-model="password">
                        <img src="/images/lock.png" alt="" class="icon-lock">
                        <span v-if="!passVerify" class="text-danger">{{ notifyCheckPass }}</span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" v-model="rePassword">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="" id="" v-model="country">
                            <option value="">Country</option>
                            <option value="vn">Viet Nam</option>
                            <option value="jp">Japanese</option>
                        </select>
                    </div>
                    <button class="btn btn-primary text-uppercase btn-block" v-on:click="handleRegister">register</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                email: '',
                nickName: '',
                password: '',
                rePassword: '',
                country: '',
                notifyCheckPass: '',
                passVerify: true,
                errorPass: 'Please enter a password between 8 and 16 characters',

            }
        },
        methods : {
            handlePassword: function () {
                let regexCheckPass = new RegExp('^[a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)]{8,16}?$', 'gm');
                let result = regexCheckPass.test(this.password);
                console.log(result)
                this.passVerify = result;
                if (!result) {
                    this.notifyCheckPass = this.errorPass;
                }
                //console.log(this.passVerify)
            },

            handleRegister: function () {
                let url = 'http://localhost:8000/test';
                let data = {
                    email: this.email,
                    nickName: this.nickName,
                    password: this.password,
                    rePassword: this.rePassword,
                    country: this.country
                }
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    headers: {
                        //add header neu co
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        //hieu ung loading khi send du lieu
                    },
                    success: function (response) {
                        console.log(response)
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .form-register {
        width: 300px;
        margin: 0 auto;
    }

    .icon-lock {
        position: absolute;
        right: 5px;
        top: 9px;
        width: 15px;
        opacity: .6;
    }
</style>