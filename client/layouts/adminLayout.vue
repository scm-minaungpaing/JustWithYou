<template>
  <div>
    <NuxtLink to="/">Home</NuxtLink> |
    <NuxtLink to="/dashboard">Dashboard</NuxtLink> |
    <NuxtLink v-show="!$auth.user" to="/login">Login</NuxtLink> |
    <a v-show="$auth.user" href="#" @click="logout">Logout</a>
    <Nuxt/>
  </div>
</template>

<script>
export default {
  name: "adminLayout",
  methods: {
    async logout() {
      try {
        await this.$auth.logout()
      } catch ( error ) {
        console.log(error)
      }
    }
  }
}
</script>

<style>

</style>
