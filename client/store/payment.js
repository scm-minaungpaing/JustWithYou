export const namespaced = true

export const state = () => {
  return {
  }
}

export const mutations = {

}

export const actions = {
  async paymentRegister({}, data) {
    await this.$axios.$post('/register', data)
  },
}
