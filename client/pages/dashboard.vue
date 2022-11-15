<template>
  <div>
    <b-container class="mt-2">
      <div class="d-flex justify-content-between">
        <div>
          <img :src="adminImg" alt="admin" width="50" class="mr-2"/>
          Welcome {{ $auth.user.name }}
        </div>
        <div>
          <b-button v-b-modal.modal-1
            ><i class="fa fa-plus"></i> Register</b-button
          >
          <b-modal id="modal-1" title="Register New Admin" hide-footer>
            <b-form @submit.prevent="register">

              <b-form-group id="input-group-1" label="K-Pay:" label-for="kpay">
                <b-form-input
                  id="kpay"
                  v-model="payment.kpay"
                  type="text"
                  placeholder="Enter K-Pay number"
                  autocomplete="off"
                  required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-2" label="Wave:" label-for="wave">
                <b-form-input
                  id="wave"
                  v-model="payment.wave"
                  type="text"
                  autocomplete="off"
                  placeholder="Enter Wave number"
                  required
                ></b-form-input>
              </b-form-group>

              <b-form-group
                id="input-group-1"
                label="CB-Pay:"
                label-for="cbpay"
              >
                <b-form-input
                  id="cbpay"
                  v-model="payment.cbpay"
                  type="text"
                  placeholder="Enter CB-Pay number"
                  autocomplete="off"
                  required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-2" label="OK$:" label-for="ok">
                <b-form-input
                  id="ok"
                  v-model="payment.ok"
                  type="text"
                  placeholder="Enter Ok$ number"
                  autocomplete="off"
                  required
                ></b-form-input>
              </b-form-group>
              <b-button type="submit" variant="primary" class="w-100"
                >Register</b-button
              >
            </b-form>
          </b-modal>
        </div>
      </div>
      <div>
        <b-form @submit.prevent="adminRegister">
            <b-form-group
              id="input-group-1"
              label="Admin Name:"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                v-model="admin.name"
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
                v-model="admin.password"
                type="password"
                placeholder="Enter Password"
                required
              ></b-form-input>
            </b-form-group>
            <b-button type="submit" variant="primary" class="w-100">Submit</b-button>
          </b-form>
      </div>
    </b-container>
  </div>
</template>

<script>
export default {
  layout: "adminLayout",
  data() {
    return {
      adminImg: require("@/assets/img/admin.svg"),
      payment: {
        kpay: null,
        wave: null,
        cbpay: null,
        ok: null,
      },
      admin: {
        name: null,
        password: null
      }
    };
  },
  methods: {
    register() {
      console.log(this.payment)
      this.$bvModal.hide('modal-1')
      this.payment = {}
    },
    adminRegister() {
      console.log(this.admin)
    }
  }
};
</script>

<style>
</style>
