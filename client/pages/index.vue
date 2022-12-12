<template>
  <div>
    Hello from Client!
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  layout: 'adminLayout',
  name: 'IndexPage',
  auth: false,

  methods: {
    ...mapActions({
      getDates: "schedule/getSchedule",
    })
  },
  mounted() {
    const data = {
      month: 12,
      year: 2022
    }
    this.getDates(data)
  }
}
</script>
