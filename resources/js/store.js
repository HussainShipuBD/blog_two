import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
	state : {
		user : false,
		userData: {},
		eventData: [],
		eventDataId: '',
		eventDetails: {},
		eventsSpeakers: [],
		eventsSponsors: []
	},

	getters: {
		getAuthUser( state ){
			return state.user
		},

		getUser( state ){
			return state.userData
		},

		getEvent( state ){
			return state.eventData
		},

		getEventId( state ){
			return state.eventDataId
		},

		getEventDetails( state ){
			return state.eventDetails
		},

		getEventsSpeakers( state ){
			return state.eventsSpeakers
		},

		getEventsSponsors( state ){
			return state.eventsSponsors
		}
	},

	mutations: {
		setUser(state, data){
            state.userData = data
		},
		
		updateUser(state, data){
            state.userData = data
		},
		
		setEvent(state, data){
            state.eventData = data
		},
		
		setEventId(state, data){
            state.eventDataId = data
		},
		
		setEventDetails(state, data){
            state.eventDetails = data
		},
		
		setEventsSpeakers(state, data){
            state.eventsSpeakers = data
		},
		
		setEventsSponsors(state, data){
            state.eventsSponsors = data
		},

		setPushSponsor(state, data){
			state.eventsSponsors.push(data) 
		},

		setPushSpeker(state, data){
			state.eventsSpeakers.push(data) 
		}
	},

	actions: {
		
	}
})