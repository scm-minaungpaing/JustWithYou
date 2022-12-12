<template>
  <div class="modal">
    <b-modal ref="my-modal" hide-footer :title="modalText">
      <div class="d-block text-center">
        <div class="time-box">
          <b-form-select
            v-model="startTime"
            :options="startTimes"
            class="start-time"
          />
          <b-form-select
            v-model="endTime"
            :options="endTimes"
            class="start-time"
          />
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
        <b-button class="footer-btn" variant="outline-primary" @click="save">
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
      default: "",
    },
  },
  data() {
    return {
      startTime: null,
      endTime: null,
    };
  },
  computed: {
    startTimes() {
      const dates = [];
      for (let i = 0; i <= 23; i++) {
        const dateObj = {};
        dateObj.value = i == 0 ? null : i
        dateObj.text = i < 10 ? "0" + i + ":00" : i + ":00"
        dates.push(dateObj);
      }
      return dates;
    },
    endTimes() {
      const dates = [];
      for (let i = 0; i <= 23; i++) {
        const dateObj = {};
        dateObj.value = i == 0 ? null : i
        dateObj.text = i < 10 ? "0" + i + ":00" : i + ":00"
        dateObj.disabled = this.startTime >= i ? true : false
        dates.push(dateObj);
      }
      return dates;
    },
  },
  methods: {
    /**
     * open modal
     */
    showModal() {
      (this.startTime = null), (this.endTime = null), (this.index = null);
      this.$refs["my-modal"].show();
    },
    /**
     * hide modal
     */
    hideModal() {
      this.$refs["my-modal"].hide();
    },
    /**
     * edit schedule time
     * @param {object} data
     */
    editSchedule(data) {
      this.startTime = data.time.startTime;
      this.endTime = data.time.endTime;
      this.$refs["my-modal"].show();
    },
    /**
     * send schedule time
     */
    save() {
      const data = {
        startTime: this.startTime,
        endTime: this.endTime
      };
      this.$emit("save", data);
      this.hideModal();
    },
  },
};
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
