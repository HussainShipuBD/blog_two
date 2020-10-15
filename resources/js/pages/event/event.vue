<template>
    <div>
        <div class="_dash_content">
            <div class="_list_menu">
                <li><router-link to="/eventIndex">Events</router-link></li>
                <li class="_active"><a>{{ eventName }} </a></li>
            </div>

            <div class="_dashSpeaker_card _box_shdw1">
                <div class="_dashSpeaker_menu">
                    <ul class="_dashSpeaker_menu_list">
                        <li :class="(tab==1)?'_active':''" @click="tab=1">Details</li>
                        <li :class="(tab==2)?'_active':''" @click="tab=2">Participants</li>
                        <li :class="(tab==3)?'_active':''" @click="tab=3">Sponsors</li>
                        <li :class="(tab==4)?'_active':''" @click="tab=4">Speakers</li>
                    </ul>
                </div>

                <!-- details -->
                <Details v-if="tab==1"/>
                <!-- details -->

                <!-- Participants -->
                <Participants  v-if="tab==2"/>
                <!-- Participants -->

                <!-- Speakers -->
                <Speakers v-if="tab==4"/>
                <!-- Speakers -->

                <!-- Sponsers -->
                <Sponsors  v-if="tab==3"/>
                <!-- Sponsers -->
            </div>

            <div class="_dash_event_delete">
                <button class="_dash_event_delete_btn"><i class="fas fa-trash"></i> <span>Delete this event</span></button>
            </div>
        </div>
    </div>
</template>

<script>
import Details from '../../components/event/details.vue'
import Participants from '../../components/event/participants.vue'
import Sponsors from '../../components/event/sponsors.vue'
import Speakers from '../../components/event/speakers.vue'

export default {
    components:{
        Details,
        Participants,
        Sponsors,
        Speakers
    },

    data(){
        return{
            tab:1,
            eventName: ''
        }
    },

    async created(){
        if(!this.$route.params.id){
            return $router.push('/')
        }
        
        // console.log('yes', this.$route.params.id)
        
        const [res, resSpeakar, resSponsor] = await Promise.all([
            this.callApi('get', `/app/single_events/${ this.$route.params.id }`, this.data),
            this.callApi('get', `/app/get_eventsSpeakers/${ this.$route.params.id }`, this.data),
            this.callApi('get', `/app/get_eventsSponsors/${ this.$route.params.id }`, this.data)
        ])

        if (res.status === 200) {
            this.$store.commit('setEventDetails', res.data)
            this.eventName = res.data.title
        }else{
            this.swr()
        }

        if (resSpeakar.status === 200) {
            // this.eventSpeakars = resSpeakar.data
            this.$store.commit('setEventsSpeakers', resSpeakar.data)
        }else{
            this.swr()
        }

        if (resSponsor.status === 200) {
            // this.eventSponsors = resSponsor.data
            this.$store.commit('setEventsSponsors', resSponsor.data)
        }else{
            this.swr()
        }
    }
}
</script>
