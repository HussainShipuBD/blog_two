<template>
    <div>
        <div class="_dash_content">
            <div v-for="(item, index) in singleEvent" :key="index">hk</div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data(){
        return{
            singleEvent: {},
            eventSpeakars: {}
        }
    },

    methods:{
        
    },

    computed: {
    	...mapGetters({
    		// 'eventData' : 'getEvent'
    	})
    },

    async created(){
        if(!this.$route.params.id){
            return $router.push('/')
        }
        // console.log('yes', this.$route.params.id)
        const res = await this.callApi('get', `/app/single_events/${ this.$route.params.id }`, this.data)

        if (res.status === 200) {
            this.singleEvent = res.data
        
        }else{
            this.swr()
        }

        // console.log('yes', this.$route.params.id)
        const res2 = await this.callApi('get', `/app/get_eventsSpeakers/${ this.$route.params.id }`, this.data)

        if (res2.status === 200) {
            this.eventSpeakars = res2.data
        
        }else{
            this.swr()
        }
    }
}
</script>