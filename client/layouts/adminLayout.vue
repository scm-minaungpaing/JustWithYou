<template>
  <div>
    <div>
      <b-navbar toggleable="lg" type="dark" variant="info">
        <b-container>
          <b-navbar-brand to="/"><i class="fa fa-home"></i> Home</b-navbar-brand>

          <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

          <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
              <b-nav-item><NuxtLink to="/dashboard">Dashboard</NuxtLink></b-nav-item>
              <b-nav-item><NuxtLink to="/schedule">Schedule</NuxtLink></b-nav-item>
            </b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav v-if="$auth.user" class="ml-auto">
              <b-nav-item-dropdown right>
                <template #button-content>
                  <i class="fa fa-user"></i> {{ $auth.user.name }}
                </template>
                <b-dropdown-item href="#">Profile</b-dropdown-item>
                <b-dropdown-item @click="logout">Sign Out</b-dropdown-item>
              </b-nav-item-dropdown>
            </b-navbar-nav>

            <b-navbar-nav v-else class="ml-auto">
              <b-nav-item to="/login">Login</b-nav-item>
            </b-navbar-nav>
          </b-collapse>
        </b-container>
      </b-navbar>
    </div>
    <Nuxt />
  </div>
</template>

<script>
export default {
  name: "adminLayout",
  methods: {
    async logout() {
      try {
        await this.$auth.logout();
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style scoped>
.navbar-brand a{
  text-decoration: none;
  color: #fff;
  text-transform: uppercase;
  font-weight: bold;
}
.nav-link a {
  text-decoration: none;
  color: #fff;
}
</style>
