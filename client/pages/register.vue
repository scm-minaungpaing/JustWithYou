<template>
  <b-container class="mt-2">
    <div class="d-flex justify-content-between">
      <h2>Register</h2>
      <div>
        <b-button to="/dashboard"
          ><i class="fa-solid fa-caret-left"></i> Back</b-button
        >
      </div>
    </div>
    <div>
      <b-button v-b-modal.admin-modal
        ><i class="fa fa-plus"></i> Register</b-button
      >
      <b-modal id="admin-modal" title="Register New Admin" hide-footer>
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
          <b-button type="submit" variant="primary" class="w-100"
            >Submit</b-button
          >
        </b-form>
      </b-modal>
      <b-button v-b-modal.payment-modal
        ><i class="fa fa-plus"></i> Payment Register</b-button
      >
      <b-modal id="payment-modal" title="Register New Admin" hide-footer>
        <b-form @submit.prevent="register">
          <b-form-group
            id="input-group-0"
            label="Admin Name:"
            label-for="admin"
          >
            <b-form-select
              id="admin"
              v-model="selected"
              :options="allAdmins"
            ></b-form-select>
          </b-form-group>
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

          <b-form-group id="input-group-3" label="CB-Pay:" label-for="cbpay">
            <b-form-input
              id="cbpay"
              v-model="payment.cbpay"
              type="text"
              placeholder="Enter CB-Pay number"
              autocomplete="off"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-4" label="OK$:" label-for="ok">
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
  </b-container>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  layout: "adminLayout",
  middleware: "admin",
  data() {
    return {
      payment: {
        kpay: null,
        wave: null,
        cbpay: null,
        ok: null,
        admin_id: null,
      },
      admin: {
        name: null,
        password: null,
      },
      selected: null,
      allAdmins: [],
    };
  },
  computed: {
    ...mapState({
      allAdmin: (state) => state.admin.allAdmin,
    }),
  },
  methods: {
    ...mapActions({
      registerAdmin: "admin/register",
      getAllUsers: "admin/getAllUsers",
      registerPayment: "payment/paymentRegister",
    }),
    async register() {
      this.payment.admin_id = this.selected
      const res = await this.registerPayment(this.payment)
      if (res.status === 200) {
        this.$toast.success("Payment added Successfully!")
      }
      else {
        this.$toast.error("Payment register failed!")
      }
      this.payment = {};
      this.selected = null
      this.$bvModal.hide("payment-modal");
    },
    async adminRegister() {
      const res = await this.registerAdmin(this.admin);
      if (res.status === 200) {
        this.allAdmins = []
        await this.setAlladmins()
        this.$toast.success("Admin added Successfully!")
      }
      else {
        this.$toast.error("Admin register failed!")
      }
      this.admin = {};
      this.$bvModal.hide("admin-modal");
    },
    async setAlladmins() {
      await this.getAllUsers();
      this.allAdmins.push({ value: null, text: "Select an admin" })
      this.allAdmin.forEach(x => {
        if (x.is_admin !== 1) {
          this.allAdmins.push({text: x.name, value: x.id})
        }
      });
    }
  },
  async mounted() {
    await this.setAlladmins()
  },
};
</script>

<style>
a {
  color: #fff;
}
a:hover {
  color: #fff;
}
</style>
