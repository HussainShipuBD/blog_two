<template>
    <div>
        <div class="container _logi">
            <div class="row justify-content-center">
                <div class="col-12 col-md-5 col-lg-5">
                    <h2 class="_title2 _mar_b30 _text_center">Forget password</h2>

                    <div class="_cvent_form_main _box_shdw1">
                        <div v-if="openEmail" class="_input_group">
                            <p class="_1label">Email <span>*</span></p>

                            <input v-model="data.email" class="_1int" type="text" placeholder="Type email">
                        </div>

                        <div v-if="openCode" class="_input_group">
                            <p class="_1label">Your code <span>*</span></p>

                            <input v-model="data.resetToken" class="_1int" type="number" placeholder="Type code">
                        </div>

                        <div v-if="openPassword" class="">
                            <div class="_input_group">
                                <p class="_1label">New password <span>*</span></p>

                                <input v-model="editData.password" class="_1int" type="password" placeholder="Type your new password">
                            </div>

                            <div class="_input_group">
                                <p class="_1label">Confirm password <span>*</span></p>

                                <input v-model="editData.confirmPassword" class="_1int" type="password" placeholder="Confirm password">
                            </div>
                        </div>

                        <div class="_group_button _text_center">
                            <button v-if="openEmail" @click="emailCheck" class="_btn3" :disable="isLoading" type="button">Submit</button>
                            <button v-if="openCode" @click="codeCheck" class="_btn3" :disable="isLoading" type="button">Submit code</button>
                            <button v-if="openPassword" @click="newPassword" class="_btn3" :disable="isLoading" type="button">Pass Submit</button>
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
            data: {
                email: '',
                resetToken: '',
            },
            ver_email: {},
            editData: {
                email: '',
                password: '',
                confirmPassword: ''
            },
            isLoading: false,
            openCode: false,
            openEmail: true,
            openPassword: false,
    	}
    },

    methods : {
    	async emailCheck(){
            if(this.data.email.trim()=='') return this.e('Email is required')
            this.isLogging = true
            const res = await this.callApi('post', 'app/email_check', this.data)
            if(res.status===200){
                this.ver_email = res.data.user
                this.s(res.data.msg);
                this.openCode = true
                this.openEmail = false
                this.data.email = ''
                // window.location = '/'
            }else{
                if(res.status===401){
                    this.i(res.data.msg)
                }else if(res.status==422){
                    this.i(res.data.msg)
                }
                else{
                    this.swr()
                }
            }
            this.isLogging = false
        },

        async codeCheck(){
            if(this.data.resetToken.trim()=='') return this.e('Code is required')
            this.isLogging = true
            this.data.email = this.ver_email.email
            const res = await this.callApi('post', 'app/code_check', this.data)
            if(res.status===200){
                this.s(res.data.msg);
                this.openCode = false
                this.openEmail = false
                this.openPassword = true
                this.data.code = ''
                // window.location = '/'
            }else{
                if(res.status===401){
                    this.i(res.data.msg)
                }else if(res.status==422){
                    this.i(res.data.msg)
                }
                else{
                    this.swr()
                }
            }
            this.isLogging = false
        },

        async newPassword(){
    		if(this.editData.password=='') return this.e('Password is required!')
    		if(this.editData.confirmPassword=='') return this.e('Confirm password is required!')
            if(this.editData.password != this.editData.confirmPassword){
                this.i("The password confirmation does not match!");
                return;
            }

            delete this.editData.confirmPassword;
            
            this.isLogging = true

            this.editData.email = this.ver_email.email

            const res = await this.callApi('post', 'app/new_password', this.editData)
            if(res.status===200){
                this.s('Password has been changed successfully');
                // this.openCode = false
                // this.openEmail = false
                // this.openPassword = true
                this.editData.password = ''
                this.editData.confirmPassword = ''
                window.location = '/login'
            }else{
                if(res.status===401){
                    this.i(res.data.msg)
                }else if(res.status==422){
                    this.i(res.data.msg)
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