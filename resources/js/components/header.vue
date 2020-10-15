<template>
    <div>
        <div class="_1deah_menu">
            <div class="_1deah_menu_logo">
                <a href="index.html"><img class="_1deah_menu_img" src="/uploads/logo.png" alt="" title=""></a>
            </div>

            <div class="_1deah_menu_main">
                <router-link :to="`/profile/${authUser.id}`">
                    <div class="_1deah_menu_pro">
                        <img class="_1deah_menu_pro_img" src="/uploads/img3.png" alt="" title="">

                        <p class="_1deah_menu_name">Gatsharan Sangrota</p>

                        <i class="fas fa-angle-down"></i>
                    </div>
                </router-link>
            </div>

            <div class="_sidemenu_button"><i class="fas fa-th-list"></i></div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data() {
        return {
			// routes: [
			// 	// dynamic segments start with a colon
			// 	{ path: '/profile/:id', component: profile, name: 'profile' }
			// ]
        }
    },

    methods : {
       
    },
 	computed: {
    	...mapGetters({
    		'curUser' : 'getCurrentUser',
    		'allRoles' : 'getallRoles'
    	}),
    },
    async created(){
    	// this.token = window.Laravel.csrfToken;
    },

   
};  
</script>