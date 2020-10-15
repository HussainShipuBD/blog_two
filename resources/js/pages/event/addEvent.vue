<template>
    <div>
        <div class="_dash_content">
            <div class="_list_menu">
                <li><router-link to="/eventIndex">Events</router-link></li>
                <li class="_active"><a href="">Hack 2020 Professional Programmer Revolution</a></li>
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
                <Participants v-if="tab==2"/>
                <!-- Participants -->

                <!-- Sponsers -->
                <Sponsors v-if="tab==3"/>
                <!-- Sponsers -->

                <!-- Speakers -->
                <Speakers v-if="tab==4"/>
                <!-- Speakers -->
            </div>

            <div class="_dash_event_delete">
                <button class="_dash_event_delete_btn"><i class="fas fa-trash"></i> <span>Delete this event</span></button>
            </div>
        </div>
    </div>
</template>

<script>
import Details from '../../components/event/addDetails.vue'
import Participants from '../../components/event/addParticipants.vue'
import Sponsors from '../../components/event/addSponsors.vue'
import Speakers from '../../components/event/addSpeakers.vue'

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
        }
    }
}
</script>
