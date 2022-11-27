export const namespaced = true

export const state = () => {
  return {
  }
}

export const mutations = {

}

export const actions = {
  async paymentRegister({}, data) {
    const res = await this.$axios.$post('/api/payment', data)
    return res
  },
}
