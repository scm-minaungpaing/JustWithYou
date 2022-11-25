export const namespaced = true

export const state = () => {
  return {
  }
}

export const mutations = {

}

export const actions = {
  async addSchedule(data) {
    await this.$axios.$post('/api/schedule', data)
  },
}
