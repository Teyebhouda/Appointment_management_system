<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

import Hero from '@/Components/Front/Hero.vue'
import HowItWork from '@/Components/Front/HowItWork.vue'
import Navbar from '@/Components/Front/Navbar.vue'
import Services from '@/Components/Front/Services.vue'
import Team from '@/Components/Front/Team.vue'
import Footer from '@/Components/Front/Footer.vue'
import AboutUs from '@/Components/Front/AboutUs.vue'
import Testimonials from '@/Components/Front/Testimonials.vue'


const page = usePage()
const sections = computed(() => page.props.sections)


// Expose chaque section content en computed avec fallback vide
const heroContent = computed(() => sections.value.hero?.content || {})
const howItWorkContent = computed(() => sections.value.howItWork?.content || {})
const servicesContent = computed(() => sections.value.services?.content || {})
const teamContent = computed(() => sections.value.team?.content || {})
const footerContent = computed(() => sections.value.footer?.content || {})
const Aboutuscontent = computed(() => sections.value.aboutUs?.content || {})
console.log('sections', JSON.parse(JSON.stringify(sections.value)))
</script>

<template>
  <Navbar />
  <Hero :content="heroContent" />
  <AboutUs />
<HowItWork :content="howItWorkContent" />
<Services :content="servicesContent" />
<Testimonials />
<!--<Team :content="teamContent" />-->
<Footer :content="footerContent" />


</template>
