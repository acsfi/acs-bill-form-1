<template>
    <div>
        <header >
            <video playsinline="playsinline" muted  autoplay loop src="https://aurorachristianschool.com/storage/acsv.mp4"></video>
        </header>

    </div>
</template>

<script>
  export default {
    data() {
      return {
        slide: 0,
        sliding: null
      }
    },
    methods: {
      onSlideStart(slide) {
        this.sliding = true
      },
      onSlideEnd(slide) {
        this.sliding = false
      }
    }
  }
</script>
