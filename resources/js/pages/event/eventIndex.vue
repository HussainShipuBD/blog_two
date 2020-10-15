<template>
    <div>
        <div class="_dash_content">
            <div class="_dash_top">
                <h2 class="_dash_top_title">Events</h2>

                <router-link to="/addEvent" class="_btn1" type="button">Add Events</router-link>
            </div>

            <div class="_dash_events_cards">
                <div class="row">
                    <!-- Items -->
                    <router-link v-for="(item, index) in events" :key="index" :to="`/event/${item.id}`" class="col-12 col-md-4 col-lg-4">
                        <div class="_slider_card1 _box_shdw1">
                            <div class="_slider_card1_top">
                                <img v-if="item.image" :src="item.image" alt="image">
                                <div class="card_edit"><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="_slider_card1_btm">
                                <h4 class="_slider_card1_btm_h4 _title2">
                                    {{ item.title }}
                                </h4>
                                <ul class="_slider_card1_ul">
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ item.loction }}
                                    </li>
                                    <li>
                                        <i class="far fa-calendar-alt"></i>
                                        {{ item.time }}
                                    </li>
                                </ul>
                                

                                <div class="_card_bottom">
                                    <ul class="_card_bottom_list">
                                        <li><i class="fas fa-user-friends"></i> 200</li>
                                        <li><i class="fas fa-bullhorn"></i> 20</li>
                                        <li><i class="fas fa-microphone"></i> 3</li>
                                    </ul>

                                    <div class="_card_bottom_button">
                                        <button class="_btn3 _btn_sm" type="button">ACTIVE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                    <!-- Items -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
    	return {
    		events: []
    	}
    },

    methods:{
        
    },

    async created(){
        const res = await this.callApi('get', 'app/get_events', this.formData)

        if (res.status === 200) {
            this.events = res.data
            this.$store.commit('setEvent', this.events)
        }else{
            this.swr()
        }
    }
}
</script>
