<template>
  <div>
    <b-container class="mt-2">
      <div class="d-flex justify-content-between">
        <div>
          <img :src="adminImg" alt="admin" width="50" class="mr-2" />
          Welcome {{ $auth.user.name }} <br>
        </div>
        <div v-show="$auth.user.is_admin">
          <b-button to="/register"><i class="fa fa-plus"></i> Register</b-button>
        </div>
      </div>
    </b-container>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  layout: "adminLayout",
  data() {
    return {
      adminImg: require("@/assets/img/admin.svg"),
    };
  },
  computed: {
    ...mapState({
      currentAdmin: state => state.auth.user
    })
  }
};
</script>

<style scoped>
a {
  color: #fff;
}
</style>
