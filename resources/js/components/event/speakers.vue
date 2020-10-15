<template>
    <div>
        <div class="_dashSpeaker_main">
            <div class="_dash_top">
                <h2 class="_dash_top_title">Speakers</h2>

                <button @click="showAddModal" class="_btn1" type="button">Add Speakers</button>
            </div>

            <div class="_dashSpeaker_table_main">
                <table class="_dashSpeaker_table">
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Profession</th>
                        <th></th>
                    </tr>

                    <!-- Items -->
                    <tr v-for="(item, index) in eventSpeakars" :key="index">
                        <td style="width:28px">{{ index+1 }}</td>

                        <td  style="width:40px;">
                            <div class="table_name">
                                <img v-if="item.image" class="table_img" :src="item.image" alt="" title="">
                            </div>
                        </td>

                        <td>{{ item.name }}</td>
                        <td>{{ item.profession }}</td>
                        <td>
                            <button @click="showEditModal(item, index)" class="_icon_btn" type="button"><i class="fas fa-pen"></i></button>
                            <button class="_icon_btn" type="button"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Items -->
                </table>
            </div>
        </div>

        <!-- Add modal -->
		<Modal
        v-model="addModal"
        title="Add speaker"
        @closable="false">
        	<div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="_input_group">
                        <p class="_1label">Skeaker Name <span>*</span></p>

                        <input v-model="data.name" class="_1int" type="text" placeholder="Type skeaker name">
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="_input_group">
                        <p class="_1label">Skeaker profession <span>*</span></p>

                        <input v-model="data.profession" class="_1int" type="text" placeholder="Type skeaker name">
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12 _mar_b10">
                    <hr>
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="_input_group">
                        <p class="_1label">Skeaker image <span>*</span></p>

                        <div v-show="!data.image">
                            <Upload
                                ref="addSpeakerImage"
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
                                    <p>Upload speaker image.</p>
                                </div>
                            </Upload>
                        </div>

                        <div v-if="data.image"  class="demo-upload-list _mar_t15">
                            <template>
                                <img :src="`${data.image}`">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-trash-outline" @click="deleteImage( false )"></Icon>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

	        <div slot="footer">
	        	<button @click="closeAddModal" class="_btn1">Close</Button>
                <button @click="addEventSpeakers" class="_btn3" :disable="isLoading" type="button">Submit</button>
	        </div>
	    </Modal>
	    <!-- Add modal -->

        <!-- Edit modal -->
		<Modal
        v-model="editModal"
        title="Edit speaker"
        @closable="false">
        	<div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="_input_group">
                        <p class="_1label">Skeaker Name <span>*</span></p>

                        <input v-model="editData.name" class="_1int" type="text" placeholder="Type skeaker name">
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="_input_group">
                        <p class="_1label">Skeaker profession <span>*</span></p>

                        <input v-model="editData.profession" class="_1int" type="text" placeholder="Type skeaker name">
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12 _mar_b10">
                    <hr>
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="_input_group">
                        <p class="_1label">Skeaker image <span>*</span></p>

                        <div v-show="!editData.image">
                            <Upload
                                ref="sponsorsImage"
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
                                    <p>Upload speaker image.</p>
                                </div>
                            </Upload>
                        </div>

                        <div v-if="editData.image"  class="demo-upload-list _mar_t15">
                            <template>
                                <img :src="`${editData.image}`">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-trash-outline" @click="deleteImage( true )"></Icon>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

	        <div slot="footer">
	        	<button @click="closeEditModal" class="_btn1">Close</Button>
                <button @click="editEventSpeaker" class="_btn3" :disable="isLoading" type="button">Submit</button>
	        </div>
	    </Modal>
	    <!-- Edit modal -->
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data(){
        return{
            addModal: false,
            editModal: false,
            deleteModal: false,
            isLoading: false,
            data: {
                name: '',
                image: '',
                event_id: '',
                profession: ''
            },
            editData: {
                name: '',
                image: '',
                profession: ''
            },
            isEditItem: false,
            isLoading: false, 
            isAddImage: false,
            index: -1,
            token: ''
        }
    },

    methods:{
        async addEventSpeakers(){
            if(this.data.name.trim()=='') return this.e('Speaker name is required')
            if(this.data.profession.trim()=='') return this.e('Profession is required')
            if(this.data.image.trim()=='') return this.e('Speaker image is required')
            this.isLoading = true
            this.data.event_id = this.$route.params.id
            const res = await this.callApi('post', '/app/add_newEventSpeaker', this.data)
            if(res.status===201){
                this.s('Speaker has been added successfully!')
                this.$store.commit('setPushSpeker', res.data)
                this.addModal = false
                this.isAddImage = false
                this.data.name = ''
                this.data.image = ''
                this.data.profession = ''
            }else{
                if (res.status == 422) {
                    for(let i in res.data.errors){
                        this.e(res.data.errors[i][0])
                    }
                }else{
                    this.swr()
                }
            }
            this.isLoading = false
        },

        showAddModal(){
            this.addModal = true
            this.isAddImage = true
        },

        closeAddModal(){
            this.isAddImage = false
            this.addModal = false
        },

        async editEventSpeaker(){
            if(this.editData.name.trim()=='') return this.e('Speaker name is required')
            if(this.editData.profession.trim()=='') return this.e('Profession is required')
            if(this.editData.image.trim()=='') return this.e('Speaker image is required')
            this.isLoading = true
            const res = await this.callApi('post', '/app/edit_eventSpeaker', this.editData)
            if(res.status===200){
                this.s('Speaker has been edited successfully!')
                this.eventSpeakars[this.index] = res.data
                // this.$store.commit('setEditSponsors', res.data)
                this.editData.name = ''
                this.editData.image = ''
                this.editData.profession = ''
                this.editModal = false
                this.isEditItem = false
            }else{
                if (res.status == 422) {
                    for(let i in res.data.errors){
                        this.e(res.data.errors[i][0])
                    }
                }else{
                    this.swr()
                }
            }
            this.isLoading = false
        },

        showEditModal( item, index ){
            let obj = {
                id : item.id,
                name : item.name,
                profession : item.profession,
                image : item.image
            }
            this.editData = obj
            this.editModal = true
            this.isEditItem = true
            this.index = index
        },

        closeEditModal(){
            this.isEditItem = false
            this.editModal = false
        },

        handleSuccess (res, file) {
            res = `/uploads/${res}`
            if (this.isEditItem) {
                this.editData.image = res
            }
            if( this.isAddImage ){
                this.data.image = res
            }
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

        async deleteImage( isAdd ){
            let image
            
            if( isAdd == false ){
                image = this.data.image
                this.data.image = ''
                this.$refs.addSpeakerImage.clearFiles()
                const res = await this.callApi("post", "/app/delete_image", {imageName: image});

                if (res.status != 200) {
                    this.data.image = image;
                    this.swr();
                }
            }

            if ( isAdd == true ) {
                image = this.editData.image
                this.editData.image = ''
                this.$refs.sponsorsImage.clearFiles()
            }
        },
    },

    async created(){
        this.token = window.Laravel.csrfToken;
    },
    
    computed: {
    	...mapGetters({
            'eventSpeakars' : 'getEventsSpeakers'
    	}),
    },
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