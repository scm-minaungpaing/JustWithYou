export const namespaced = true

export const state = () => {
  return {
  }
}

export const mutations = {

}

export const actions = {
  async addSchedule({}, data) {
    return await this.$axios.post('/api/schedule', data)
    .then( res => res )
  },

  async getSchedule({}, data) {
    await this.$axios.get(`/api/schedule?month=${data.month}&year=${data.year}`)
    .then(
      res => console.log(res.data)
    )
  }
}
