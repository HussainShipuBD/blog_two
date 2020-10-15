<template>
    <div>
        <div class="container _logi">
            <div class="row justify-content-center">
                <div class="col-12 col-md-5 col-lg-5">
                    <h2 class="_title2 _mar_b30 _text_center">Log in your accout</h2>

                    <div class="_cvent_form_main _box_shdw1">
                        <div class="_input_group">
                            <p class="_1label">Email or Phone number <span>*</span></p>

                            <input v-model="data.email" class="_1int" type="text" placeholder="Type email">
                        </div>

                        <div class="_input_group">
                            <p class="_1label">Password <span>*</span></p>

                            <input v-model="data.password" class="_1int" type="password" placeholder="Type passwod">
                            <p class="_text_right _mar_t10"><router-link to="/forgetPassword" class="_1link">Forget passwod?</router-link></p>
                        </div>

                        <div class="_group_button _text_center">
                            <button @click="login" class="_btn3" :disable="isLoading" type="button">Log in</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
    	return {
    		data : {
    			email: '',
    			password: ''
    		},
            isLoading: false
    	}
    },

    methods : {
    	 async login(){
            if(this.data.email.trim()=='') return this.e('Email is required')
            if(this.data.password.trim()=='') return this.e('Password is required')
            if(this.data.password.length < 6) return this.e('Incorrect login details')
            this.isLogging = true
            const res = await this.callApi('post', 'app/login', this.data)
            if(res.status===200){
                this.s(res.data.msg)
                window.location = '/index'
            }else{
                if(res.status===401){
                    this.i(res.data.msg)
                }else if(res.status==422){
                    for(let i in res.data.errors){
                        this.e(res.data.errors[i][0])
                    }
                }
                else{
                    this.swr()
                }
            }
            this.isLogging = false
        }
    }
};	
</script>