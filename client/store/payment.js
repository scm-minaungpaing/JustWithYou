import Payment from '@/const'
export const namespaced = true

export const state = () => {
  return {
    payment: null
  }
}

export const mutations = {
  setPayment(state, payload) {
    payload.forEach(data => {
      switch (data.type) {
        case 1:
          data.typeName = Payment.paymentType.kpay
          break;
        case 2:
          data.typeName = Payment.paymentType.wave
          break;
        case 3:
          data.typeName = Payment.paymentType.cbpay
          break;
        case 4:
          data.typeName = Payment.paymentType.ok
          break;
      }
    });
    state.payment = payload
  }
}

export const actions = {
  async paymentRegister({}, data) {
    const res = await this.$axios.$post('/api/payment', data)
    return res
  },

  async getPayment({commit}) {
    const res = await this.$axios.$get('/api/payment')
    return commit('setPayment', res.data)

    // await this.$axios.get('/api/payment')
    // .then(
    //   x => {
    //     console.log(x.status)
    //     return x
    //   }
    // )
  }
}
