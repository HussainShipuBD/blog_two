<template>
    <div>
        <div class="_dashSpeaker_details _dashSpeaker_details_alls">
            <div class="_dashSpeaker_banner">
                <div class="_2banner">
                    <img class="_2banner_img" v-if="eventDetails.image" :src="eventDetails.image" alt="" title="">

                    <div class="_2banner_edit">
                        <button class="_btn1" type="button"><i class="fas fa-pen"></i> Edit Events</button>
                    </div>
                    
                    <div class="_2banner_main">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <h2 class="_2banner_title">{{ eventDetails.title }}</h2>

                                    <p class="_2banner_text">{{ eventDetails.description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="_2banner_bottom">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <ul class="_2banner_bottom_dates">
                                        <li>
                                            <i class="far fa-calendar-alt"></i>
                                            {{ eventDetails.time }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <ul class="_2banner_bottom_dates">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ eventDetails.loction }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="_event_about">
                <div class="">
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-8">
                            <h2 class="_title1 _mar_b25">About this event</h2>

                            <p class="_event_about_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>


                            <p class="_event_about_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>

                            <p class="_event_about_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
                        </div>

                        <div class="col-12 col-md-4 col-lg-4">
                            <h2 class="_title1 _mar_b25">Event Location</h2>

                            <div class="loca_map">
                                <img src="/uploads/map.jpg" alt="" title="">
                            </div>

                            <p class="loca_map_add">{{ eventDetails.locationName }}</p>
                            <p class="loca_map_name">{{ eventDetails.loction }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="_event_speakers">
                <div class="">
                    <h2 class="_title1 _mar_b25">Speakers</h2>

                    <div v-if="!eventSpeakars.length > 0 " class="_no_items">
                        <p class="_no_items_text">There has no Speakers.</p>
                    </div>

                    <div v-else class="row">
                        <!-- Items -->
                        <div v-for="(item, index) in eventSpeakars" :key="index" class="col-12 col-md-3 col-lg-3">
                            <div class="_1card">
                                <div class="_1card_pic">
                                    <img v-if="item.image" class="_1card_img" :src="item.image" alt="" title="">
                                </div>

                                <div class="_1card_details">
                                    <p class="_1card_name">{{ item.name }}</p>
                                    <p class="_1card_pre">{{ item.profession }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Items -->
                    </div>
                </div>
            </div>

            <div class="_event_program">
                <div class="">
                    <h2 class="_title1 _mar_b25">Program</h2>

                    <div class="_event_program_main">
                        <ul class="_event_program_menu">
                            <li class="_active">Day 1</li>
                            <li>Day 2</li>
                            <li>Day 3</li>
                        </ul>

                        <div class="_event_program_details">
                            <!-- Items -->
                            <div class="_event_program_items">
                                <p class="_event_program_date">09:00</p>

                                <p class="_event_program_text">Opening Hackaton</p>
                            </div>
                            <!-- Items -->

                            <!-- Items -->
                            <div class="_event_program_items">
                                <p class="_event_program_date">10:00</p>

                                <p class="_event_program_text">Introducing Hack 2020 Professional Programmer Revolution</p>
                            </div>
                            <!-- Items -->

                            <!-- Items -->
                            <div class="_event_program_items">
                                <p class="_event_program_date">12:00</p>

                                <p class="_event_program_text">Coffee Break</p>
                            </div>
                            <!-- Items -->

                            <!-- Items -->
                            <div class="_event_program_items">
                                <p class="_event_program_date">13:00</p>

                                <p class="_event_program_text">Speaker #1</p>
                            </div>
                            <!-- Items -->

                            <!-- Items -->
                            <div class="_event_program_items">
                                <p class="_event_program_date">17:00</p>

                                <p class="_event_program_text">Break</p>
                            </div>
                            <!-- Items -->

                            <!-- Items -->
                            <div class="_event_program_items">
                                <p class="_event_program_date">19:00</p>

                                <p class="_event_program_text">Create Landing Page</p>
                            </div>
                            <!-- Items -->

                            <!-- Items -->
                            <div class="_event_program_items">
                                <p class="_event_program_date">22:00</p>

                                <p class="_event_program_text">Closing Day 1</p>
                            </div>
                            <!-- Items -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="_event_sponsors">
                <div class="">
                    <h2 class="_title1 _mar_b25">Sponsors</h2>

                    <div v-if="!eventSponsors.length > 0 " class="_no_items">
                        <p class="_no_items_text">There has no Sponsors.</p>
                    </div>

                    <div v-else class="row">
                        <!-- Items -->
                        <div v-for="(item, index) in eventSponsors" :key="index" class="col-12 col-md-3 col-lg-3">
                            <div class="_sponser_img">
                                <img v-if="item.image" :src="item.image" alt="image">
                                <p class="_1card_name _flex_100 _text_center _mar_t10">{{ item.name }}</p>
                            </div>
                        </div>
                        <!-- Items -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { mapGetters } from "vuex";

export default {
    data(){
        return{
            
        }
    },

    methods:{
        
    },

    async created(){
        
    },
    
    computed: {
    	...mapGetters({
    		'eventDetails' : 'getEventDetails',
            'eventSpeakars' : 'getEventsSpeakers',
            'eventSponsors' : 'getEventsSponsors'
    	}),
    },
}
</script>