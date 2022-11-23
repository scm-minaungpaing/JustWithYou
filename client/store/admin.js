export const namespaced = true

export const state = () => {
  return {
    allAdmin: [],
  }
}

export const mutations = {
  setAllAdmin(state, payload) {
    state.allAdmin = payload
  }
}

export const actions = {
  async register({}, data) {
    await this.$axios.$post('/register', data)
  },

  async getAllUsers({commit}) {
    const res = await this.$axios.$get('/getAllUsers')
    return commit('setAllAdmin', res)
  }
}
