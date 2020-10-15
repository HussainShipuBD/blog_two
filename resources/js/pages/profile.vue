<template>
    <div>
        <div class="_profilePage _2content">
            <!-- Benner -->
            <Banner/>
            <!-- Benner -->

            <!-- Menu -->
            <div class="_1box_shadow _mar_b20">
                <div class="_my_container">
                    <div class="_profilePage_details_menu">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <ul class="_profilePage_details_menu_list">
                                    <li @click="selectTab(1)">
                                        <a>Timeline</a>
                                    </li>
                                    <li  @click="selectTab(2)" :class="(about == true) ? '_active' : ''">
                                        <a>About</a>
                                    </li>
                                    <li @click="selectTab(3)" :class="(photos == true) ? '_active' : ''">
                                        <a>Photoes</a>
                                    </li>
                                    <li @click="selectTab(4)">
                                        <a>Friends</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-12 col-md-auto col-lg-auto">
                                <ul class="_profilePage_details_menu_button">
                                    <li>
                                        <button class="_pre_icon" type="button"><i class="fas fa-pen"></i> Edit Profile</button>
                                    </li>
                                    <li>
                                        <button type="button"><i class="fas fa-eye"></i></button>
                                    </li>
                                    <li>
                                        <button type="button"><i class="fas fa-ellipsis-h"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Menu -->

            <!-- Feed -->
            <div class="_profilePage_feed">
                <div class="_my_container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-11 col-lg-11">
                            <!-- About -->
                            <div v-if="about" class="_mar_b20">
                                <About/>
                            </div>
                            <!-- About -->

                            <!-- Photos -->
                            <div  v-if="photos" class="pro_card _1box_shadow _b_r _mar_b20 _padd_20">
                                <Photos/>
                            </div>
                            <!-- Photos -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feed -->
        </div>
    </div>
</template>

<script>
    import Photos from '../components/profile/photos.vue'
    import Banner from '../components/profile/banner.vue'
    import About from '../components/profile/about.vue'

    export default {
        components: {
          Banner,
          Photos,
          About
        },

        data() {
            return {
             about: false,
             photos: true
            }
        },

        methods: {
          selectTab(tab) {
            // // if (
            // //   this.tab != "overview" &&
            // //   this.tab != "work" &&
            // //   this.tab != "places" &&
            // //   this.tab != "contact"
            // // ) {
            // //   this.tab = "overview";
            // // }
            if(tab==1){
              
            }else if(tab==2){
              this.about = true
              this.photos = false
            }else if(tab==3){
              this.about = false
              this.photos = true
            }
            //else if(tab=='places'){
            //   this.tab = tab
            // }
            // return (this.tab = tab);
          }
        }
    };
</script>
