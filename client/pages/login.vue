<template>
  <div>
    <b-container class="bv-example-row">
      <b-row class="justify-content-md-center">
        <b-col col lg="5" md="8">
          <h1>Admin Login</h1>
          <b-form @submit.prevent="onSubmit">
            <b-form-group
              id="input-group-1"
              label="Username:"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                v-model="form.name"
                type="text"
                placeholder="Enter name"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-2"
              label="Password:"
              label-for="input-2"
            >
              <b-form-input
                id="input-2"
                v-model="form.password"
                type="password"
                placeholder="Enter Password"
                required
              ></b-form-input>
            </b-form-group>
            <b-button type="submit" variant="primary" class="w-100">Submit</b-button>
          </b-form>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>

export default {
  data() {
    return {
      form: {
        name: "",
        password: "",
      },
    };
  },
  methods: {
    onSubmit() {
      this.$auth
        .loginWith("laravelSanctum", {
          data: this.form,
        })
        .then(() => {
          this.$toast.success("Hello!");
          this.$router.push("/dashboard");
        })
        .catch(() => {
          this.$toast.error("Login failed!");
        } );
    },
  },
};
</script>

<style>
h1 {
  padding: 40px 0;
  text-align: center;
}
</style>
