<template>
    <div>
        <div class="_dashSpeaker_main">
            <!-- <div class="_dash_top">
                <h2 class="_dash_top_title">Sponsors</h2>

                <button class="_btn1" type="button">Add Sponsors</button>
            </div> -->

            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="_cvent_form_main">
                        <h2 class="_title2 _mar_b30">Add new event details.</h2>

                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Event title <span>*</span></p>

                                    <input v-model="data.title" class="_1int" type="text" placeholder="Type event title">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Event description <span>*</span></p>

                                    <input v-model="data.description" class="_1int" type="text" placeholder="Type event description">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Event time <span>*</span></p>

                                    <input v-model="data.time" class="_1int" type="text" placeholder="Type event time">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Event loction <span>*</span></p>

                                    <input v-model="data.locationName" class="_1int" type="text" placeholder="Type event loction">
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">Event loction address</p>

                                    <input v-model="data.loction" class="_1int" type="text" placeholder="Type event loction address">
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-6">
                                <div class="_input_group">
                                    <p class="_1label">About event</p>

                                    <input v-model="data.about" class="_1int" type="text" placeholder="Type about event">
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 _mar_b10">
                                <hr>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="_input_group">
                                    <p class="_1label">Event banner</p>

                                    <div v-show="!data.image">
                                        <Upload
                                            ref="bannerImage"
                                            type="drag"
                                            :headers="{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                                            :on-success="handleSuccess"
                                            :on-error="handleError"
                                            :format="['jpg','jpeg','png']"
                                            :max-size="2048"
                                            :on-format-error="handleFormatError"
                                            :on-exceeded-size="handleMaxSize" 
                                            action="/app/upload">
                                            <div style="padding: 50px 0">
                                                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                                <p>Upload your profile image.</p>
                                            </div>
                                        </Upload>
                                    </div>

                                    <br>

                                    <div v-if="data.image"  class="demo-upload-list _mar_b15">
                                        <template>
                                            <img :src="`${data.image}`">
                                            <div class="demo-upload-list-cover">
                                                <Icon type="ios-trash-outline" @click="deleteImage"></Icon>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12">
                                <p class="after">After register, I agree with <a class="_1link" href=""><strong>terms &amp; condition</strong></a> of Africa Forward</p>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="_group_button">
                                    <button @click="addEventDetails" class="_btn3" type="button" :disable="isLoading">Submit</button>
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
    data(){
        return{
            isLoading: false,
            data:{
                image: '',
                title: '',
                description: '',
                time: '',
                loction: '',
                locationName: '',
                about: ''
            },
            token: '',
            shipu: {}
        }
    },

    methods : {
        async addEventDetails(){
            if(this.data.title.trim()=='') return this.e('Title is required')
            if(this.data.description.trim()=='') return this.e('Description is required')
            if(this.data.time.trim()=='') return this.e('Time is required')
            if(this.data.loction.trim()=='') return this.e('Location is required')
            if(this.data.locationName.trim()=='') return this.e('Location address is required')
            if(this.data.about.trim()=='') return this.e('About is required')
            if(this.data.image.trim()=='') return this.e('About is required')
            // query: { plan: 'private' }
            
            const res = await this.callApi('post', '/app/add_eventDetails', this.data)
            
            this.isLoading=true
            
			if(res.status===201){
                // this.schoolData.unshift(res.data)
                
                this.s('Event has been added successfully!')

                this.$refs.bannerImage.clearFiles()
                
                // this.$route.push(`/addEvent?id=${res.data.id}`)
                this.$store.commit('setEventId', res.data.id)

                // console.log('new', res.data.id)

				this.data.title = ''
				this.data.description = ''
				this.data.time = ''
				this.data.loction = ''
				this.data.locationName = ''
				this.data.about = ''
			}else{
				if (res.status == 422) {
					for(let i in res.data.errors){
                        this.e(res.data.errors[i][0])
                    }
				}else{
					this.swr()
				}
            }

            this.isLoading=false
        },

        handleSuccess (res, file) {
            res = `/uploads/${res}`
            this.data.image = res
        },

        handleError (res, file) {
            // console.log('res', res)
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: `${file.errors.file.length ? file.errors.file[0] : "Something went wrong!"}`
            });
        },

        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },

        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit ',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },

        async deleteImage(){
            let image  = this.data.image
            this.data.image = ''
            this.$refs.bannerImage.clearFiles()
            
            const res = await this.callApi("post", "app/delete_image", {imageName: image});
            if (res.status != 200) {
                this.data.proPic = image;
                this.swr();
            }
        },
    },

    created(){
      this.token = window.Laravel.csrfToken;
    }
}
</script>

<style scoped>
.demo-upload-list{
    display: block;
    width: 100%;
    height: auto;
    text-align: center;
    line-height: 60px;
    border: 1px solid transparent;
    border-radius: 4px;
    overflow: hidden;
    background: #fff;
    position: relative;
    box-shadow: 0 1px 1px rgba(0,0,0,.2);
    margin-right: 4px;
}
.demo-upload-list img{
    width: 100%;
    height: 100%;
}
.demo-upload-list-cover{
    display: none;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,.6);
}
.demo-upload-list:hover .demo-upload-list-cover{
    display: block;
}
.demo-upload-list-cover i{
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    margin: 0 2px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>