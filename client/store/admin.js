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
    const res = await this.$axios.$post('/api/register', data)
    return res
  },

  async getAllUsers({commit}) {
    const res = await this.$axios.$get('/api/getAllUsers')
    return commit('setAllAdmin', res)
  }
}
