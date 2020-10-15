<template>
    <div>
        <div class="_dash_content">
            <div class="_dash_admin_All">
                <div class="_dash_top">
                    <h2 class="_dash_top_title">Profile</h2>

                    <button @click="clickEditModel" class="_btn1" type="button">Edit profile</button>
                </div>

                <div class="_box_shdw1 _dashSpeaker_details_alls">
                    <div class="_profile_pic">
                        <img class="_profile_img" src="/uploads/img1.png" alt="" title=""/>
                        <p class="_pro_upload">Upload profile image</p>
                    </div>

                    <h2 class="_2title _text_center">{{ userData.firstName }} {{ userData.lastName }}</h2>

                    <p class="_profile_value"><span>Email</span> : {{ userData.email }}</p>
                    <p class="_profile_value"><span>Phone</span> : {{ userData.phone }}</p>
                    <p class="_profile_value"><span>Country</span> : {{ userData.country }}</p>
                    <p class="_profile_value"><span>City</span> : {{ userData.city }}</p>

                    <p class="_change_pass"><span @click="editPasswordModal = true">Change password</span></p>
                </div>
            </div>
        </div>

        <Modal
        v-model="openEditModal"
        width="700"
        title="Edit profile"
        @closable="false">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">First Name <span>*</span></p>

                        <input v-model="editData.firstName" class="_1int" type="text" placeholder="Type first name">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">Last Name <span>*</span></p>

                        <input v-model="editData.lastName" class="_1int" type="text" placeholder="Type last name">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">Email Address <span>*</span></p>

                        <input v-model="editData.email" class="_1int" type="text" placeholder="Type email address">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">Phone Number <span>*</span></p>

                        <input v-model="editData.phone" class="_1int" type="number" placeholder="Type phone number">
                    </div>
                </div>

                <!-- <div class="col-12 col-md-12 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">Password</p>

                        <input v-model="editData.password" class="_1int" type="password" placeholder="Type password">
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">Confirm password</p>

                        <input v-model="editData.confirmPassword" class="_1int" type="password" placeholder="Confirm password">
                    </div>
                </div> -->

                <div class="col-12 col-md-12 col-lg-12 _mar_b10">
                    <hr>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">Country <span>*</span></p>

                        <select  v-model="editData.country" class="_1select">
                            <option>Choose country</option>
                            <option>Bangladesh</option>
                            <option>Bangladesh</option>
                            <option>Bangladesh</option>
                            <option>Bangladesh</option>
                            <option>Bangladesh</option>
                            <option>Bangladesh</option>
                        </select>
                        <!-- <input v-model="editData.country" class="_1int" type="text" placeholder="Type the city"> -->
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">City <span>*</span></p>

                        <input v-model="editData.city" class="_1int" type="text" placeholder="Type the city">
                    </div>
                </div>
            </div>

            <div slot="footer">
	        	<button @click="editProfile" class="_btn3" :disable="isLoading" type="button">Submit</button>
	        	<button @click="openEditModal = false" class="_btn1">Close</button>
	        </div>
        </Modal>

        <Modal
        v-model="editPasswordModal"
        width="700"
        title="Edit profile"
        @closable="false">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">Old password</p>

                        <input v-model="editPass.oldPassword" class="_1int" type="password" placeholder="Type password">
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">New password</p>

                        <input v-model="editPass.newPassword" class="_1int" type="password" placeholder="Confirm password">
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="_input_group">
                        <p class="_1label">New password</p>

                        <input v-model="editPass.confirmPassword" class="_1int" type="password" placeholder="Confirm password">
                    </div>
                </div>
            </div>

            <div slot="footer">
	        	<button @click="editPassword" class="_btn3" :disable="isLoading" type="button">Submit</button>
	        	<button @click="editPasswordModal = false" class="_btn1">Close</button>
	        </div>
        </Modal>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data() {
    	return {
            openEditModal: false,
            editPasswordModal: false,
            isLoading: false,
            editData:{
                firstName: '',
                lastName: '',
                phone:'',
    			email: '',
                country: '',
                city: ''
            },
            editPass:{
                oldPassword: '',
                newPassword: '',
                confirmPassword: ''
            }
        }
    },

    methods : {
        clickEditModel(){
            this.openEditModal = true
            let obj = this.userData
            let objt = {
				id : obj.id,
                firstName: obj.firstName,
                lastName: obj.lastName,
                phone: obj.phone,
    			email: obj.email,
                country: obj.country,
                city: obj.city
			}
            // let obj = this.userData
            // console.log('yes', this.objt)
			this.editData = objt
			// this.index = index
        },
        
    	async editProfile(){
            if(this.editData.firstName.trim()=='') return this.e('First name is required!')
    		if(this.editData.lastName.trim()=='') return this.e('Last name is required!')
    		if(this.editData.email.trim()=='') return this.e('Email is required!')
    		if(this.editData.phone.trim()=='') return this.e('Phone is required!')
    		if(this.editData.country=='') return this.e('Country is required!')
            if(this.editData.city.trim()=='') return this.e('City is required!')

            // this.data.id = this.$store.state.user.id
            
            const res = await this.callApi('post', 'app/edit_profile', this.editData)
            this.isAdding=true
            if(res.status===200){
                // this.curUser.unshift(res.data)
                this.$store.commit('updateUser', res.data)
                this.s('Profile image upload has been added successfully!')
                // this.data.coverPic = ''
                // this.$refs.coverUploads.clearFiles()
                this.openEditModal = false
            }else{
                if (res.status == 422) {
                    if (res.data.errors.coverPic) {
                        this.e(res.data.errors.coverPic[0])
                    }
                }else{
                    this.swr()
                }
            }
            
            this.isAdding=false
        },

        async editPassword(){
            if(this.editPass.oldPassword=='') return this.e('Old password is required!')
            if(this.editPass.newPassword=='') return this.e('New password is required!')
    		if(this.editPass.confirmPassword=='') return this.e('Confirm password is required!')
            if(this.editPass.newPassword != this.editPass.confirmPassword){
                this.i("The password confirmation does not match!");
                return;
            }
            // console.log('yes')
            delete this.editPass.confirmPassword;
            this.confirmPassword == ''
            
            this.isLogging = true

            // this.editPass.email = this.ver_email.email

            const res = await this.callApi('post', 'app/edit_password', this.editPass)
            if(res.status===200){
                this.s('Password has been changed successfully');
                this.editPasswordModal = false
                this.editPass.oldPassword = ''
                this.editPass.newPassword = ''
                this.editPass.confirmPassword = ''
            }else{
                if(res.status===401){
                    this.i(res.data.msg)
                }else if(res.status==422){
                    this.i(res.data.msg)
                }else{
                    this.swr()
                }
            }
            this.isLogging = false
        }
    },

    computed: {
    	...mapGetters({
    		'userData' : 'getUser'
    	})
    },
};	
</script>