<template>
  <div>
    <div
      v-for="(time, index) in times"
      :key="index"
    >
      <div class="d-flex">
        <div class="time">
          <span>{{ timeText(time) }}</span>
        </div>
        <div class="action">
          <b-button
            class="edit_btn"
            variant="success"
            @click="editTime(index)"
          >
            <i class="fa-solid fa-pen-to-square"></i>
          </b-button>
          <b-button
            class="delete_btn"
            variant="danger"
            @click="deleteTime(index)"
          >
            <i class="fa-solid fa-trash"></i>
          </b-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props: {
      times: {
        type: Array,
        default: [],
      },
    },
    computed: {
      timeText() {
        return (time) => {
          return (
            (time.startTime < 10 ? "0" + time.startTime + ":00" : time.startTime + ":00")
            + ' - ' +
            (time.endTime < 10 ? "0" + time.endTime + ":00" : time.endTime + ":00")
          )
        }
      }
    },
    methods: {
      /**
       * edit schedule time
       */
      editTime(index) {
        const time = {
          index: index,
          time: this.times[index]
        }
        this.$emit('edit', time)
      },
      /**
       * delete schedule time
       */
      deleteTime(index) {
        this.times.splice(index, 1)
      }
    }
}
</script>

<style lang="scss" scoped>
  .d-flex {
    border: 1px solid #b3a9a7;
    justify-content: space-between;
    align-items: center;
    padding: 3px;
    border-radius: 5px;
    margin-bottom: 3px;
  }
</style>
