<template>
    <div>
        <div class="container _logi">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <h2 class="_title2 _mar_b30 _text_center">Registration</h2>
                    
                    <div class="_cvent_form_main _box_shdw1">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">First Name <span>*</span></p>

                                    <input v-model="formData.firstName" class="_1int" type="text" placeholder="Type first name">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Last Name <span>*</span></p>

                                    <input v-model="formData.lastName" class="_1int" type="text" placeholder="Type last name">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Email Address <span>*</span></p>

                                    <input v-model="formData.email" class="_1int" type="text" placeholder="Type email address">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Phone Number <span>*</span></p>

                                    <input v-model="formData.phone" class="_1int" type="number" placeholder="Type phone number">
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Password</p>

                                    <input v-model="formData.password" class="_1int" type="password" placeholder="Type password">
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Confirm password</p>

                                    <input v-model="formData.confirmPassword" class="_1int" type="password" placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 _mar_b10">
                                <hr>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Country <span>*</span></p>

                                    <select  v-model="formData.country" class="_1select">
                                        <option>Choose country</option>
                                        <option>Bangladesh</option>
                                        <option>Bangladesh</option>
                                        <option>Bangladesh</option>
                                        <option>Bangladesh</option>
                                        <option>Bangladesh</option>
                                        <option>Bangladesh</option>
                                    </select>
                                    <!-- <input v-model="formData.country" class="_1int" type="text" placeholder="Type the city"> -->
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">City <span>*</span></p>

                                    <input v-model="formData.city" class="_1int" type="text" placeholder="Type the city">
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12">
                                <p class="after"><Checkbox v-model="agree"></Checkbox> After register, I agree with <a class="_1link" href=""><strong>terms &amp; condition</strong></a> of Africa Forward</p>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="_group_button">
                                    <button @click="submit" class="_btn3" :disable="isLoading" type="button">Submit</button>
                                </div>
                            </div>
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
            isLoading: false,
    		formData : {
    			firstName: '',
                lastName: '',
                phone:'',
    			email: '',
    			password: '',
    			confirmPassword: '',
                country: '',
                city: ''
            },
            agree: false
    	}
    },

    methods : {
    	async submit(){
    		if(this.formData.firstName.trim()=='') return this.e('First name is required!')
    		if(this.formData.lastName.trim()=='') return this.e('Last name is required!')
    		if(this.formData.email.trim()=='') return this.e('Email is required!')
    		if(this.formData.phone.trim()=='') return this.e('Phone is required!')
    		if(this.formData.password.trim()=='') return this.e('Password is required!')
    		if(this.formData.confirmPassword.trim()=='') return this.e('Confirm password is required!')
    		if(this.formData.password != this.formData.confirmPassword){
                this.i("The password confirmation does not match!");
                return;
            }
    		if(this.formData.country=='') return this.e('Country is required!')
            if(this.formData.city.trim()=='') return this.e('City is required!')
            if(this.agree == false) return this.e('You have to agree our terms!')

    		delete this.formData.confirmPassword;

            this.isLoading = true;

            const res = await this.callApi('post', 'app/registration', this.formData)

            if(res.status===201){
                this.s("Registration Successfull!");
                // this.login(res.formData);
                this.formData.firstName = ''
                this.formData.lastName = ''
                this.formData.phone =''
                this.formData.email = ''
                this.formData.password = ''
                this.formData.confirmPassword = ''
                this.formData.country = ''
                this.formData.city = ''
                this.agree == false
            }else if(res.status==422){
                    for(let i in res.data.errors){
                        this.e(res.data.errors[i][0])
                    }
                }
            else{
                this.swr();
            }
            
            this.isLoading = false; 
    	}
    }
};	
</script>