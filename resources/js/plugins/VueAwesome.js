import Vue from 'vue';
import Icon from 'vue-awesome/components/Icon'

/**
 * V-Icon
 * https://github.com/Justineo/vue-awesome
 */
// only import the icons you use to reduce bundle size
import 'vue-awesome/icons/spinner'
import 'vue-awesome/icons/caret-down'
import 'vue-awesome/icons/envelope'
import 'vue-awesome/icons/check-circle'
import 'vue-awesome/icons/search'
import 'vue-awesome/icons/arrow-left'
import 'vue-awesome/icons/arrow-right'
import 'vue-awesome/icons/arrow-circle-up'
import 'vue-awesome/icons/caret-right'
import 'vue-awesome/icons/at'
import 'vue-awesome/icons/phone-volume'
import 'vue-awesome/icons/map-marker-alt'

// or import all icons if you don't care about bundle size
// import 'vue-awesome/icons'


Vue.component('v-icon', Icon);
