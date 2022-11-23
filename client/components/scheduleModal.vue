<template>
  <div class="modal">
    <b-modal ref="my-modal" hide-footer :title="modalText">
      <div class="d-block text-center">
      <div class="time-box">
        <b-form-select
          v-model="start_time"
          class="start-time"
        >
          <option
            v-for="(hour, index) in hours"
            :key="index"
            :value="hour.id"
          >
            {{hour.value}}
          </option>
        </b-form-select>
        <b-form-select
          v-model="end_time"
        >
          <option
            v-for="(hour, index) in hours"
            :key="index"
            :value="hour.id"
          >
            {{hour.value}}
          </option>
        </b-form-select>
      </div>
      </div>
      <div class="d-flex">
        <b-button
          class="footer-btn"
          variant="outline-danger"
          @click="hideModal"
        >
          Close
        </b-button>
        <b-button
          class="footer-btn"
          variant="outline-primary"
          @click="save"
        >
          Save
        </b-button>
      </div>
    </b-modal>
  </div>
</template>

<script>
  export default {
    props: {
      modalText: {
        type: String,
        default: '',
      },
    },
    data() {
      return {
        start_time: null,
        end_time: null,
        index: null
      }
    },
    computed: {
      hours() {
        return [
          {
            id: 0,
            value: '00',
          },
          {
            id: 1,
            value: '01',
          },
          {
            id: 2,
            value: '02',
          },
          {
            id: 3,
            value: '03',
          },
          {
            id: 4,
            value: '04',
          },
          {
            id: 5,
            value: '05',
          },
          {
            id: 6,
            value: '06',
          },
          {
            id: 7,
            value: '07',
          },
          {
            id: 8,
            value: '08',
          },
          {
            id: 9,
            value: '09',
          },
          {
            id: 10,
            value: '10',
          },
          {
            id: 11,
            value: '11',
          },
          {
            id: 12,
            value: '12',
          },
          {
            id: 13,
            value: '13',
          },
          {
            id: 14,
            value: '14',
          },
          {
            id: 15,
            value: '15',
          },
          {
            id: 16,
            value: '16',
          },
          {
            id: 17,
            value: '17',
          },
          {
            id: 18,
            value: '18',
          },
          {
            id: 19,
            value: '19',
          },
          {
            id: 20,
            value: '20',
          },
          {
            id: 21,
            value: '21',
          },
          {
            id: 22,
            value: '22',
          },
          {
            id: 23,
            value: '23',
          },
        ]
      },
    },
    methods: {
      /**
       * open modal
       */
      showModal() {
        this.start_time = null,
        this.end_time = null,
        this.index = null
        this.$refs['my-modal'].show()
      },
      /**
       * hide modal
       */
      hideModal() {
        this.$refs['my-modal'].hide()
      },
      /**
       * edit schedule time
       * @param {object} data
       */
      editSchedule(data) {
        this.start_time = data.time.start_time
        this.end_time = data.time.end_time
        this.index = data.index
        this.$refs['my-modal'].show()
      },
      /**
       * send schedule time
       */
      save() {
        const data = {
          start_time: this.start_time,
          end_time: this.end_time,
          index: this.index
        }
        this.$emit('save', data)
        this.hideModal()
      }
    }
  }
</script>
<style lang="scss" scoped>
  .modal {
    .time-box {
      display: flex;
      width: 50%;
      margin: 0 auto;
      margin-top: 16px;
      justify-content: space-between;
      .start-time {
        margin-right: 5px;
      }
    }
    .d-flex {
      width: 37%;
      margin: 0 auto;
      margin-top: 16px;
      justify-content: space-between;
      .footer-btn {
          padding: 7px 22px 7px 22px;
          text-align: center;
      }
    }
  }
</style>
