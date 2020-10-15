<template>
	<div>
    <Header v-if="$route.path  != '/login'"/>
    <Sidebar v-if="$route.path  != '/login'" />
		<transition name="component-fade" mode="out-in">
        <router-view :key="$route.fullPath"></router-view>
    </transition>
	</div>
</template>


<script>
import Header from '../components/header.vue'
import Sidebar from '../components/sidebar.vue'

export default {
    components:{
        Header,
        Sidebar
    },

    data(){
      return{
        token: ''
      }
    },

    methods:{
      async allUser(){
        const res = await this.callApi('get', 'app/get_userData', this.formData)

        if (res.status === 200) {
          this.user = res.data
          this.$store.commit('setUser', this.user)
        }else{
          this.swr()
        }
			}
    },

    created(){
      this.allUser()
      console.log('yes', this.allUser)
      this.token = window.Laravel.csrfToken;
    }
}
</script>
