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
      <!-- Detail -->
      <b-row class="my-4" align-h="between">
        <b-col sm>
          <div class="detial-card">100</div>
        </b-col>
        <b-col sm>
          <div class="detial-card">2</div>
        </b-col>
      </b-row>


      <!-- Table -->
      <h2>Active Payment</h2>
      <b-table striped hover :items="paymentData" :fields="fields" class="mt-4">
        <template #cell(status)="row">
          <toggle :checked="!row.item.status" />
        </template>
      </b-table>
    </b-container>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import Toggle from '@/components/atom/toggle'

export default {
  layout: "adminLayout",
  components: {
    Toggle,
  },
  data() {
    return {
      adminImg: require("@/assets/img/admin.svg"),
      fields: [
        { key: 'adminName', label: 'AdminName', sortable: true, sortDirection: 'desc' },
        { key: 'ph_no', label: 'Phone Number'},
        { key: 'typeName', label: 'Type'},
        { key: 'status', label: 'Status' }
      ],
    };
  },
  computed: {
    ...mapState({
      currentAdmin: state => state.auth.user,
      paymentData: (state) => state.payment.payment
    })
  },
  methods: {
    ...mapActions({
      getPayment: "payment/getPayment"
    })
  },
  async mounted() {
    await this.getPayment()
  }
};
</script>

<style scoped>
a {
  color: #fff;
}
.detial-card {
  border: 1px solid rgb(246, 243, 243);
  border-radius: 10px;
  height: 150px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.75rem;
  box-shadow: 5px 5px 5px rgba(0,0,0,0.1);
  cursor: pointer;
}
</style>
